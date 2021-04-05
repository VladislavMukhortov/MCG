<?php

namespace App\Http\Controllers\Api\v_1;

use App\Http\Requests\InitialCompletionFormRequest;
use App\Models\Address;
use App\Models\EstimateForm;
use App\Models\HashLink;
use App\Repositories\LeadsRepositoryEloquent;
use Illuminate\Http\Request;

class InitialCompletionFormController extends Controller
{
    /**
     * Seal
     */
    public function index()
    {

    }

    /**
     * Display prefilled initial completion
     *
     * @param $hash
     * @param LeadsRepositoryEloquent $leadRep
     * @param InitialCompletionFormRequest $validation
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($hash, LeadsRepositoryEloquent $leadRep, InitialCompletionFormRequest $validation)
    {

        $findLink = HashLink::where('link', $hash)->first();

        if ($findLink) {

            $lead = $leadRep->show($findLink->lead_id);

            $lead .= Address::where('lead_id', $findLink->lead_id)->first();

            return response()->json([
                'success' => true,
                'validation' => $validation,
                'data' => [
                    'lead' => $lead,
                ]
            ], 200);

        }

    }

    /**
     * Store initial form to EstimateForm model
     *
     * @param Request $request
     * @param EstimateForm $estimateForm
     */
    public function store(InitialCompletionFormRequest $request, EstimateForm $estimateForm)
    {

        if ($request->fails()) {

            return response()->json([
                'success' => false,
                'validation' => $request->messages()
            ], 200);

        }
        $link = HashLink::where('lead_id', $request->lead_id)->first();


        $estimateForm->save($request);

        return response()->json([
            'success' => true,
            'messages' => [
                __('initial_completion_form.email.success'),
            ],
            'data' => [
                'walkthrough' => $link
            ]
        ], 200);

    }
}
