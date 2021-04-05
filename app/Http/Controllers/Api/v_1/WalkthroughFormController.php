<?php

namespace App\Http\Controllers\Api\v_1;

use App\Http\Requests\WalkthroughFormRequest;
use App\Models\Address;
use App\Models\EstimateForm;
use App\Models\EstimateWalkthroughForm;
use App\Models\HashLink;
use App\Repositories\LeadsRepositoryEloquent;
use Illuminate\Http\Request;

class WalkthroughFormController extends Controller
{
    /**
     * Seal
     */
    public function index()
    {

    }

    /**
     * Display prefilled walkthough form
     *
     * @param $hash
     * @param LeadsRepositoryEloquent $leadRep
     * @param WalkthroughFormRequest $validation
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($hash, LeadsRepositoryEloquent $leadRep, WalkthroughFormRequest $validation)
    {

        $findLink = HashLink::where('link', $hash)->where('type', 1)->first();

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
     * Store prefilled walkthough form
     *
     * @param Request $request
     * @param EstimateWalkthroughForm $estimateWalkthroughForm
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(WalkthroughFormRequest $request, EstimateWalkthroughForm $estimateWalkthroughForm)
    {

        if ($request->fails()) {

            return response()->json([
                'success' => false,
                'validation' => $request->messages()
            ], 200);

        }

        $estimateWalkthroughForm->save($request);

        return response()->json([
            'success' => true,
            'messages' => [
                __('walkthrough_form.email.success'),
            ]
        ], 200);

    }
}
