<?php

namespace App\Http\Controllers\Api\v_1\Admin;

use App\Http\Controllers\Controller;
use App\Models\CsiCode;
use App\Models\CsiLevel;
use Illuminate\Http\Request;
use App\Services\CsiCodeService;
use Illuminate\Http\JsonResponse;

class CsiController extends Controller
{

    /**
     * Get all csi levels
     *
     * @return JsonResponse
     */

    public function getCsiLevels(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => [
                'all_csi_levels' => CsiCodeService::getCsiLevelsArray(),
            ],
        ], 200);
    }

    /**
     * Get full csi tree
     *
     * @return JsonResponse
     */

    public function getCsiTree(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => [
                'allCsiTree' => CsiCodeService::getAllCsiTree(CsiCode::get()),
            ],
        ], 200);
    }

    /**
     * Get parents for form level 3
     *
     * @param Request $request
     * @return JsonResponse
     */

    public function getParentsLevel_3ForForm(Request $request): JsonResponse
    {
        $level_2 = CsiLevel::find($request->get('level_2'));

        return response()->json([
            'success' => true,
            'data' => [
                'level_1' => CsiLevel::find($level_2->parent_lvl_id),
                'level_2' => $level_2,
            ],
        ]);
    }

    /**
     * Get parents for form level 4
     *
     * @param Request $request
     * @return JsonResponse
     */

    public function getParentsLevel_4ForForm(Request $request)
    {
        $level_3 = CsiLevel::find($request->get('level_3'));
        $level_2 = CsiLevel::find($level_3->parent_lvl_id);

        return response()->json([
            'success' => true,
            'data' => [
                'level_1' => CsiLevel::find($level_2->parent_lvl_id),
                'level_2' => $level_2,
                'level_3' => $level_3,
            ],
        ]);
    }

    //todo Возможно функция не будет нужна в будущем (с) Влад
    public function csiCodeTree(Request $request)
    {
        if ($request->get('level_1')) {
            $level_1_children = CsiLevel::where('parent_lvl_id', $request->get('level_1'))->paginate(30);

            return response()->json([
                'success' => true,
                'data' => [
                    'level_1_children' => $level_1_children,
                ],
            ], 200);
        }

        if ($request->get('level_2')) {
            $level_2_children = CsiLevel::where('parent_lvl_id', $request->get('level_2'))->paginate(30);

            return response()->json([
                'success' => true,
                'data' => [
                    'level_2_children' => $level_2_children,
                ],
            ], 200);
        }

        if ($request->get('level_3')) {
            $level_3_children = CsiLevel::where('parent_lvl_id', $request->get('level_3'))->paginate(30);

            return response()->json([
                'success' => true,
                'data' => [
                    'level_3_children' => $level_3_children,
                ],
            ], 200);
        }

    }

    //todo Функуия возможно не понадобится в будущем (с) Влад
    public function csiCodeEdit(Request $request){

        CsiLevel::updateOrCreate(
            ['id' => $request->input('id')],
            ['level_name' => $request->input('name'),
                'level_description' => $request->input('description')
            ]
        );

        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.csi.edit.success')
            ],
        ], 200);
    }

    //todo Функуия возможно не понадобится в будущем (с) Влад
    public function csiCodeDelete($id = null){

        $levels = [
            'lvl1' => 1,
            'lvl2' => 2,
            'lvl3' => 3,
            'lvl4' => 4,
        ];

        $result = CsiLevel::find($id);

        $parents = [(int)$id];
        $quantity = 4 - $levels[$result->type];

        $result = $result->id;

        for($i=1; $i <= $quantity; $i++){
            $item = CsiLevel::where('parent_lvl_id', '=', $result)->get();
            if($item->isEmpty())break;

            $parents[] = $item[0]->id;
            $result = $item[0]->id;
        }

        CsiLevel::destroy($parents);


        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.csi.delete.success')
            ],
        ], 200);
    }
}
