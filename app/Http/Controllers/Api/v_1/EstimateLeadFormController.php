<?php

namespace App\Http\Controllers\Api\v_1;

use App\Models\EstimateFormNextStep;
use App\Models\EstimateFormPhase;
use App\Models\EstimateFormPremise;
use App\Models\EstimateFormTerms;
use App\Models\EstimateLeadForm;
use App\Models\EstimateRepository;
use App\Models\Leads;
use App\Services\EstimateLeadFormService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EstimateLeadFormController extends Controller
{

    /**
     * Form for lead, page 1
     *
     * @param int $leadId
     * @return JsonResponse
     */

    public function estimateFormPage1(int $leadId): JsonResponse
    {
        if (Leads::find($leadId)) {
            return response()->json([
                'success' => true,
                'data' => [
                    'lead' => Leads::select('name', 'last_name', 'email')->find($leadId),
                ],
            ], 200);
        }
    }

    /**
     * Save file in page 1
     *
     * @param Request $request
     * @return JsonResponse
     */

    public function storeFilePage1(Request $request): JsonResponse
    {
        if ($estimateLeadForm = EstimateLeadFormService::storeFilePage1($request)) {
            return response()->json([
                'success' => true,
                'messages' => [
                    __('pages.estimates_lead_form.store_file.success'),
                ],
                'data' => [
                    'estimateLeadFormId' => $estimateLeadForm->id,
                ],
            ], 200);
        }
    }

    /**
     * Delete file from page 1
     *
     * @param int $leadFormId
     * @return JsonResponse
     */

    public function deleteFilePage1(int $leadFormId): JsonResponse
    {
        $leadEstimateForm = EstimateLeadForm::find($leadFormId);
        EstimateLeadFormService::deleteFile($leadEstimateForm->file);

        if ($leadEstimateForm->delete()) {
            return response()->json([
                'success' => true,
                'messages' => [
                    __('pages.estimates_lead_form.delete_file.success'),
                ],
            ], 200);
        }
    }

    /**
     * Form for lead, page 2, premises
     *
     * @param int $estimateId
     * @return JsonResponse
     */

    public function storePremise(int $estimateId): JsonResponse
    {
        if (EstimateRepository::find($estimateId)) {
            $premise = EstimateFormPremise::create([
                'estimate_id' => $estimateId,
            ]);

            return response()->json([
                'success' => true,
                'messages' => [
                    __('pages.estimates_lead_form.create_promise.success'),
                ],
                'data' => [
                    'promiseId' => $premise->id,
                ],
            ], 200);
        }
    }

    /**
     * Get all premises
     *
     * @param int $estimateId
     * @return JsonResponse
     */

    public function getAllPremises(int $estimateId): JsonResponse
    {
        if (EstimateRepository::find($estimateId)) {
            return response()->json([
                'success' => true,
                'data' => [
                    'premises' => EstimateFormPremise::where('estimate_id', $estimateId)->get(),
                ],
            ], 200);
        }
    }

    /**
     * Show premise by id
     *
     * @param int $premiseId
     * @return JsonResponse
     */

    public function showPremise(int $premiseId): JsonResponse
    {
        if (EstimateFormPremise::find($premiseId)) {
            return response()->json([
                'success' => true,
                'data' => [
                    'premise' => EstimateFormPremise::with('estimateLeadForm')->find($premiseId),
                ],
            ], 200);
        }
    }

    /**
     * Save premise data, page 2
     *
     * @param Request $request
     * @param int $premiseId
     * @return JsonResponse
     */

    public function storePremiseData(Request $request, int $premiseId): JsonResponse
    {
        if ($responseDate = EstimateLeadFormService::storePremiseData($request, $premiseId)) {
            return response()->json([
                'success' => true,
                'messages' => [
                    __('pages.estimates_lead_form.store_file.success'),
                ],
                'data' => [
                    'estimateLeadFormId' => $responseDate['estimate_lead_form'],
                    'premiseId' => $responseDate['premise_id'],
                ],
            ], 200);
        }
    }

    /**
     * Delete premise data, page 2
     *
     * @param int $premiseId
     * @return JsonResponse
     */

    public function deletePremiseData(int $premiseId): JsonResponse
    {
        $premise = EstimateFormPremise::find($premiseId);
        $premise->estimateLeadForm()->delete();

        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.estimates_lead_form.delete_file.success'),
            ],
        ], 200);
    }

    /**
     * Update premise data, page 2
     *
     * @param Request $request
     * @param int $premiseId
     * @return JsonResponse
     */

    public function updatePremise(Request $request, int $premiseId): JsonResponse
    {
        if (EstimateFormPremise::find($premiseId)->update($request->all())) {
            return response()->json([
                'success' => true,
                'messages' => [
                    __('pages.estimates_lead_form.update_file.success'),
                ],
            ], 200);
        }
    }

    /**
     * Update premise data, page 2
     *
     * @param Request $request
     * @param int $premiseId
     * @param int $formId
     * @return JsonResponse
     */

    public function updatePremiseData(Request $request, int $premiseId, int $formId): JsonResponse
    {
        if (EstimateLeadFormService::updatePremiseData($request, $premiseId, $formId)) {
            return response()->json([
                'success' => true,
                'messages' => [
                    __('pages.estimates_lead_form.update_file.success'),
                ],
            ], 200);
        }
    }

    /**
     * Delete premise
     *
     * @param int $premiseId
     * @return JsonResponse
     */

    public function deletePremise(int $premiseId): JsonResponse
    {
        $premise = EstimateFormPremise::find($premiseId);
        $premise->estimateLeadForm()->delete();
        $premise->delete();

        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.estimates_lead_form.delete_premise.success'),
            ],
        ], 200);
    }

    /**
     * Get all phases
     *
     * @param int $estimateId
     * @return JsonResponse
     */

    public function getAllPhases(int $estimateId): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => [
                'phases' => EstimateFormPhase::where('estimate_id', $estimateId)->get(),
            ],
        ], 200);
    }

    /**
     * Get phase by id
     *
     * @param int $phaseId
     * @return JsonResponse
     */

    public function showPhase(int $phaseId): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => [
                'phase' => EstimateFormPremise::with('estimateLeadForm')->find($phaseId),
            ],
        ], 200);
    }

    /**
     * Store phase
     *
     * @param Request $request
     * @return JsonResponse
     */

    public function storePhase(Request $request): JsonResponse
    {
        if ($responseData = EstimateLeadFormService::storePhase($request)) {
            return response()->json([
                'success' => true,
                'messages' => [
                    __('pages.estimates_lead_form.store_phase.success'),
                ],
                'data' => [
                    'estimateLeadFormId' => $responseData['estimate_lead_form_id'],
                    'phaseId' => $responseData['phase_id'],
                ],
            ], 200);
        }
    }

    /**
     * Update phase
     *
     * @param Request $request
     * @param int $phaseId
     * @param int $formId
     * @return JsonResponse
     */

    public function updatePhase(Request $request, int $phaseId, int $formId)
    {
        if (EstimateLeadFormService::updatePhase($request, $phaseId, $formId)) {
            return response()->json([
                'success' => true,
                'messages' => [
                    __('pages.estimates_lead_form.update_phase.success'),
                ],
            ], 200);
        }
    }

    /**
     * Delete phase
     *
     * @param int $phaseId
     * @return JsonResponse
     */

    public function deletePhase($phaseId): JsonResponse
    {
        $premise = EstimateFormPhase::find($phaseId);
        $premise->estimateLeadForm()->delete();
        $premise->delete();

        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.estimates_lead_form.delete_phase.success'),
            ],
        ], 200);
    }

    /**
     * Get page 4 in form
     *
     * @param int $estimateId
     * @return JsonResponse
     */

    public function estimateFormPage4(int $estimateId)
    {
        if (EstimateRepository::find($estimateId)) {
            return response()->json([
                'success' => true,
                'data' => [
                    'estimateWithCodes' => EstimateRepository::with('lineItems', 'estimateCodePrices')->find($estimateId),
                ],
            ], 200);
        }
    }

    /**
     * Get page 5 in form
     *
     * @param int $estimateId
     * @return JsonResponse
     */

    public function estimateFormPage5(int $estimateId)
    {
        if (EstimateRepository::find($estimateId)) {
            return response()->json([
                'success' => true,
                'data' => [
                    'estimateCodes' => EstimateFormNextStep::where('estimate_id', $estimateId)->first(),
                ],
            ], 200);
        }
    }

    /**
     * Store data for page 5 in form
     *
     * @param Request $request
     * @return JsonResponse
     */

    public function storeEstimateFormPage5(Request $request): JsonResponse
    {
        if ($nextStep = EstimateFormNextStep::create($request->all())) {
            return response()->json([
                'success' => true,
                'messages' => [
                    __('pages.estimates_lead_form.create_next_step.success'),
                ],
                'data' => [
                    'nextStepId' => $nextStep->id,
                ],
            ], 200);
        }
    }

    /**
     * Update data for page 5 in form
     *
     * @param Request $request
     * @param int $nextStepId
     * @return JsonResponse
     */

    public function updateEstimateFormPage5(Request $request, int $nextStepId): JsonResponse
    {
        if (EstimateFormNextStep::find($nextStepId)->update($request->all())) {
            return response()->json([
                'success' => true,
                'messages' => [
                    __('pages.estimates_lead_form.update_next_step.success'),
                ],
            ], 200);
        }
    }

    /**
     * Delete data for page 5 in form
     *
     * @param int $nextStepId
     * @return JsonResponse
     */

    public function deleteEstimateFormPage5(int $nextStepId)
    {
        if (EstimateFormNextStep::find($nextStepId)->delete()) {
            return response()->json([
                'success' => true,
                'messages' => [
                    __('pages.estimates_lead_form.delete_next_step.success'),
                ],
            ], 200);
        }
    }

    /**
     * Get data for page 6 in form
     *
     * @param int $estimateId
     * @return JsonResponse
     */

    public function estimateFormPage6(int $estimateId): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => [
                'estimateTerms' => EstimateFormTerms::where('estimate_id', $estimateId)->first(),
            ],
        ], 200);
    }

    /**
     * Update data for page 6 in form
     *
     * @param Request $request
     * @param int $termsId
     * @return JsonResponse
     */

    public function updateOrStoreEstimateFormPage6(Request $request, int $termsId = 0): JsonResponse
    {
        if ($termsId) {
            if (EstimateFormTerms::find($termsId)->update($request->all())) {
                return response()->json([
                    'success' => true,
                    'messages' => [
                        __('pages.estimates_lead_form.update_terms.success'),
                    ],
                ], 200);
            }
        }

        if ($terms = EstimateFormTerms::create($request->all())) {
            return response()->json([
                'success' => true,
                'messages' => [
                    __('pages.estimates_lead_form.create_terms.success'),
                ],
                'data' => [
                    'termId' => $terms->id,
                ]
            ], 200);
        }

    }

}
