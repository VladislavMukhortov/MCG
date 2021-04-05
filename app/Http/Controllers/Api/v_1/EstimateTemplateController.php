<?php

namespace App\Http\Controllers\Api\v_1;

use App\Models\EstimateTemplateLineItemsRepository;
use App\Models\EstimateTemplateRepository;
use App\Services\EstimateTemplateService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EstimateTemplateController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'allTemplates' => EstimateTemplateRepository::all(),
            ],

        ]);
    }

    public function store(Request $request)
    {
        if ($estimateTemplate = EstimateTemplateRepository::create($request->all())) {
            return response()->json([
                'success' => true,
                'messages' => [
                    __('pages.estimate_templates.create.success'),
                ],
                'data' => [
                    'estimateTemplateId' => $estimateTemplate->id,
                ],
            ], 200);
        }
    }

    public function show($id)
    {
        if ($id) {
            return response()->json([
                'success' => true,
                'data' => [
                    'estimateTemplate' => EstimateTemplateRepository::with('lineItems')->find($id),
                ],
            ], 200);
        }
    }

    public function update(int $id, Request $request)
    {
        if (EstimateTemplateRepository::find($id)->update($request->all())) {
            return response()->json([
                'success' => true,
                'messages' => [
                    __('pages.estimate_templates.update.success'),
                ],
            ], 200);
        }
    }

    public function destroy($id)
    {
        if ($id) {
            EstimateTemplateLineItemsRepository::where('estimate_template_id', $id)->delete();
            if (EstimateTemplateRepository::find($id)->delete()) {
                return response()->json([
                    'success' => true,
                    'messages' => [
                        __('pages.estimate_templates.delete.success'),
                    ],
                ], 200);
            }
        }
    }

    public function getLineItems($estimateTemplateId)
    {
        if ($estimateTemplateId) {
            return response()->json([
                'success' => true,
                'data' => [
                    'estimateTemplateLineItems' => EstimateTemplateService::getTemplateLineItems($estimateTemplateId),
                ],
            ], 200);
        }
    }

    public function saveLineItems(Request $request, $estimateTemplateId)
    {
        if (EstimateTemplateRepository::find($estimateTemplateId)) {
            $csiCodeIds = EstimateTemplateService::storeLineItem($request->all(), $estimateTemplateId);

            return response()->json([
                'success' => true,
                'messages' => [
                    __('pages.estimate_templates.save_line_items.success'),
                ],
                'data' => [
                    'csiCodeIds' => $csiCodeIds,
                ],
            ], 200);
        }
    }

    public function removeTemplateLineItem(Request $request, $estimateTemplateId)
    {
        $estimateTemplateLineItem = EstimateTemplateLineItemsRepository::where('estimate_template_id', $estimateTemplateId)
            ->where('csi_code', $request->get('csi_code_id'))
            ->first();

        if ($estimateTemplateLineItem) {
            if ($estimateTemplateLineItem->delete()) {
                return response()->json([
                    'success' => true,
                    'messages' => [
                        __('pages.estimate_templates.delete_line_item.success'),
                    ],
                ], 200);
            }
        }
    }

    //todo Пока неизвестно будет ли нужна эта функция в будущем (с) Влад
    public static function countLineItems($itemsArr)
    {
        if (!$itemsArr) {
            return false;
        }
        foreach ($itemsArr as $item) {
            if (array_key_exists("children", $item)) {
                return self::countLineItems($item["children"]);
            } else {
                return count($itemsArr);
            }
        }
    }
}
