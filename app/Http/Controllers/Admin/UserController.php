<?php

namespace App\Http\Controllers\Admin;

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
        $this->authorizeResource(User::class, 'user');
        $this->loginController  = $loginController;
        $this->repository       = $repository;
    }

    public function index()
    {
        $users = $this->repository->index();
        $roleslist = $this->repository->getUserAvailableRoleList(new User());

        return view('Admin.users.index', compact('users', 'roleslist'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request) //todo request
    {
        $account = $this->repository->store(collect($request->all()));
        if ($request->has('role_id')) {
            $this->repository->assignRole($account, (int)$request->get('role_id'));
        }

        return redirect()->route('users.index');
    }

    public function show(User $user)
    {
        $reads = $this->repository->show($user->id);
        $roleslist = $this->repository->getUserAvailableRoleList($user);

        return view('Admin.users.view-edit', compact('reads', 'roleslist'));

    }

    public function edit(User $user)
    {
        //
    }

    public function update(Request $request, User $user) //todo request
    {
        $this->repository->updateUser($user, collect($request->all()));
        if ($request->has('role_id')) {
            $this->repository->assignRole($user, $request->get('role_id'));
            if (Auth::id() === $user->id) {
                return redirect()->route('logout');
            }
        }

        return redirect()->route('users.show', $user);
    }

    public function setPassword(User $user, NewPasswordRequest $request)
    {
        $this->authorize('setNewPassword', $user);

        $this->repository->updateUser($user, collect($request->validated()));

        return redirect()->route('users.show', $user);
    }

    public function destroy(User $user)
    {
        $reads = $this->repository->delete($user->id);

        return redirect()->route('users.index');
    }
}
