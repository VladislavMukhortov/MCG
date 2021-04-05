<?php

namespace App\Http\Controllers\Request;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HelperController;
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

        return redirect()->route('leads.show', $leadId);

//        $requests = $this->repository->index();
//        $requestslist = $this->repository->getRequestslist();
//        $contactslist = $this->repository->getContactslist();
//
//        return view('Request.index', compact('requests', 'requestslist', 'contactslist'));
    }

    public function create ()
    {
        //
    }

    public function store (Request $storeRequest)
    {
        $request = $this->repository->store($storeRequest->all());
        return redirect()->back();

    }

    public function show (RequestEloquent $request)
    {
        $reads = $this->repository->show($request->id);
        $contactslist = $this->repository->getContactslist();
        $notelist = $this->repository->getNoteslist($request->id);
        $attachmentlist = $this->repository->getAttachmentslist($request->id);
        $activitylist = $this->repository->getActivitieslist($request->id);
        $lead = $this->repository->getRequestLead($reads->lead);
        $rooms = $this->rooms->where('request_id', $request->id)->get();
        $roomWorkType = HelperController::roomWorktypeGenerate();
        $roomType = HelperController::roomTypeGenerate();
        $type = HelperController::type();
        $stage = HelperController::stage();
        $startDate = HelperController::startData();

        return view('Request.view-edit', compact('reads', 'contactslist', 'notelist', 'attachmentlist', 'activitylist', 'lead', 'rooms', 'roomWorkType', 'roomType', 'type', 'stage', 'startDate'));
    }

    public function edit (RequestEloquent $request)
    {
        //
    }

    public function update (Request $updateRequest, RequestEloquent $request)
    {
        $reads = $this->repository->update($updateRequest->all(), $request->id);
        return redirect()->route('requests.show', $request);
    }

    public function destroy (RequestEloquent $request)
    {
        $reads = $this->repository->delete($request->id);
        return redirect()->back();
    }
}
