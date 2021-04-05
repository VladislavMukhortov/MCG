<?php

namespace App\Http\Controllers\Api\v_1\Admin;

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
        $this->repository->index();

        return response()->json([
            'success' => true,
            'data' => [
                'workers' => $this->repository->index(),
            ],
        ], 200);
    }

    public function store(Request $request)
    {
        $worker = $this->repository->store($request->all());

        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.workers.create.success'),
            ],
            'data' => [
                'workerId' => $worker->id,
            ],
        ], 200);
    }

    public function show(User $workerId)
    {
        return response()->json([
            'success' => true,
            'data' => [
                'worker' => User::find($workerId),
            ],
        ], 200);
    }

    public function update(Request $request, $workerId)
    {
        $this->repository->update($request->all(), $workerId);

        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.workers.update.success'),
            ],
        ], 200);
    }

    public function destroy($workerId)
    {
        $this->repository->delete($workerId);

        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.workers.delete.success'),
            ],
        ], 200);
    }
}
