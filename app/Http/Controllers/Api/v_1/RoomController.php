<?php

namespace App\Http\Controllers\Api\v_1;

use App\Http\Requests\RoomRequest;
use App\Models\Job;
use App\Models\Room;
use App\Repositories\RoomRepositoryEloquent;
use Illuminate\Http\Request;

class RoomController extends Controller
{

    protected $room;

    public function __construct (Room $room)
    {
        $this->room = $room;
    }

    /**
     * Display Room by ID
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show ($id)
    {
        if ($this->room->findOrFail($id)) {
            return response()->json(['success' => true, 'data' => ['room' => $this->room->where('id', $id)->get()]], 200);
        }
    }

    /**
     * Save Room
     *
     * @param RoomRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store (RoomRequest $request)
    {
            return response()->json(['success' => true, 'messages' => [__('pages.rooms.update.success')], 'data' => ['room' => $this->room->create($request->all())]], 200);
    }

    /**
     * Update room details
     *
     * @param $id
     * @param RoomRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update ($id, RoomRequest $request)
    {
        if ($this->room->findOrFail($id)) {
            return response()->json(['success' => true, 'messages' => [__('pages.rooms.update.success')], 'data' => ['room' => $this->room->where('id', $id)->update($request->all())]], 200);
        }
    }

    /**
     * Delete Room by ID
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if ($this->room->findOrFail($id)) {
            return response()->json(['success' => true, 'messages' => [__('pages.rooms.destory.success')], 'data' => ['room' => $this->room->where('id', $id)->delete()]], 200);
        }

    }



}
