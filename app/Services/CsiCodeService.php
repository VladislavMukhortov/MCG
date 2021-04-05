<?php


namespace App\Services;


use App\Models\CsiCode;
use App\Models\CsiLevel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CsiCodeService
{
    /**
     * Get lvl 1
     *
     * @return CsiLevel
     */

    public static function getAllLvl_1(): CsiLevel
    {
        return CsiLevel::where('type', 'lvl1')->get();
    }

    /**
     * Get lvl 2
     *
     * @return CsiLevel
     */

    public static function getAllLvl_2(): CsiLevel
    {
        return CsiLevel::where('type', 'lvl2')->get();
    }

    /**
     * Get lvl 3
     *
     * @return CsiLevel
     */

    public static function getAllLvl_3(): CsiLevel
    {
        return CsiLevel::where('type', 'lvl3')->get();
    }

    /**
     * Get lvl 4
     *
     * @return CsiLevel
     */

    public static function getAllLvl_4(): CsiLevel
    {
        return CsiLevel::where('type', 'lvl4')->get();
    }

    /**
     * Get all csi levels in array
     *
     * @return array
     */

    public static function getCsiLevelsArray(): array
    {
        return [
            'level_1' => self::getAllLvl_1(),
            'level_2' => self::getAllLvl_2(),
            'level_3' => self::getAllLvl_3(),
            'level_4' => self::getAllLvl_4(),
        ];
    }

    /**
     * Save csi code
     *
     * @param array $data
     * @return JsonResponse
     */

    public static function createCsiCode(array $data): JsonResponse
    {
        $csi = CsiCode::create($data);

        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.csi_codes.create.success'),
            ],
            'data' => [
                'csiId' => $csi->id,
            ],
        ], 200);
    }

    /**
     * Update csi code
     *
     * @param array $data
     * @param int $id
     * @return JsonResponse
     */

    public static function updateCsiCode(array $data, int $id): JsonResponse
    {
        CsiCode::find($id)->update($data);

        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.csi_codes.update.success'),
            ],
        ], 200);
    }

    /**
     * Delete children csi level
     *
     * @param int $id
     * @return array
     */

    //todo Пример рекурсии для остальных функций (с) Влад
    public static function removeLevelChildren(int $id)
    {
        $forDel = [];

        $levelsForDelete = CsiLevel::select('id', 'parent_lvl_id')->where('parent_lvl_id', $id)->get();
        if ($levelsForDelete) {
            foreach ($levelsForDelete as $item) {
                $forDel[] = $item->id;
                $remCh = self::removeLevelChildren($item->id);
                if ($remCh) {
                    $forDel = array_merge($forDel, $remCh);
                }
            }
        }
        return $forDel;
    }

    /**
     * Delete children csi level
     *
     * @param array $ids
     * @param string $type
     */

    public static function deleteLevelFromCodeTree(array $ids, string $type)
    {
        if ($type == 'lvl1') {
            CsiCode::whereIn('level_1_id', $ids)
                ->orWhereIn('level_2_id', $ids)
                ->orWhereIn('level_3_id', $ids)
                ->orWhereIn('level_4_id', $ids)
                ->update([
                    'level_1_id' => null,
                    'level_2_id' => null,
                    'level_3_id' => null,
                    'level_4_id' => null,
                    ]);
        }
        if ($type == 'lvl2') {
            CsiCode::whereIn('level_2_id', $ids)
                ->orWhereIn('level_3_id', $ids)
                ->orWhereIn('level_4_id', $ids)
                ->update([
                    'level_2_id' => null,
                    'level_3_id' => null,
                    'level_4_id' => null,
                ]);
        }
        if ($type == 'lvl3') {
            CsiCode::whereIn('level_3_id', $ids)
                ->orWhereIn('level_4_id', $ids)
                ->update([
                    'level_3_id' => null,
                    'level_4_id' => null,
                ]);
        }
        if ($type == 'lvl4') {
            CsiCode::whereIn('level_4_id', $ids)
                ->update([
                    'level_4_id' => null,
                ]);
        }

    }

    /**
     * Check isset level from form request
     *
     * @param array $data
     * @return bool
     */

    //todo Скорее всего понадобиться рефакторинг (с) Влад
    public static function checkIssetLevels(array $data): bool
    {
        $level = CsiLevel::find($data['level_1_id']);
        if (!$level) {
            return false;
        } elseif ($level->type != 'lvl1') {
            return false;
        }

        if (isset($data['level_2_id'])) {
            $level = CsiLevel::find($data['level_2_id']);
        } else {
            return true;
        }

        if (!$level) {
            return false;
        } elseif ($level->type != 'lvl2') {
            return false;
        }

        if (isset($data['level_3_id'])) {
            $level = CsiLevel::find($data['level_3_id']);
        } else {
            return true;
        }

        if (!$level) {
            return false;
        } elseif ($level->type != 'lvl3') {
            return false;
        }

        if (isset($data['level_4_id'])) {
            $level = CsiLevel::find($data['level_4_id']);
        } else {
            return true;
        }

        if (!$level) {
            return false;
        } elseif ($level->type != 'lvl4') {
            return false;
        }

        return true;
    }

    public static function getEmpty($c)
    {

    }

    //todo Сделать рекурсию (с) Влад
    public static function getAllCsiTree(Collection $csiCodes): array
    {
        $AllCsiTree = [];

        foreach ($csiCodes as $csiCode) {
            if ($csiCode->level_4_id) {
                //Возможно потребует оптимизации в будущем (с) Влад
                $csi_level_1 = CsiLevel::find($csiCode->level_1_id);
                $csi_level_2 = CsiLevel::find($csiCode->level_2_id);
                $csi_level_3 = CsiLevel::find($csiCode->level_3_id);
                $csi_level_4 = CsiLevel::find($csiCode->level_4_id);
                $AllCsiTree[] = [
                    'id' => $csi_level_1->id,
                    'type' => $csi_level_1->type,
                    'name' => $csi_level_1->level_name,
                    'description' => $csi_level_1->level_description,
                    'code_id' => $csiCode->id,
                    'children' => [
                        'id' => $csi_level_2->id,
                        'type' => $csi_level_2->type,
                        'name' => $csi_level_2->level_name,
                        'description' => $csi_level_2->level_description,
                        'children' => [
                            'id' => $csi_level_3->id,
                            'type' => $csi_level_3->type,
                            'name' => $csi_level_3->level_name,
                            'description' => $csi_level_3->level_description,
                            'children' => [
                                'id' => $csi_level_4->id,
                                'type' => $csi_level_4->type,
                                'name' => $csi_level_4->level_name,
                                'description' => $csi_level_4->level_description,
                                'children' => [
                                    'id' => $csiCode->id,
                                    'type' => $csiCode->type,
                                    'name' => $csiCode->code_name,
                                ],
                            ],
                        ],
                    ],
                ];
            } elseif ($csiCode->level_3_id) {
                $csi_level_1 = CsiLevel::find($csiCode->level_1_id);
                $csi_level_2 = CsiLevel::find($csiCode->level_2_id);
                $csi_level_3 = CsiLevel::find($csiCode->level_3_id);
                $AllCsiTree[] = [
                    'id' => $csi_level_1->id,
                    'type' => $csi_level_1->type,
                    'name' => $csi_level_1->level_name,
                    'description' => $csi_level_1->level_description,
                    'code_id' => $csiCode->id,
                    'children' => [
                        'id' => $csi_level_2->id,
                        'type' => $csi_level_2->type,
                        'name' => $csi_level_2->level_name,
                        'description' => $csi_level_2->level_description,
                        'children' => [
                            'id' => $csi_level_3->id,
                            'type' => $csi_level_3->type,
                            'name' => $csi_level_3->level_name,
                            'description' => $csi_level_3->level_description,
                            'children' => [
                                'id' => 'empty',
                                'type' => 'empty',
                                'name' => '--empty--',
                                'children' => [
                                    'id' => $csiCode->id,
                                    'type' => $csiCode->type,
                                    'name' => $csiCode->code_name,
                                ],
                            ],
                        ],
                    ],
                ];
            } elseif ($csiCode->level_2_id) {
                $csi_level_1 = CsiLevel::find($csiCode->level_1_id);
                $csi_level_2 = CsiLevel::find($csiCode->level_2_id);
                $AllCsiTree[] = [
                    'id' => $csi_level_1->id,
                    'type' => $csi_level_1->type,
                    'name' => $csi_level_1->level_name,
                    'description' => $csi_level_1->level_description,
                    'code_id' => $csiCode->id,
                    'children' => [
                        'id' => $csi_level_2->id,
                        'type' => $csi_level_2->type,
                        'name' => $csi_level_2->level_name,
                        'description' => $csi_level_2->level_description,
                        'children' => [
                            'id' => 'empty',
                            'type' => 'empty',
                            'name' => '--empty--',
                            'children' => [
                                'id' => 'empty',
                                'type' => 'empty',
                                'name' => '--empty--',
                                'children' => [
                                    'id' => $csiCode->id,
                                    'type' => $csiCode->type,
                                    'name' => $csiCode->code_name,
                                ],
                            ],
                        ],
                    ],
                ];
            } elseif ($csiCode->level_1_id) {
                $csi_level_1 = CsiLevel::find($csiCode->level_1_id);
                $AllCsiTree[] = [
                    'id' => $csi_level_1->id,
                    'type' => $csi_level_1->type,
                    'name' => $csi_level_1->level_name,
                    'description' => $csi_level_1->level_description,
                    'code_id' => $csiCode->id,
                    'children' => [
                        'id' => 'empty',
                        'type' => 'empty',
                        'name' => '--empty--',
                        'children' => [
                            'id' => 'empty',
                            'type' => 'empty',
                            'name' => '--empty--',
                            'children' => [
                                'id' => 'empty',
                                'type' => 'empty',
                                'name' => '--empty--',
                                'children' => [
                                    'id' => $csiCode->id,
                                    'type' => $csiCode->type,
                                    'name' => $csiCode->code_name,
                                ],
                            ],
                        ],
                    ],
                ];
            } else {
                $AllCsiTree[] = [
                    'id' => 'empty',
                    'type' => 'empty',
                    'name' => '--empty--',
                    'code_id' => $csiCode->id,
                    'children' => [
                        'id' => 'empty',
                        'type' => 'empty',
                        'name' => '--empty--',
                        'children' => [
                            'id' => 'empty',
                            'type' => 'empty',
                            'name' => '--empty--',
                            'children' => [
                                'id' => 'empty',
                                'type' => 'empty',
                                'name' => '--empty--',
                                'children' => [
                                    'id' => $csiCode->id,
                                    'type' => $csiCode->type,
                                    'name' => $csiCode->code_name,
                                ],
                            ],
                        ],
                    ],
                ];
            }
        }

        return $AllCsiTree;
    }

}