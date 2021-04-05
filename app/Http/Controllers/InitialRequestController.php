<?php

namespace App\Http\Controllers;

use App\Models\Leads;
use App\Repositories\LeadsRepositoryEloquent;
use App\Repositories\RequestRepositoryEloquent;
use App\Repositories\RoomRepositoryEloquent;
use Illuminate\Http\Request;

class InitialRequestController extends Controller
{
    /**
     * Form initial index
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index ()
    {
        return view('Initial.index');
    }

    /**
     * Store new lead with request and room(s) inside the request
     *
     * @param Request $request
     * @param RequestRepositoryEloquent $requestRepository
     * @param LeadsRepositoryEloquent $lead
     * @param RoomRepositoryEloquent $room
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function store (Request $request, RequestRepositoryEloquent $requestRepository, LeadsRepositoryEloquent $lead, RoomRepositoryEloquent $room)
    {
        $leadId = $lead->storeInitialLead($request);

        $data = ['lead' => $leadId, 'created_by' => $leadId, 'status' => $leadId, 'type' => $request->input('type'), 'stage' => $request->input('stage'), 'startdate' => $request->input('startdate')];

       // dd($data);die;

        $requestId = $requestRepository->store($data);

        $room->storeRooms($request, $requestId, $leadId);

        return view('Initial.success', ['success' => 'Form was sent, thank you.']);

    }

    /**
     * AJAX email validation on fly
     *
     * @param Request $request
     */
    public function validateEmail (Request $request)
    {

        $email = $request->email;

        $check = Leads::where('email', '=', $email)->first();

        if ($check) {
            $response = '1';
        } else {
            $response = '2';
        }

        echo $response;

    }

}
