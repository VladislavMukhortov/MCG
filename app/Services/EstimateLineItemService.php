<?php


namespace App\Services;


use App\Models\CsiCode;
use App\Models\EstimateRepository;
use App\Models\EstimateRepositoryLineItems;
use App\Models\EstimateTemplateLineItemsRepository;

class EstimateLineItemService
{
    /**
     * Create line items for estimate
     *
     * @param array $data
     * @param int $id
     * @return void
     */

    public static function createLineItem(array $data, int $id): void
    {
        if (EstimateRepository::find($id)) {
            foreach ($data['csi_codes'] as $csiCodeId) {
                if ($csi_code = CsiCode::find($csiCodeId)) {
                    $estimateCsiCodes[] = $csi_code;
                }
            }

            if (!empty($estimateCsiCodes)) {
              //  EstimateRepositoryLineItems::where('estimate_id', $id)->delete(); commented it out, deletes own entities.
                foreach ($estimateCsiCodes as $csiCode) {
                    EstimateRepositoryLineItems::create([
                        'csi_code' => $csiCode->id,
                        'estimate_id' => $id,
                    ]);
                }
            }
        }
    }

    /**
     * Get estimate line items
     *
     * @param int $estimateId
     * @return array
     */

    public static function getLineItems(int $estimateId): array
    {
        $csiCodeIds = EstimateRepositoryLineItems::select('csi_code')
            ->where('estimate_id', $estimateId)
            ->get();

        if ($csiCodeIds) {
            $csiCodes = [];
            foreach ($csiCodeIds as $codeId) {
                if ($csiCode = CsiCode::find($codeId->csi_code)) {
                    $csiCodes[] = $csiCode;
                }
            }
            return $csiCodes;
        }
    }

    /**
     * Get Line Items
     *
     * @param int $estimateId
     * @param int $templateId
     * @throws \Exception
     */
    public static function createLineItemsFromTemplate(int $estimateId, int $templateId)
    {
        $estimateTemplateCsiCodes = EstimateTemplateLineItemsRepository::where('estimate_template_id', $templateId)->get();

        try {
            foreach ($estimateTemplateCsiCodes as $csiCode) {
                EstimateRepositoryLineItems::create([
                    'estimate_id' => $estimateId,
                    'csi_code' => $csiCode->csi_code,
                ]);
            }
        } catch (\Exception $e) {
            throw new \Exception('Something wrong upon attempt save line item in estimate_line_items table', 500);
        }
    }
}