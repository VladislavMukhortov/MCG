<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\CsiController;
use App\Http\Requests\EstimateTemplateUpdateRequest;
use App\Models\CsiCode;
use App\Models\EstimateRepository;
use App\Models\EstimateTemplateRepository;
use App\Repositories\CSICodeCategoryRepositoryEloquent;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Repositories\EstimateTemplateRepositoryRepositoryEloquent;
use App\Repositories\CSICodesRepositoryEloquent;
use App\Repositories\EstimateTemplateLineItemsRepositoryRepositoryEloquent;
use mysql_xdevapi\Result;

class EstimateTemplateController extends Controller
{
    use AuthorizesRequests;

    protected $categoryRepo;

    protected $estimateTemplateRepository;

    protected $csiCodesRepository;

    protected $line_items;

    public function __construct(
        EstimateTemplateRepositoryRepositoryEloquent $estimateTemplateRepository,
        CSICodesRepositoryEloquent $csiCodesRepository,
        CSICodeCategoryRepositoryEloquent $categoryRepo,
        EstimateTemplateLineItemsRepositoryRepositoryEloquent $line_items
    )
    {
        $this->estimateTemplateRepository = $estimateTemplateRepository;
        $this->categoryRepo = $categoryRepo;
        $this->csiCodesRepository = $csiCodesRepository;
        $this->line_items=$line_items;
    }

    public function index()
    {
        $this->authorize('viewAny', new EstimateTemplateRepository());

        $all_templates = $this->estimateTemplateRepository->all();
        
        return view('estimate.estimate-template.index', compact('all_templates'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->authorize('viewAny', new EstimateTemplateRepository());

        $estimate_template = $this->estimateTemplateRepository->create($request->all());

        return redirect()->route('estimate-templates.index');
    }

    public function show(EstimateTemplateRepository $estimateTemplate)
    {
        $this->authorize('viewAny', new EstimateTemplateRepository());

        $reads = $this->estimateTemplateRepository->with('lineItems')->find($estimateTemplate->id);

        $level_1 = CsiController::getAllLvl_1();
        $level_2 = CsiController::getAllLvl_2();
        $level_3 = CsiController::getAllLvl_3();
        $level_4 = CsiController::getAllLvl_4();

        $csiCodes = CsiCode::all();

        $allCsiTree = [];

        if ($csiCodes)
        {
            $allCsiTree = CsiController::getAllCsiTree($csiCodes);
        }

        return view('estimate.estimate-template.view-edit', compact('level_1', 'level_2', 'level_3', 'level_4', 'csiCodes', 'allCsiTree', 'reads'));

//        $reads = $this->estimateTemplateRepository->with('lineItems')->find($estimateTemplate->id);
//
//        return view('estimate.estimate-template.view-edit', compact('reads'));
    }

    public function edit($id)
    {
        //to edit
    }

    /**
     * @param EstimateTemplateRepository $estimateTemplate
     * @param EstimateTemplateUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(EstimateTemplateRepository $estimateTemplate, EstimateTemplateUpdateRequest $request)
    {
        $this->authorize('update', $estimateTemplate);
        $this->estimateTemplateRepository->update($request->validated(), $estimateTemplate->id);

        return redirect()->route('estimate-templates.update', $estimateTemplate);
    }

    public function destroy(EstimateTemplateRepository $estimateTemplate)
    {
        $this->authorize('viewAny', new EstimateTemplateRepository());

        $this->estimateTemplateRepository->delete($estimateTemplate->id);

        return redirect()->route('estimate-templates.index');
    }

    public function getLineItems($template_id = 0, Request $request)
    {
        $this->authorize('viewAny', new EstimateTemplateRepository());

        $data = $request->all();
        switch ($data['type']) {
            case 'level1':
                $data = $this->csil2codeRepository->where('csicode1', '=', $template_id)->get();
                $type = 'level2';
                $level2 = view('estimate.estimate-template.partials.li', compact('data', 'type'))->render();
                $data = $this->csilCodeRepository->where('csicode1', '=', $template_id)->get();
                $all_codes = view('estimate.estimate-template.partials.li', compact('data', 'type'))->render();

                return Response::json([
                    'level2' => $level2,
                    'all_codes' => $all_codes,

                ]);

                break;
            case 'level2':
                $data = $this->csil2codeRepository->where('csicode1', '=', $template_id)->get();
                $type = 'level3';
                $level3 = view('estimate.estimate-template.partials.li', compact('data', 'type'))->render();
                $data = $this->csilCodeRepository->where('csicode1', '=', $template_id)->get();
                $all_codes = view('estimate.estimate-template.partials.li', compact('data', 'type'))->render();
                return Response::json([
                    'level3' => $level3,
                    'all_codes' => $all_codes
                ]);

                break;

            default:
                break;
        }
    }

    public function getCSICodes($id = null)
    {
        $this->authorize('viewAny', new EstimateTemplateRepository());

        $categories = $this->categoryRepo->all()->groupBy('level.level');
        $csiCodes = $this->csiCodesRepository->all();
        $estimate_template = $this->estimateTemplateRepository->with('lineItems')->find($id);
        return response()->json([
            'categories' => $categories,
            'csicodes' => $csiCodes,
            'lineItems' => !empty($estimate_template->lineItems) ? $estimate_template->lineItems->csi_code :[]
        ]);
    }

    public function saveLineItems(Request $request, $id)
    {
        $requestData = $request->all();

        $this->authorize('viewAny', new EstimateTemplateRepository());

        $this->estimateTemplateRepository->storeLineItem($requestData, $id);
    }

    public function removeTemplateLineItem(Request $request)
    {
        $this->authorize('viewAny', new EstimateTemplateRepository());

        $requestData = $request->all();

        $estimateTemplate = EstimateTemplateRepository::with('lineItems')->find($requestData['estimate_template_id']);

        if ($estimateTemplate) {
            $estimateTemplate->lineItems()->delete();
            return redirect()->back()->with('delete-success', 'Line item delete success!');
        }

        throw new \Exception('Something wrong upon attempt delete line item in estimate_template_line_items table', 500);
    }

    public static function countLineItems($itemsArr)
    {
        foreach ($itemsArr as $item) {
            if (array_key_exists("children", $item)) {
                return self::countLineItems($item["children"]);
            } else {
                return count($itemsArr);
            }
        }
    }
    //Надо сделать рекурсию!!!(С)Влад.
//    public function unsetLineItem($itemsArr, $item_id)
//    {
//        foreach ($itemsArr as $key_1 => &$level_1) {
//            if (array_key_exists("children", $level_1)) {
//                foreach ($level_1['children'] as $key_2 => &$level_2) {
//                    if (array_key_exists("children", $level_2)) {
//                        foreach ($level_2['children'] as $key_3 => &$level_3) {
//                            if (array_key_exists("children", $level_3)) {
//                                foreach ($level_3['children'] as $key_4 => &$level_4) {
//                                    if (array_key_exists("children", $level_4)) {
//                                        return false;
//                                    } elseif($item_id == $key_4) {
//                                        unset($itemsArr[$key_1]['children'][$key_2]['children'][$key_3]['children'][$key_4]);
//                                        if (empty($itemsArr[$key_1]['children'][$key_2]['children'][$key_3]['children'])) {
//                                            unset($itemsArr[$key_1]['children'][$key_2]['children'][$key_3]);
//                                            if (empty($itemsArr[$key_1]['children'][$key_2]['children'])) {
//                                                unset($itemsArr[$key_1]['children'][$key_2]);
//                                                if (empty($itemsArr[$key_1]['children'])) {
//                                                    unset($itemsArr[$key_1]);
//                                                }
//                                            }
//                                        }
//                                        return $itemsArr;
//                                    }
//                                }
//                            } elseif($item_id == $key_3) {
//                                unset($itemsArr[$key_1]['children'][$key_2]['children'][$key_3]);
//                                if (empty($itemsArr[$key_1]['children'][$key_2]['children'])) {
//                                    unset($itemsArr[$key_1]['children'][$key_2]);
//                                    if (empty($itemsArr[$key_1]['children'])) {
//                                        unset($itemsArr[$key_1]);
//                                    }
//                                }
//                                return $itemsArr;
//                            }
//                        }
//                    } elseif($item_id == $key_2) {
//                        unset($itemsArr[$key_1]['children'][$key_2]);
//                        if (empty($itemsArr[$key_1]['children'])) {
//                            unset($itemsArr[$key_1]);
//                        }
//                        return $itemsArr;
//                    }
//                }
//            } elseif($item_id == $key_1) {
//                unset($itemsArr[$key_1]);
//                return $itemsArr;
//            }
//        }
//    }
}
