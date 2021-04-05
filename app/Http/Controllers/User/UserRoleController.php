<?php

namespace App\Http\Controllers\User;

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

        return view('Users.index', compact('users'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
       
        $users = $this->userRepository->storeRole($request->all());

        return redirect()->route('user-role.index');
    }

    public function show($id)
    {
        
        $role = \Bouncer::role()->find($id);

        return view('Users.view-edit',compact('role'));

    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $reads = $this->userRepository->updateRole($request->all(), $id);

        return redirect()->route('user-role.show', $id);
    }

    public function destroy($id)
    {
        $reads = $this->userRepository->deleteRole($id);

        return redirect()->route('user-role.index');
    }
}
