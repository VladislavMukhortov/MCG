<?php

namespace App\Http\Controllers\Api\v_1\CSI;

use App\Models\CsiLevel;
use App\Services\CsiCodeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CsiLevelController extends Controller
{
    /**
     * Create csi level
     *
     * @param Request $request
     * @return JsonResponse
     */

    public function store(Request $request): JsonResponse
    {
        $requestData = $request->all();
        if (isset($requestData['lvl3'])) {
            $csiLevel = CsiLevel::create([
                'level_name' => $requestData['name'],
                'level_description' => $requestData['description'],
                'type' => 'lvl4',
                'parent_lvl_id' => $requestData['lvl3'],
            ]);
        } elseif (isset($requestData['lvl2'])) {
            $csiLevel = CsiLevel::create([
                'level_name' => $requestData['name'],
                'level_description' => $requestData['description'],
                'type' => 'lvl3',
                'parent_lvl_id' => $requestData['lvl2'],
            ]);
        } elseif (isset($requestData['lvl1'])) {
            $csiLevel = CsiLevel::create([
                'level_name' => $requestData['name'],
                'level_description' => $requestData['description'],
                'type' => 'lvl2',
                'parent_lvl_id' => $requestData['lvl1'],
            ]);
        } else {
            $csiLevel = CsiLevel::create([
                'level_name' => $requestData['name'],
                'level_description' => $requestData['description'],
                'type' => 'lvl1',
                'parent_lvl_id' => null,
            ]);
        }

        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.csi_levels.create.success'),
            ],
            'data' => [
                'csiLevelId' => $csiLevel->id,
            ],
        ], 200);
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
        if (CsiLevel::find($id)->update($request->all())) {
            return response()->json([
                'success' => true,
                'messages' => [
                    __('pages.csi_levels.update.success'),
                ],
            ], 200);
        }
    }

    /**
     * Update csi code
     *
     * @param int $id
     * @return JsonResponse
     */

    public function destroy(int $id): JsonResponse
    {
        if ($level = CsiLevel::find($id)) {

            $delete = CsiCodeService::removeLevelChildren($id);
            CsiCodeService::deleteLevelFromCodeTree($delete, $level->type);
            $delete[] = $id;
            CsiLevel::destroy($delete);


            return response()->json([
                'success' => true,
                'messages' => [
                    __('pages.csi_levels.delete.success'),
                ],
                'data' => [
                    'deleteIds' => $delete
                ]
            ], 200);
        }
    }
}
