<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index()
    {
        $roles = \Bouncer::role()->all();

        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = \Bouncer::role()->find($id);
        $data=$request->all();
        \Bouncer::allow($role->name)->to(explode(",",$data['permissions']));
    }

    public function destroy($id)
    {
        //
    }
}
