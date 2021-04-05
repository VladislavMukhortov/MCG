<?php


namespace App\Services;


use App\Models\EstimateFormPhase;
use App\Models\EstimateFormPremise;
use App\Models\EstimateLeadForm;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\Self_;

class EstimateLeadFormService
{
    /**
     * Save file in page 1
     *
     * @param Request $request
     * @return EstimateLeadForm
     */

    public static function storeFilePage1(Request $request): EstimateLeadForm
    {
        $pathPageImage = self::storeFile($request);

        $pageData = ['estimate_id' => $request->get('estimate_id'), 'file' => $pathPageImage, 'page_number' => 1];

        return EstimateLeadForm::create($pageData);
    }

    /**
     * Save premise data page 2
     *
     * @param Request $request
     * @param int $premiseId
     * @return array
     */

    public static function storePremiseData(Request $request, int $premiseId): array
    {
        $pathPageImage = self::storeFile($request);

        $premise = EstimateFormPremise::find($premiseId);
        $premise->update($request->all());

        $pageData = ['estimate_id' => $request->get('estimate_id'), 'file' => $pathPageImage, 'premise_id' => $premise->id, 'page_number' => 2];

        $estimateLeadForm = EstimateLeadForm::create($pageData);

        return [
            'premise_id' => $premise->id,
            'estimate_lead_form' => $estimateLeadForm->id,
        ];
    }

    /**
     * Update premise data page 2
     *
     * @param Request $request
     * @param int $premiseId
     * @param int $formId
     * @return bool
     */

    public static function updatePremiseData(Request $request, int $premiseId, int $formId): bool
    {
        $estimateLeadForm = EstimateLeadForm::find($formId);

        if ($estimateLeadForm) {
            self::deleteFile($estimateLeadForm->file);
            $pathPageImage = self::storeFile($request);

            EstimateFormPremise::find($premiseId)->update($request->all());

            $pageData = ['estimate_id' => $request->get('estimate_id'), 'file' => $pathPageImage, 'premise_id' => $premiseId, 'page_number' => 2];

            $estimateLeadForm->update($pageData);

            return true;
        }

        return false;
    }

    /**
     * Save phase data page 3
     *
     * @param Request $request
     * @return array
     */

    public static function storePhase(Request $request): array
    {
        $pathPageImage = self::storeFile($request);

        $phase = EstimateFormPhase::create($request->all());

        $pageData = ['estimate_id' => $request->get('estimate_id'), 'file' => $pathPageImage, 'phase_id' => $phase->id, 'page_number' => 3];

        $estimateLeadForm = EstimateLeadForm::create($pageData);

        return [
            'estimate_lead_form_id' => $estimateLeadForm->id,
            'phase_id' => $phase->id,
        ];
    }

    /**
     * Update phase
     *
     * @param Request $request
     * @param int $phaseId
     * @param int $formId
     * @return bool
     */

    public static function updatePhase(Request $request, int $phaseId, int $formId): bool
    {
        $estimateLeadForm = EstimateLeadForm::find($formId);
        if ($estimateLeadForm) {
            self::deleteFile($estimateLeadForm->file);
            $pathPageImage = self::storeFile($request);

            EstimateFormPhase::find($phaseId)->update($request->all());

            $pageData = ['estimate_id' => $request->get('estimate_id'), 'file' => $pathPageImage, 'phase_id' => $phaseId, 'page_number' => 3];

            $estimateLeadForm->update($pageData);

            return true;
        }

        return false;
    }

    /**
     * Upload file in system
     *
     * @param Request $request
     * @return string
     */

    public static function storeFile(Request $request): string
    {
        return $request->file('file')->store('attachments', 'public');
    }

    /**
     * Delete file from system
     *
     * @param string $filePath
     */

    public static function deleteFile(string $filePath)
    {
        Storage::delete(public_path($filePath));
    }
}