<?php

namespace App\Http\Controllers\Api\v_1\Admin;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\NewPasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\AllUsersRepositoryEloquent;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    protected $loginController;

    protected $repository;

    public function __construct(AllUsersRepositoryEloquent $repository, LoginController $loginController)
    {
        $this->loginController  = $loginController;
        $this->repository       = $repository;
    }

    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'users' => $this->repository->index(),
            ],
        ]);
    }

    public function getUserRoles()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'userRoles' => $this->repository->getUserAvailableRoleList(new User()),
            ],
        ], 200);
    }

    public function store(Request $request) //todo request
    {
        $account = $this->repository->store(collect($request->all()));
        if ($request->has('role_id')) {
            $this->repository->assignRole($account, (int)$request->get('role_id'));
        }

        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.users.create.success'),
            ],
            'data' => [
                'userId' => $account->id,
            ],
        ], 200);
    }

    public function show($userID)
    {
        $user = $this->repository->show($userID);

        return response()->json([
            'success' => true,
            'data' => [
                'user' => $user,
            ],
        ]);
    }

    public function update(Request $request, $userId) //todo request
    {
        $user = User::find($userId);

        $this->repository->updateUser($user, collect($request->all()));
        if ($request->has('role_id')) {
            $this->repository->assignRole($user, $request->get('role_id'));
            if (Auth::id() === $user->id) {
                return response()->json([
                    'success' => true,
                    'redirect' => [
                        'type' => 'internal',
                        'link' => 'logout',
                    ],
                ], 200);
            }
        }

        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.users.update.success'),
            ],
        ], 200);
    }

    public function setPassword($userId, NewPasswordRequest $request)
    {
        $this->repository->updateUser(User::find($userId), collect($request->validated()));

        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.users.set_password.success'),
            ],
        ], 200);
    }

    public function destroy($userId)
    {
        $this->repository->delete($userId);

        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.users.delete.success'),
            ],
        ], 200);
    }
}
