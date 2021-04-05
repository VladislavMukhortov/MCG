<?php

namespace App\Http\Controllers\Project;

use App\Criteria\LeadCriteria;
use App\Http\Controllers\Controller;
use App\Models\Leads;
use App\Models\Project;
use App\Repositories\ProjectRepositoryEloquent;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Prettus\Repository\Exceptions\RepositoryException;

class LeadProjectController extends Controller
{
    protected $projectRepository;


    public function __construct(ProjectRepositoryEloquent $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     * @throws AuthorizationException
     * @throws RepositoryException
     */
    public function index(Request $request)
    {
        $this->authorize('ViewAnyForLead', new Leads());

        $this->projectRepository->pushCriteria(LeadCriteria::class);;
        $projects = $this->projectRepository->all();

        return view('Project.leads.index', compact('projects'));
    }

    /**
     * @param Project $project
     * @param Request $request
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function show(Project $project, Request $request)
    {
        $this->authorize('leadOwn', $project);

        $project->load([ 'attachments', 'documents', 'payments', 'completionReports']); //todo filter by lead_id or not?
        $lineItems = $project->estimates_line_items;

        return view('Project.leads.show', compact('project', 'lineItems'));
    }
}
