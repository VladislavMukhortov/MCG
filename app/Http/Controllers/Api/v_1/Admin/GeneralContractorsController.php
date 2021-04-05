<?php

namespace App\Http\Controllers\Api\v_1\Admin;

use App\Http\Controllers\Controller;
use App\Models\GeneralContractors;
use Illuminate\Http\Request;
use App\Models\User;
use App\Repositories\GeneralContractorsRepositoryEloquent;


class GeneralContractorsController extends Controller
{
    protected $repository;

    public function __construct(GeneralContractorsRepositoryEloquent $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        return response()->json([
            'success' => true,
            'data' => [
                'generals' => $this->repository->index(),
            ],
        ]);
    }

    public function store(Request $request) //todo GeneralContractorStoreRequest
    {
        $general = $this->repository->store(collect($request->all()));
        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.generals.create.success'),
            ],
            'data' => [
                'generalId' => $general->id,
            ],
        ]);

    }
    public function show($generalContractorId)
    {
       return response()->json([
            'success' => true,
            'data' => [
                'generalContractor' => GeneralContractors::find($generalContractorId),
            ],
        ]);
    }

    public function update(Request $request, GeneralContractors $generalContractorId) //todo GeneralContractorUpdateRequest
    {
        $generalContractor = GeneralContractors::find($generalContractorId);
        $this->repository->updateWithUser($generalContractor, collect($request->all()));
        $generalContractor->refresh();

        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.generals.update.success'),
            ],
        ], 200);
    }

    public function destroy($generalContractorId)
    {

        $this->repository->deleteGeneralContractor(GeneralContractors::find($generalContractorId));

        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.generals.delete.success'),
            ],
        ], 200);
    }
}
