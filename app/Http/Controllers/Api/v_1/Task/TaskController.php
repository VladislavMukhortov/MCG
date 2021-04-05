<?php

namespace App\Http\Controllers\Api\v_1\Task;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    /**
     * Get all tasks
     *
     * @return JsonResponse
     */

    public function index(): JsonResponse
    {
        if (session()->has('home')) {
            session()->forget('home');
            return response()->json([
                'success' => true,
                'redirect' => [
                    'type' => 'internal',
                    'link' => '/',
                ],
            ], 200);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'allTasks' => Task::paginate(30),
            ],
        ], 200);

    }

    /**
     * Create new task $fromId = id lead or project or subcontractor
     *
     * @param Request $request
     * @param int $fromId
     * @return JsonResponse
     */

    public function store(Request $request, int $fromId = 0): JsonResponse
    {
        $dataType = [];

        if ($request->get('type')) {
            $dataType = TaskService::buildTypeData($request->get('type'), $fromId);
        }

        if ($task = TaskService::storeTask($request, $dataType)) {
            return response()->json([
                'success' => true,
                'messages' => [
                    __('pages.task.store.success'),
                ],
                'data' => [
                    'taskId' => $task->id,
                ],

            ], 200);
        }
    }

    /**
     * Get task with relations, by id
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */

    public function show(Request $request, int $id): JsonResponse
    {
        if ($request->get('home')) {
            session(['home' => 'home']);
        }

        $task = Task::with('taskProject', 'leads', 'subcontractors')->find($id);

        return response()->json([
            'success' => true,
            'data' => [
                'task' => $task,
            ],
        ], 200);
    }

    /**
     * Update task
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */

    public function update(Request $request, int $id): JsonResponse
    {
        $taskRequest = $request->all();
        $taskRequest['due_date'] = date('Y-m-d H:i:s', strtotime($request->date . ' ' . $request->time . ''));

        if (Task::find($id)->update($taskRequest)) {
            return response()->json([
                'success' => true,
                'messages' => [
                    __('pages.task.update.success')
                ],
            ], 200);
        }
    }

    /**
     * Update task
     *
     * @param int $id
     * @return JsonResponse
     */

    public function destroy(int $id): JsonResponse
    {
        if (Task::find($id)->delete()) {
            return response()->json([
                'success' => true,
                'messages' => [
                    __('pages.task.destroy.success')
                ],
            ], 200);
        }
    }

    /**
     * Get tasks for lead or project or subcontractor
     *
     * @param Request $request
     * @return JsonResponse
     */

    public function taskForCurPage(Request $request): JsonResponse
    {
        if ($request->get('type') == 'lead') {
            return response()->json([
                'success' => true,
                'data' => [
                    'leadTasks' => Task::where('lead', '!=', null)->paginate(30),
                ],
            ], 200);
        }

        if ($request->get('type') == 'project') {
            return response()->json([
                'success' => true,
                'data' => [
                    'projectTasks' => Task::where('project', '!=', null)->paginate(30),
                ],
            ], 200);
        }

        if ($request->get('type') == 'subcontractor') {
            return response()->json([
                'success' => true,
                'data' => [
                    'subcontractorTasks' => Task::where('subcontractor', '!=', null)->paginate(30),
                ],
            ], 200);
        }

        return response()->json([
            'success' => true,
            'messages' => [
                'allTasks' => $this->index(),
            ],
        ], 200);
    }
}
