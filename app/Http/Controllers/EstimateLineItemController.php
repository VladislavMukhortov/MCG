<?php

namespace App\Http\Controllers;

use App\Models\EstimateRepository;
use App\Repositories\CSICodeCategoryRepositoryEloquent;
use App\Repositories\CSICodesRepositoryEloquent;
use App\Repositories\EstimateRepositoryLineItemsRepositoryEloquent;
use App\Repositories\EstimateRepositoryRepositoryEloquent;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class EstimateLineItemController extends Controller
{
    use AuthorizesRequests;

    protected $csiCodesCategoryRepository;
    protected $lineItemsRepository;
    protected $estimateRepository;
    protected $csiCodesRepository;

    public function __construct(EstimateRepositoryRepositoryEloquent $estimateRepository,
                                CSICodesRepositoryEloquent $csiCodesRepository,
                                CSICodeCategoryRepositoryEloquent $csiCodeCategoryRepositoryEloquent,
                                EstimateRepositoryLineItemsRepositoryEloquent $lineItemsRepository)
    {
        $this->csiCodesCategoryRepository   = $csiCodeCategoryRepositoryEloquent;
        $this->lineItemsRepository          = $lineItemsRepository;
        $this->estimateRepository           = $estimateRepository;
        $this->csiCodesRepository           = $csiCodesRepository;
    }

    public function saveLineItems(Request $request, $id)
    {
        $this->authorize('viewAny', new EstimateRepository());

        $lineItem = $this->estimateRepository->createLineItem(collect($request->only(['tree', 'folder', 'total'])), $id);

        return response()->json([
            'lineItems'     => $lineItem->csi_code,
            'lineItemId'    => $lineItem->id
        ]);
    }

    public function getLineItems($template_id = 0, Request $request)
    {
        $this->authorize('viewAny', new EstimateRepository());

        $data = $request->all();
        switch ($data['type']) {
            case 'level1':
                $data = $this->csil2codeRepository->where('csicode1', '=', $template_id)->get();
                $type = 'level2';
                $level2 = view('estimate.partials.li', compact('data', 'type'))->render();
                $data = $this->csilCodeRepository->where('csicode1', '=', $template_id)->get();
                $all_codes = view('estimate.partials.li', compact('data', 'type'))->render();

                return Response::json([
                    'level2' => $level2,
                    'all_codes' => $all_codes,

                ]);

                break;
            case 'level2':
                $data = $this->csil2codeRepository->where('csicode1', '=', $template_id)->get();
                $type = 'level3';
                $level3 = view('estimate.partials.li', compact('data', 'type'))->render();
                $data = $this->csilCodeRepository->where('csicode1', '=', $template_id)->get();
                $all_codes = view('estimate.partials.li', compact('data', 'type'))->render();
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
        $this->authorize('viewAny', new EstimateRepository());

        $categories = $this->csiCodesCategoryRepository->all()->groupBy('level.level');
        $csiCodes   = $this->csiCodesRepository->all();
        $estimates  = $this->estimateRepository->with('lineItems')->find($id);
        return response()->json([
            'categories'    => $categories,
            'csicodes'      => $csiCodes,
            'lineItems'     => !is_null($estimates->lineItems)
                ? $estimates->lineItems->csi_code
                : []
        ]);
    }
}
