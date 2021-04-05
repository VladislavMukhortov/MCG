<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Repositories\WorkersRepositoryEloquent;


class WorkersController extends Controller
{
    use AuthorizesRequests;

    protected $repository;

    public function __construct(WorkersRepositoryEloquent $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $this->authorize('viewAnyWorker', new User);

        $workers = $this->repository->index();
        return view('Admin.Workers.index', compact('workers'));

    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->authorize('createWorker', new User);

        $workers = $this->repository->store($request->all());
        return redirect()->route('workers.index');
    }

    public function show(User $worker)
    {
        $this->authorize('viewWorker', $worker);

        $reads = $worker;

        return view('Admin.Workers.view-edit', compact('reads'));

    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, User $worker)
    {
        $this->authorize('updateWorker', $worker);

        $reads = $this->repository->update($request->all(), $worker->id);
        return redirect()->route('workers.show', $worker->id);
    }

    public function destroy(User $worker)
    {
        $this->authorize('updateWorker', $worker);

        $reads = $this->repository->delete($worker->id);
        return redirect()->route('workers.index');
    }
}
