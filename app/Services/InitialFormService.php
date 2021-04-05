<?php
namespace App\Services;


use App\Models\Leads;
use App\Models\Room;
use App\Repositories\LeadsRepositoryEloquent;
use App\Repositories\RequestRepositoryEloquent;

class InitialFormService
{

    protected $leadsRepository;
    protected $room;
    protected $requestRepository;

    public function __construct (LeadsRepositoryEloquent $leadsRepository, RequestRepositoryEloquent $requestRepository, Room $room)
    {
        $this->leadsRepository = $leadsRepository;
        $this->room = $room;
        $this->requestRepository = $requestRepository;
    }

    public function store($request)
    {
        $leadId = $this->leadsRepository->store($request)->id;

        $data = ['lead' => $leadId, 'created_by' => auth('api')->user() ? auth('api')->user()->id : NULL, 'status' => $request->status, 'type' => $request->input('type'), 'stage' => $request->input('stage'), 'startdate' => $request->input('start_date')];

        $requestId = $this->requestRepository->store($data);

        $huh = array_merge($request->all(), ['request_id' => $requestId]);

        $this->room->create($huh);
    }

    public function validateEmail($request)
    {
        return Leads::where('email', '=', $request)->first();
    }

}