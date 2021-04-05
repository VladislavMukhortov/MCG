<?php

namespace App\Http\Controllers\Api\v_1\CSI;

use App\Models\CsiCode;
use App\Services\CsiCodeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CsiCodeController extends Controller
{

    /**
     * Create new csi code
     *
     * @param Request $request
     * @return JsonResponse
     */

    public function store(Request $request): JsonResponse
    {
        $requestData = $request->all();
        $requestData['type'] = 'code';
        if ($requestData['level_1_id']) {
            if (CsiCodeService::checkIssetLevels($requestData)) {
                return CsiCodeService::createCsiCode($requestData);
            } else {
                return response()->json([
                    'success' => false,
                    'messages' => [
                        __('pages.csi_codes.create.wrong'),
                    ],
                ], 500);
            }
        }

        return CsiCodeService::createCsiCode($requestData);
    }

    /**
     * Update csi code
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */

    public function update(Request $request, int $id): JsonResponse
    {
        $requestData = $request->all();
        $requestData['type'] = 'code';
        if ($requestData['level_1_id']) {
            if (CsiCodeService::checkIssetLevels($requestData)) {
                return CsiCodeService::updateCsiCode($requestData, $id);
            } else {
                return response()->json([
                    'success' => false,
                    'messages' => [
                        __('pages.csi_codes.update.wrong'),
                    ],
                ], 500);
            }
        }

        return CsiCodeService::updateCsiCode($requestData, $id);
    }

    /**
     * Update csi code
     *
     * @param int $id
     * @return JsonResponse
     */

    public function destroy(int $id): JsonResponse
    {
        if ($csiCode = CsiCode::find($id)) {
            if ($csiCode->delete()) {
                return response()->json([
                    'success' => true,
                    'messages' => [
                        __('pages.csi_codes.delete.success'),
                    ],
                ], 200);
            }
        }
    }
}
