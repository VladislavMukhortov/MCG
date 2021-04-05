<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\AccountRequest;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Repositories\AccountRepositoryEloquent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AccountController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $repository;
    
    public function __construct(AccountRepositoryEloquent $repository){
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $user       = Auth::user();
        $account    = $this->repository->getUserAccount($user);

        return view('Account.index',compact('user','account'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request) //todo request
    {
        $this->repository->store($request->all());

        return redirect()->route('account-setting.index');

    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        //
    }

    public function update(User $user, AccountRequest $request)
    {
        if ($request->has(['name', 'email'])) {
            $this->repository->updateWithUserData($user, collect($request->only(['name', 'email', 'email_signature'])));
        }

        if ($request->has('password')) {
            $this->repository->updatePassword($user, collect($request->only(['password'])));
        }

        return redirect()->route('account-setting.index');
    }

    public function destroy(User $user)
    {
        //
    }
}
