<?php

namespace App\Http\Controllers\Api\v_1\Project;

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
    public function index(Request $request)
    {
        $this->projectRepository->pushCriteria(LeadCriteria::class);;

        return response()->json([
            'success' => true,
            'data' => [
                'projects' => $this->projectRepository->paginate(30),
            ],
        ], 200);
    }
    public function show($projectId, Request $request)
    {
        $project = Project::find($projectId);

        return response()->json([
            'success' => true,
            'data' => [
                'project'  => $project->load([ 'attachments', 'documents', 'payments', 'completionReports']),//todo filter by lead_id or not?
                'lineItems' => $project->estimates_line_items,
            ]

        ], 200);
    }
}
