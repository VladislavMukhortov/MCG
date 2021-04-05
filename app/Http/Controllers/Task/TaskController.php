<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HelperController;
use App\Models\Leads;
use App\Models\Task;
use App\Models\User;
use App\Repositories\TaskRepositoryEloquent;
use http\Env\Response;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;


class TaskController extends Controller
{
    protected $taskRepository;
    protected $userRepository;


    public function __construct(TaskRepositoryEloquent $taskRepository)
    {
        $this->authorizeResource(Task::class, 'task');
        $this->taskRepository = $taskRepository;
    }

    public function index(Request $request)
    {
        $requestData = $request->all();
        $leadId = key($requestData);

        if (session()->has('home')) {
            session()->forget('home');
            return redirect()->route('home');
        }
        return redirect()->route('leads.show', $leadId);
//        $all_task = $this->taskRepository->all();
//
//        return view('Task.index', compact('all_task'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $task = $request->all();
        $task['created_by'] = Auth::id();
        $task['due_date'] = date('Y-m-d H:i:s', strtotime($request->date . ' ' . $request->time . ''));
        $task['display_name'] = '(' . $request->name . ')';
        $task = $this->taskRepository->create($task);
        return redirect()->back();

    }

    public function show(Task $task, Request $request)
    {
        if ($request->get('home')) {
            session(['home' => 'home']);
        }
        $reads = $this->taskRepository->find($task->id);

        $all_task = $this->taskRepository->all();

        $representative = User::whereIs(User::ROLE_REPRESENTATIVE)->get();
        if (!$task->lead) {
            $leadName = null;
        } else {
            $leadName = HelperController::nameLeadGenerate($task->lead);
        }

        return view('Task.view-edit', compact('reads', 'all_task', 'representative', 'leadName'));
    }

    public function edit(Task $task)
    {
        //
    }

    public function update(Request $request, Task $task)
    {
        $taskRequest = $request->all();
        $task['due_date'] = date('Y-m-d H:i:s', strtotime($request->date . ' ' . $request->time . ''));
        $reads = $this->taskRepository->update($taskRequest, $task->id);
        return redirect()->route('task.show', $task);
    }

    public function destroy(Task $task)
    {
        $reads = $this->taskRepository->find($task->id)->delete();
        return redirect()->back();
    }
}
