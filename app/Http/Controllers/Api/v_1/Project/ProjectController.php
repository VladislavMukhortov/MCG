<?php

namespace App\Http\Controllers\Api\v_1\Project;

use App\Criteria\AuthorCriteria;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HelperController;
use App\Http\Requests\Project\ProjectPaymentRequest;
use App\Http\Requests\Project\ProjectPayoutRequest;
use App\Http\Requests\Project\ProjectUpdateRequest;
use App\Models\EstimateRepository;
use App\Models\Leads;
use App\Models\Project;
use App\Models\Request as RequestEloquent;
use App\Models\SubContractors;
use App\Models\Task;
use App\Models\User;
use App\Models\Payout;
use App\Models\Payment;
use App\Repositories\ProjectRepositoryEloquent;
use App\Repositories\SubContractorsRepositoryEloquent;
use App\Repositories\TaskRepositoryEloquent;
use App\Repositories\UserRepositoryEloquent;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Exceptions\RepositoryException;

class ProjectController extends Controller
{
    use AuthorizesRequests;

    protected $subcontractorRepository;
    protected $projectRepository;
    protected $userRepository;
    protected $taskRepository;
    protected $leadController;

    public function __construct(ProjectRepositoryEloquent $projectRepository, SubContractorsRepositoryEloquent $subcontractorRepository,
                                TaskRepositoryEloquent $taskRepository, UserRepositoryEloquent $userRepository,
                                LeadProjectController $leadController)
    {
        $this->subcontractorRepository  = $subcontractorRepository;
        $this->projectRepository        = $projectRepository;
        $this->taskRepository           = $taskRepository;
        $this->userRepository           = $userRepository;
        $this->leadController           = $leadController;
    }

    public function index(Request $request)
    {
        if ($request->user()->is_admin || $request->user()->is_manager) {
            $projects = $this->projectRepository->with('lead')->paginate(30);
            $this->projectRepository->pushCriteria(AuthorCriteria::class);

            return response()->json([
                'success' => true,
                'data' => [
                    'projects' => $projects,
                ],
            ], 200);
        }
        if ($request->user()->is_lead) { // todo another solution //return redirect()->action([LeadProjectController::class, 'index']); //todo not working without route defined
            return $this->leadController->index($request);
        }

        return abort(404);
    }

    public function getOwnProjects()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'ownProjects' => $this->projectRepository
                    ->where('author_id', auth('api')->user()->id)
                    ->with('lead')
                    ->paginate(30),
            ],
        ], 200);
    }

    public function show($projectId, Request $request)
    {
        if ($request->user()->is_admin || $request->user()->is_manager) {
            $project = Project::find($projectId);

            return response()->json([
                'project' => $project->load(['payments', 'payouts', 'notes', 'address']),
            ]);
        }
        if ($request->user()->is_lead) { // todo another solution //return redirect()->action([LeadProjectController::class, 'index']); //todo not working without route defined
            return $this->leadController->show(Project::find($projectId), $request);
        }

        return abort(404);
    }

    public function getAllSubcontractors()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'subcontractors' => SubContractors::select('id', 'company_name')
                    ->paginate(30),
            ],
        ], 200);
    }

    public function getAllRepresentatives()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'representatives' => User::whereIs(User::ROLE_REPRESENTATIVE)->paginate(30),
            ],
        ], 200);
    }

    public function allTasks()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'allTasks' => $this->taskRepository->paginate(30),
            ],
        ], 200);
    }
    public function store(ProjectUpdateRequest $request)
    {
        //
    }

    public function update($projectId, ProjectUpdateRequest $request)
    {
        $requestData = $request->validated();

        $project = $this->projectRepository->update($requestData, $projectId);
        $project->address()->update([
            'address' => $requestData['address'],
            'street'  => $requestData['street'],
            'state'   => $requestData['state'],
            'city'    => $requestData['city'],
            'zip'     => $requestData['zip'],
        ]);

        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.projects.update.success'),
            ],
        ], 200);
    }

    public function destroy(Project $project)
    {
        $this->projectRepository->delete($project->id);

        $estimate = EstimateRepository::where('project', $project->id)->first();
        $estimate->project = null;
        $estimate->save();

        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.projects.delete.success'),
            ],
        ], 200);
    }

    public function storePayment(Project $project, ProjectPaymentRequest $request)

    {
        if($request->input('payment_flag') === 'edit'){
            $id = $request->input('payment_id');
            $this->projectRepository->storePaymentEdit($project, collect($request->validated()), $id);
        }
        else {
            $this->projectRepository->storePayment($project, collect($request->validated()));
        }

        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.projects.store_payment.success'),
            ],
        ], 200);
    }


    public function storePayout(Project $project, ProjectPayoutRequest $request)
    {
        if($request->input('payout_flag') === 'edit'){
            $id = $request->input('payout_id');
            $this->projectRepository->storePayoutEdit($project, collect($request->validated()), $id);
        }else{
            $this->projectRepository->storePayout($project, collect($request->validated()));
        }

        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.projects.store_payout.success'),
            ],
        ], 200);
    }

    public function storePayoutDelete($id_project, $id)
    {
        $payout = Payout::find($id);
        $payout->delete();

        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.projects.payout_delete.success'),
            ],
        ], 200);
    }

    public function storePaymentDelete($id_project, $id)
    {
        $payment = Payment::find($id);
        $payment->delete();
        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.projects.payment_delete.success'),
            ],
        ], 200);
    }

    public function showTask($taskId)
    {
        return response()->json([
            'success' => true,
            'data' => [
                'task' => Task::find($taskId),
            ],
        ], 200);
    }

    public function convert(Request $request)
    {

        $requestData = ($request->all());

        $lead = Leads::select('id', 'name', 'last_name')->find($requestData['lead_id']);

        $estimate = EstimateRepository::find($requestData['estimate_id']);

        if ($estimate->project) {
            return redirect()->route('estimate-reps.show', $requestData['estimate_id'])
                ->with('project-exists', 'This estimate already has a project');
        } else {
            $projectCreate = Project::create([
                'lead_id' => $requestData['lead_id'],
                'name' => $lead['name'] . ' ' . $lead['last_name'],
                'author_id' => Auth::id(),
                'status_id' => 1,
                'start_date' => null,
                'finish_date' => null,
            ]);

            $lead->address()->update([
                'project_id' => $projectCreate->id,
            ]);

            $estimate->project = $projectCreate->id;
            $estimate->save();

            return response()->json([
                'success' => true,
                'messages' => [
                    __('pages.projects.convert.success'),
                ],
            ], 200);
        }
    }
}
