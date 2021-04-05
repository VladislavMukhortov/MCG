<?php


namespace App\Services;


use App\Models\CsiCode;
use App\Models\EstimateTemplateLineItemsRepository;
use Illuminate\Http\Request;

class EstimateTemplateService
{
    public static function storeLineItem($data, int $id)
    {
        $estimateTemplateCsiCodes = [];
        foreach ($data['csi_codes'] as $csiCodeId) {
            if ($csi_code = CsiCode::find($csiCodeId)) {
                $estimateTemplateCsiCodes[] = $csi_code;
            }
        }

        if (!empty($estimateTemplateCsiCodes)) {
            try {
                EstimateTemplateLineItemsRepository::where('estimate_template_id', $id)->delete();
                foreach ($estimateTemplateCsiCodes as $csiCode) {
                    EstimateTemplateLineItemsRepository::create([
                        'csi_code' => $csiCode->id,
                        'estimate_template_id' => $id,
                    ]);
                    $csiCodeIds[] = $csiCode->id;
                }
                return $csiCodeIds;
            } catch (\Exception $e) {
                throw new \Exception('Something wrong upon attempt save line item in estimate_template_line_items table', 500);
            }
        }
    }

    public static function getTemplateLineItems($id)
    {
        $csiCodeIds = EstimateTemplateLineItemsRepository::select('csi_code')->where('estimate_template_id', $id)->get();

        foreach ($csiCodeIds as $codeId) {
            if ($csiCode = CsiCode::find($codeId->csi_code)) {
                $csiCodes[] = $csiCode;
            }
        }
        return $csiCodes;
    }

}