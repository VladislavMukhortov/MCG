<?php

namespace App\Http\Controllers\Api\v_1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Repositories\AdminsRepositoryEloquent;
use Input;

class AdminsController extends Controller
{

    protected $repository;
    
    public function __construct(AdminsRepositoryEloquent $repository){
        $this->repository = $repository;
    }

    public function index()
    {   
        return response()->json([
            'success' => true,
            'data' => [
                'admins' => User::getAdminUser(),
            ],
        ], 200);
    }

    public function store(Request $request)
    {
        $this->repository->store($request->all());

        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.admins.create.success'),
            ],
            'data' => [
                'admins' => User::getAdminUser(),
            ],
        ], 200);
    }

    public function show($id)
    {
        return response()->json([
            'success' => true,
            'data' => [
                'admin' => User::find($id),
            ],
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->repository->update( $request->all(), $id);

        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.admins.update.success'),
            ],
        ], 200);
    }

    public function destroy($id)
    {
        $this->repository->delete($id);

        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.admins.delete.success'),
            ],
        ], 200);
    }
}
