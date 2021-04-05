<?php

namespace App\Http\Controllers\Api\v_1;

use App\Http\Requests\InsertEstimateTemplateRequest;
use App\Http\Requests\UpdateEstimateTemplateRequest;
use App\Models\CsiCode;
use App\Models\EstimateRepository;
use App\Models\EstimateTemplateRepository;
use App\Services\EstimateLineItemService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Services\EstimateService;

class EstimateLineItemController extends Controller
{
    use AuthorizesRequests;

    /**
     * Create line items estimate
     *
     * @param Request $request
     * @param int $estimateId
     * @return JsonResponse
     */

    public function saveLineItems(Request $request, int $estimateId): JsonResponse
    {
        EstimateLineItemService::createLineItem($request->all(), $estimateId);

        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.estimate_templates.save_line_items.success'),
            ],
        ]);
    }

    /**
     * Get estimate line items
     *
     * @param int $estimateId
     * @return JsonResponse
     */

    public function getLineItems(int $estimateId): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => [
                'lineItems' => EstimateLineItemService::getLineItems($estimateId)
            ],
        ]);
    }

    /**
     * Get all csi codes
     *
     * @return JsonResponse
     */

    public function getAllCsiCodes(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => [
                'allCsiCodes' => CsiCode::all(),
            ],
        ]);
    }

    /**
     * Insert line items from estimate template in estimate
     *
     * @param int $estimateId
     * @param Request $request
     * @return JsonResponse
     */

    public function insertEstimateTemplate (int $estimateId, Request $request): JsonResponse
    {
        if (EstimateTemplateRepository::find($request->get('estimate_template_id'))) {
            if (EstimateRepository::findOrFail($estimateId)) {

                EstimateLineItemService::createLineItemsFromTemplate($estimateId, $request->get('estimate_template_id'));

                return response()->json([
                    'success' => true,
                    'messages' => [
                        __('pages.estimates.insert_estimate_template.success')
                    ],
                ], 200);
            }
        }
    }
}
