<?php

namespace App\Http\Controllers\Api\v_1;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventUser;
use http\Client\Curl\User;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index($userId)
    {
        $userWithEvents = Event::getUser($userId);

        if ($userWithEvents) {
            return response()->json([
                'success' => true,
                'data' => [
                    'userWithEvents' => Event::getUser($userId),
                ]
            ], 200);
        }
    }

    public function store(Request $request)
    {
        $requestData = $request->all();
        $requestData['created_by'] = auth('api')->user()->id;

        foreach ($request->get('user_ids') as $userId) {
            if (\App\Models\User::find($userId)) {
                $userIds[] = $userId;
            }
        }

        if (!empty($userIds)) {
            $event = Event::create($requestData);
            if ($event) {
                foreach ($userIds as $userId) {
                    EventUser::create([
                        'user_id' => $userId,
                        'event_id' => $event->id,
                    ]);
                }

                return response()->json([
                    'success' => true,
                    'messages' => [
                        __('pages.events.create.success'),
                    ],
                    'data' => [
                        'eventId' => $event->id,
                    ]
                ], 200);
            }
        }
    }

    public function show($eventId)
    {
        $eventId = Event::with('users')->find($eventId);

        if ($eventId) {
            return response()->json([
                'success' => true,
                'data' => [
                    'event' => Event::with('users')->find($eventId),
                ]
            ], 200);
        }
    }

    public function update(Request $request, $eventId)
    {
        $requestData = $request->all();
        $requestData['created_by'] = auth('api')->user()->id;

        $event = Event::with('users')->find($eventId);

        foreach ($request->get('user_ids') as $userId) {
            if (\App\Models\User::find($userId)) {
                $userIds[] = $userId;
            }
        }

        if (!empty($userIds)) {
            EventUser::where('event_id', $eventId)->delete();
            $event->update($requestData);

            foreach ($userIds as $userId) {
                EventUser::create([
                    'user_id' => $userId,
                    'event_id' => $event->id,
                ]);
            }

            return response()->json([
                'success' => true,
                'messages' => [
                    __('pages.events.update.success'),
                ],
            ], 200);
        }

    }

    public function destroy($eventId)
    {
        $event = Event::find($eventId);

        if ($event) {
            EventUser::where('event_id', $eventId)->delete();
            $event->delete($eventId);

            return response()->json([
                'success' => true,
                'messages' => [
                    __('pages.events.delete.success'),
                ],
            ], 200);
        }
    }

    public function getAllUsers()
    {
        return response()->json([
            'success' => true,
            'date' => [
                'allUsers' => \App\Models\User::select('name', 'id', 'email')->get(),
            ],
        ], 200);
    }
}
