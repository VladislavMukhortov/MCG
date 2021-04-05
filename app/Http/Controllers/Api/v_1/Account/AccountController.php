<?php

namespace App\Http\Controllers\Api\v_1\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\AccountRequest;
use App\Models\Account;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Repositories\AccountRepositoryEloquent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AccountController extends Controller
{
    use AuthorizesRequests;

    protected $repository;
    
    public function __construct(AccountRepositoryEloquent $repository){
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $user = auth('api')->user();

        return response()->json([
            'success' => true,
            'data' => [
                'user'  => $user,
                'account' => Account::getUserAccount($user->id),
            ],
        ], 200);
    }

    public function store(Request $request) //todo request
    {
        $account = $this->repository->store($request->all());

        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.account.create.success'),
            ],
            'data' => [
                'accountId' => $account->id,
            ],
        ], 200);

    }

    public function show(User $user)
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

        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.account.update.success'),
            ],
        ], 200);
    }

    public function destroy(User $user)
    {
        //
    }
}
