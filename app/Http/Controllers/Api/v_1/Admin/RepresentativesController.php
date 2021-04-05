<?php

namespace App\Http\Controllers\Api\v_1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Repositories\RepresentativesRepositoryEloquent;



class RepresentativesController extends Controller
{

    protected $repository;
    
    public function __construct(RepresentativesRepositoryEloquent $repository){
        $this->repository = $repository;
    }

    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'representatives' => $this->repository->index(),
            ],
        ], 200);
    }

    public function store(Request $request)
    {
        $representative = $this->repository->store($request->all());

        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.representatives.create.success'),
            ],
            'data' => [
                'representativeId' => $representative->id,
            ],
        ], 200);
    }

    public function show($id)
    {
        return response()->json([
            'success' => true,
            'data' => [
                'representative' => $this->repository->show($id),
            ],
        ], 200);

    }

    public function update(Request $request, $id)
    {
        $representative = $this->repository->update( $request->all(), $id);

        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.representatives.update.success'),
            ],
            'data' => [
                'representativeId' => $representative->id,
            ],
        ], 200);
    }

    public function destroy($id)
    {
        $this->repository->delete($id);

        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.representatives.delete.success'),
            ],
        ], 200);
    }
}
