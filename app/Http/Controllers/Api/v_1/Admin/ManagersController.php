<?php

namespace App\Http\Controllers\Api\v_1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Repositories\ManagersRepositoryEloquent;


class ManagersController extends Controller
{
    protected $repository;
    
    public function __construct(ManagersRepositoryEloquent $repository){
        $this->repository = $repository;
    }

    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'managers' => $this->repository->index(),
            ],
        ], 200);
    }

    public function store(Request $request)
    {
        $manager = $this->repository->store($request->all());

        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.managers.create.success'),
            ],
            'data' => [
                'managerId' => $manager->id,
            ],
        ], 200);

    }

    public function show($id)
    {
        return response()->json([
            'success' => true,
            'data' => [
                'Manager' => $this->repository->show($id),
            ],
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $this->repository->update( $request->all(), $id);

        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.managers.update.success'),
            ],
        ], 200);
    }

    public function destroy($id)
    {
       $this->repository->delete($id);

        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.managers.delete.success'),
            ],
        ], 200);
    }
}
