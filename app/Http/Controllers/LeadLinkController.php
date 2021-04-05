<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\HashLink;
use App\Models\Leads;
use App\Repositories\LeadLinkRepositoryEloquent;
use App\Repositories\LeadsRepositoryEloquent;
use App\Repositories\RequestRepositoryEloquent;
use App\Repositories\RoomRepositoryEloquent;
use Illuminate\Http\Request;

class LeadLinkController extends Controller
{

    /**
     * Seal
     */
    public function index()
    {

    }

    /**
     * Display prefilled form with lead details
     *
     * @param $hash
     * @param LeadsRepositoryEloquent $leadRep
     * @param Leads $leads
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($hash, LeadsRepositoryEloquent $leadRep)
    {
        $findLink = HashLink::where('link', $hash)->first();

        if ($findLink) {

            $lead = $leadRep->show($findLink->lead_id);

            $leadAddress = Address::where('lead_id', $findLink->lead_id)->first();

            return view('LeadLink.index', compact('lead', 'leadAddress'));

        }

    }

    /**
     * Create new form for existing lead
     *
     * @param Request $request
     * @param RequestRepositoryEloquent $requestRepository
     * @param RoomRepositoryEloquent $room
     * @param LeadsRepositoryEloquent $lead
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function store (Request $request, RequestRepositoryEloquent $requestRepository, RoomRepositoryEloquent $room, LeadsRepositoryEloquent $lead)
    {
        $lead->updateLead($request);

        $data = ['lead' => $request->input('id'), 'created_by' => $request->input('id'), 'status' => '1', 'type' => $request->input('type'), 'stage' => $request->input('stage'), 'startdate' => $request->input('startdate')];

        $requestId = $requestRepository->store($data);

        $room->storeRooms($request, $requestId, $request->id);

        return view('Initial.success', ['success' => 'Form was sent, thank you.']);

    }


    /**
     * Create new link and/or send to lead email
     *
     * @param Request $request
     * @param LeadLinkRepositoryEloquent $leadLink
     * @return \Illuminate\Http\RedirectResponse
     */
    public function repeatLinkSend(Request $request, LeadLinkRepositoryEloquent $leadLink)
    {

        $leadLink->sendLeadLink($request);

        return redirect()->back()->with('Email-success', 'Message sent.');

    }
}
