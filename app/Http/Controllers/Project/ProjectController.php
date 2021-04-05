<?php

namespace App\Http\Controllers\Project;

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
//        $this->authorizeResource(Project::class, 'project');
        $this->subcontractorRepository  = $subcontractorRepository;
        $this->projectRepository        = $projectRepository;
        $this->taskRepository           = $taskRepository;
        $this->userRepository           = $userRepository;
        $this->leadController           = $leadController;
    }

    /**
     * @param Request $request
     * @return Application|Factory|View|void
     * @throws AuthorizationException
     * @throws RepositoryException
     */
    public function index(Request $request)
    {
        $this->authorize('viewPage', new Project());

        if ($request->user()->is_admin || $request->user()->is_manager) {
            $projects = $this->projectRepository->with('lead')->all();
            $this->projectRepository->pushCriteria(AuthorCriteria::class);
            $ownProjects = $this->projectRepository->with('lead')->all();

            return view('Project.index', compact('projects', 'ownProjects'));
        }
        if ($request->user()->is_lead) { // todo another solution //return redirect()->action([LeadProjectController::class, 'index']); //todo not working without route defined
            return $this->leadController->index($request);
        }

        return abort(404);
    }

    public function show(Project $project, Request $request)
    {
        $this->authorize('view', $project);

        if ($request->user()->is_admin || $request->user()->is_manager) {
            $project->load(['payments', 'payouts', 'notes', 'address']);
            $subcontractors       = $this->subcontractorRepository->getAllNames();
            $representatives      = User::whereIs(User::ROLE_REPRESENTATIVE)->get();
            $allTasks             = $this->taskRepository->all();
            $lead_name = HelperController::nameLeadGenerate($project->lead_id);
            $fullAddress = HelperController::addressGenerate($project->address);
            return view('Project.view-edit', compact( 'lead_name','project', 'subcontractors', 'representatives', 'allTasks', 'fullAddress'));
        }
        if ($request->user()->is_lead) { // todo another solution //return redirect()->action([LeadProjectController::class, 'index']); //todo not working without route defined

            return $this->leadController->show($project, $request);
        }

        return abort(404);
    }

    public function create()
    {

    }

    public function store(ProjectUpdateRequest $request)
    {
        //
    }

    public function edit(Project $project)
    {

    }

    public function update(Project $project, ProjectUpdateRequest $request)
    {
        $this->authorize('update', new Project());


        $requestData = $request->validated();

        $project = $this->projectRepository->update($requestData, $project->id);
        $project->address()->update([
            'address' => $requestData['address'],
            'street'  => $requestData['street'],
            'state'   => $requestData['state'],
            'city'    => $requestData['city'],
            'zip'     => $requestData['zip'],
        ]);

        return redirect()->route('projects.show', $project->id);
    }

    public function destroy(Project $project)
    {
        $this->authorize('delete', new Project());

        $this->projectRepository->delete($project->id);

        $estimate = EstimateRepository::where('project', $project->id)->first();
        $estimate->project = null;
        $estimate->save();

        return redirect()->route('projects.index');
    }

    public function storePayment(Project $project, ProjectPaymentRequest $request)

    {

                if($request->input('payment_flag') === 'edit'){

                    $id = $request->input('payment_id');
                    $this->authorize('storePayment', $project);

                    $this->projectRepository->storePaymentEdit($project, collect($request->validated()), $id);
                }
                else {

                    $this->authorize('storePayment', $project);

                    $this->projectRepository->storePayment($project, collect($request->validated()));
                }

        return redirect()->route('projects.show', $project->id);
    }


    public function storePayout(Project $project, ProjectPayoutRequest $request)
    {

        if($request->input('payout_flag') === 'edit'){

            $id = $request->input('payout_id');
            $this->authorize('storePayout', $project);

            $this->projectRepository->storePayoutEdit($project, collect($request->validated()), $id);
        }else{

        $this->authorize('storePayout', $project);

        $this->projectRepository->storePayout($project, collect($request->validated()));

        }
        return redirect()->route('projects.show', $project->id);
    }



    public function storePayoutDelete($id_project, $id){


        $payout = Payout::find($id);

        $payout->delete();

        return redirect()->route('projects.show', $id_project);


    }

    public function storePaymentDelete($id_project, $id){


        $payment = Payment::find($id);

        $payment->delete();

        return redirect()->route('projects.show', $id_project);


    }

    public function showTask(Project $project, Task $task)
    {
        $this->authorize('showTask', $project);

        $representatives    = User::whereIs(User::ROLE_REPRESENTATIVE)->get();
        $allTasks           = $this->taskRepository->all();

        return view('Project.task-details', compact('project', 'task', 'allTasks', 'representatives'));
    }

    public function convert(Request $request)
    {

        $requestData = ($request->all());

        $lead = Leads::select('id', 'name', 'last_name')->find($requestData['lead_id']);

        $estimate = EstimateRepository::find($requestData['estimate_id']);

        $leadAddress = HelperController::explodeAddress($lead->address);

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

            return redirect('/projects');
        }
    }
}
