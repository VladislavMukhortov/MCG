<?php

namespace App\Http\Controllers\API\v_1\User;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepositoryEloquent;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $userRepository;
    
    public function __construct(UserRepositoryEloquent $userRepository)
    {
        $this->userRepository = $userRepository;
    }
     
    public function index()
    {
        $users = $this->userRepository->getRoles();

        return response()->json([
            'success' => true,
            'data' => [
                'users' => $users
            ]
        ], 200);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
       
        $this->userRepository->storeRole($request->all());

        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.user.store.success')
            ],
        ], 200);

    }

    public function show($id)
    {
        
        $role = \Bouncer::role()->find($id);

        return response()->json([
            'success' => true,
            'data' => [
                'role' => $role
            ]
        ], 200);

    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $this->userRepository->updateRole($request->all(), $id);

        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.user.update.success')
            ],
            'data' => [
                'id' => $id
            ]
        ], 200);


    }

    public function destroy($id)
    {
        $this->userRepository->deleteRole($id);

        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.user.destroy.success')
            ],
        ], 200);


    }
}
