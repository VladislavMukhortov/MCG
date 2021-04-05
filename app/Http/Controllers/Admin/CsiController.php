<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CsiCodeCategoryUpdateRequest;
//use App\Models\CSICodeCategory;
//use App\Models\CSICodeLevel;
//use App\Models\CSICodes;
use App\Models\CsiCode;
use App\Models\CsiLevel;
use App\Repositories\CSICodeCategoryRepositoryEloquent;
use Illuminate\Http\Request;
use App\Repositories\CSICodesRepositoryEloquent;
use phpDocumentor\Reflection\Types\Boolean;

class CsiController extends Controller
{
    protected $csiCodeRepository;
    protected $csiCodeCategoryRepository;

    public function __construct(
        CSICodesRepositoryEloquent $csiCodeRepository,
        CSICodeCategoryRepositoryEloquent $csiCodeCategoryRepository
    )
    {
//        $this->authorizeResource(CSICodes::class, 'csicode');

        $this->csiCodeRepository = $csiCodeRepository;
        $this->csiCodeCategoryRepository = $csiCodeCategoryRepository;
    }

    public function index()
    {
//        $csiCodes = $this->csiCodeRepository->all();
//        $levels = CSICodeLevel::all();
//        $allCategories = $this->csiCodeCategoryRepository->all()->groupBy('level_id');

        $level_1 = self::getAllLvl_1();
        $level_2 = self::getAllLvl_2();
        $level_3 = self::getAllLvl_3();
        $level_4 = self::getAllLvl_4();

        $csiCodes = CsiCode::all();
        $allCsiTree = [];

        $allCsiTree = self::getAllCsiTree($csiCodes);



        return view('Admin.CSI.csi-code.index', compact('level_1', 'level_2', 'level_3', 'level_4', 'allCsiTree'));
    }

    public function create()
    {

    }

//    public function store(Request $request)
//    {
//        //
//    }
//
//    public function show(CSICodes $csicode)
//    {
//        //
//    }
//
//    public function edit(CSICodes $csiCode)
//    {
//        //
//    }
//CSICodeCategory $category,
    public function update(CsiCodeCategoryUpdateRequest $request)
    {
//        $this->csiCodeCategoryRepository->update($request->validated(), $category->id);
//        return redirect()->route('admin.csi.csicodel1');
    }

//    public function destroy(CSICodes $csicode)
//    {
//        //
//    }

    public static function getAllLvl_1()
    {
        return CsiLevel::where('type', 'lvl1')->get();
    }

    public static function getAllLvl_2()
    {
        return CsiLevel::where('type', 'lvl2')->get();
    }

    public static function getAllLvl_3()
    {
        return CsiLevel::where('type', 'lvl3')->get();
    }

    public static function getAllLvl_4()
    {
        return CsiLevel::where('type', 'lvl4')->get();
    }

    public function level_3(Request $request)
    {
        $level_2 = CsiLevel::find($request->get('level_2'));
        $level_1 = CsiLevel::find($level_2->parent_lvl_id);
        return $level_1;
    }

    public function level_4(Request $request)
    {
        $level_3 = CsiLevel::find($request->get('level_3'));
        $level_2 = CsiLevel::find($level_3->parent_lvl_id);
        $level_1 = CsiLevel::find($level_2->parent_lvl_id);
        return [
            'level_2' => $level_2,
            'level_1' => $level_1,
        ];
    }

    public static function getAllCsiTree($csiCodes)
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
                    'building_materials' => $csiCode->building_materials,
                    'decoration_materials' => $csiCode->decoration_materials,
                    'labor' => $csiCode->labor,
                    'subcontractors' => $csiCode->subcontractors,
                    'manufacturing' => $csiCode->manufacturing,
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
                    'building_materials' => $csiCode->building_materials,
                    'decoration_materials' => $csiCode->decoration_materials,
                    'labor' => $csiCode->labor,
                    'subcontractors' => $csiCode->subcontractors,
                    'manufacturing' => $csiCode->manufacturing,
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
                    'building_materials' => $csiCode->building_materials,
                    'decoration_materials' => $csiCode->decoration_materials,
                    'labor' => $csiCode->labor,
                    'subcontractors' => $csiCode->subcontractors,
                    'manufacturing' => $csiCode->manufacturing,
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
                    'building_materials' => $csiCode->building_materials,
                    'decoration_materials' => $csiCode->decoration_materials,
                    'labor' => $csiCode->labor,
                    'subcontractors' => $csiCode->subcontractors,
                    'manufacturing' => $csiCode->manufacturing,
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
                    'building_materials' => $csiCode->building_materials,
                    'decoration_materials' => $csiCode->decoration_materials,
                    'labor' => $csiCode->labor,
                    'subcontractors' => $csiCode->subcontractors,
                    'manufacturing' => $csiCode->manufacturing,
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

    public function csiCodeTree(Request $request)
    {
        if ($request->get('level_1')) {
            $level_1_children = CsiLevel::where('parent_lvl_id', $request->get('level_1'))->get();
            return $level_1_children;
        }

        if ($request->get('level_2')) {
            $level_2_children = CsiLevel::where('parent_lvl_id', $request->get('level_2'))->get();
            return $level_2_children;
        }

        if ($request->get('level_3')) {
            $level_3_children = CsiLevel::where('parent_lvl_id', $request->get('level_3'))->get();
            return $level_3_children;
        }

    }

    public function csiCodeEdit(Request $request){

        CsiLevel::updateOrCreate(
            ['id' => $request->input('id')],
            ['level_name' => $request->input('name'),
                'level_description' => $request->input('description')
            ]
        );
        return redirect()->route('admin.csi.csicodel1');
    }

    public function csiCodeDelete($id=null){

        $levels = [

            'lvl1' => 1,
            'lvl2' => 2,
            'lvl3' => 3,
            'lvl4' => 4,
        ];

        $result = CsiLevel::find($id);

        $this->removeLvlsFromCode($result);

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


        return redirect()->route('admin.csi.csicodel1');
    }

    public function removeLvlsFromCode(CsiLevel $result)
    {
        $lvlType = $result->type;


        if ($lvlType == 'lvl4') {
            $csiCodes = CsiCode::where('level_4_id', $result->id)->get();
            if ($csiCodes) {
                foreach ($csiCodes as $csiCode) {
                    $csiCode->update([
                        'level_4_id' => null,
                    ]);
                }
            }
        }

        if ($lvlType == 'lvl3') {
            $csiCodes = CsiCode::where('level_3_id', $result->id)->get();

            if ($csiCodes) {
                foreach ($csiCodes as $csiCode) {
                    $csiCode->update([
                        'level_4_id' => null,
                        'level_3_id' => null,
                    ]);
                }
            }
        }

        if ($lvlType == 'lvl2') {
            $csiCodes = CsiCode::where('level_2_id', $result->id)->get();

            if ($csiCodes) {
                foreach ($csiCodes as $csiCode) {
                    $csiCode->update([
                        'level_4_id' => null,
                        'level_3_id' => null,
                        'level_2_id' => null,
                    ]);
                }
            }
        }

        if ($lvlType == 'lvl1') {
            $csiCodes = CsiCode::where('level_1_id', $result->id)->get();

            if ($csiCodes) {
                foreach ($csiCodes as $csiCode) {
                    $csiCode->update([
                        'level_4_id' => null,
                        'level_3_id' => null,
                        'level_2_id' => null,
                        'level_1_id' => null,
                    ]);
                }
            }
        }
    }
}
