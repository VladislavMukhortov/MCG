<?php

namespace App\Http\Controllers\Api\v_1\Request;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HelperController;
use App\Http\Requests\RequestRequest;
use App\Models\Room;
use Illuminate\Http\Request;
use App\Repositories\RequestRepositoryEloquent;
use App\Models\Request as RequestEloquent;


class RequestController extends Controller
{

    protected $repository;
    protected $rooms;

    public function __construct (RequestRepositoryEloquent $repository, Room $rooms)
    {
        $this->authorizeResource(RequestEloquent::class, 'request');

        $this->repository = $repository;
        $this->rooms = $rooms;
    }


    public function index(Request $request)
    {
        $requestData = $request->all();

        $leadId = key($requestData);

        return response()->json([
            'success' => true,
            'data' => [
                'leadId' => $leadId
                ]
        ], 200);

    }

    public function create ()
    {
        //
    }

    /**
     * Store request
     *
     * @param RequestRequest $storeRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function store (RequestRequest $storeRequest)
    {
        $requestId = $this->repository->store($storeRequest->all());

        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.requests.create.success')
            ],
            'data' => [
                'request' => $requestId
            ]
        ], 200);

    }

    /**
     * Display request and necessary details
     *
     * @param RequestEloquent $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show (RequestEloquent $request)
    {
        $request = $this->repository->show($request->id);

        return response()->json([
            'success' => true,
            'data' => [
                'reads' => $request,
            ],
        ], 200);

    }

    /**
     * Get Notes by ID
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getNotesList($id)
    {
        $request = RequestEloquent::findOrFail($id);

        if ($request) {
            return response()->json(['success' => true, 'data' => ['notes' => $this->repository->getNoteslist($id)]], 200);
        }
    }

    /**
     * get Attachments by ID
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAttachmentsList($id)
    {
        $request = RequestEloquent::findOrFail($id);

        if ($request) {
            return response()->json(['success' => true, 'data' => ['attachments' => $this->repository->getAttachmentslist($id)]], 200);
        }
    }

    /**
     * Get Activities by ID
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getActivitiesList($id)
    {
        $request = RequestEloquent::findOrFail($id);
        if ($request) {
            return response()->json(['success' => true, 'data' => ['activities' => $this->repository->getActivitieslist($id)]], 200);
        }

    }

    /**
     * Get Lead by Request ID
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getLead($id)
    {
        $request = RequestEloquent::findOrFail($id);

        if($request) {
            return response()->json(['success' => true, 'data' => ['lead' => $this->repository->getRequestLead($id)->first()]], 200);
        }
    }

    /**
     * Get Request Rooms by ID
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRooms($id)
    {
        $request = RequestEloquent::findOrFail($id);

        if($request) {
            return response()->json(['success' => true, 'data' => ['rooms' => $this->rooms->where('request_id', $id)->get()]], 200);
        }
    }

    /**
     * Get list of Lead emails
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getEmails($id)
    {
        return response()->json([
            'success' => true,
            'data' => [
                'emails'  => RequestEloquent::findOrFail($id)->emails()->get()
            ]
        ], 200);

    }

    /**
     * @param RequestEloquent $request
     */
    public function edit (RequestEloquent $request)
    {
        //
    }

    /**
     * Update request details
     *
     * @param RequestRequest $updateRequest
     * @param RequestEloquent $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update (RequestRequest $updateRequest, RequestEloquent $request)
    {

        $request = RequestEloquent::findOrFail($request->id);

        if ($request) {
            $this->repository->update($updateRequest->all(), $request->id);

            return response()->json(['success' => true, 'messages' => [__('pages.requests.update.success')], 'data' => ['request' => $request->id]], 200);
        }
    }

    /**
     * Remove request
     *
     * @param RequestEloquent $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy (RequestEloquent $request)
    {

        $request = RequestEloquent::findOrFail($request->id);

        if ($request) {

            $request->Room()->delete();

            $request->delete();

            return response()->json(['success' => true, 'messages' => [__('pages.requests.delete.success')], 'data' => ['request' => $request->id]], 200);
        }
    }
}
