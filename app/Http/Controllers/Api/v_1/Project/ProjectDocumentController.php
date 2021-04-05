<?php

namespace App\Http\Controllers\Api\v_1\Project;

use App\Http\Controllers\Controller;
use App\Models\Leads;
use App\Models\ProjectDocument;
use App\Services\ProjectService;
use Illuminate\Http\Request;
use PDF;
use App\Models\Project;

class ProjectDocumentController extends Controller
{

    public function documentLead()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'documents' => ProjectDocument::find(auth('api')->user())
            ]
        ]);
    }

    public function store(Request $request)
    {
        $prj = Project::select(['id', 'lead_id'])->find($request->get('project_id'));

        $lead = Leads::select('name')->find($prj->lead_id);

        $projectDocument = ProjectDocument::create([
            'project_id' => $prj->id,
            'name' => ProjectService::makeDocumentName($request->get('document_type')),
            'subcontractor' => null,
            'lead' => $lead->name,
            'lead_id' => $lead->id,
            'status' => 'new',
            'date_sent' => null,
        ]);

        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.project_document.create.success'),
            ],
            'data' => [
                'project_document_id' => $projectDocument->id
            ]
        ]);

    }

    public function show(Request $request, $id)
    {

    }

    public function update(Request $request, $id)
    {
        $requestData = $request->all();
        $requestData['name'] = ProjectService::makeDocumentName($request->get('document_type'));

        ProjectDocument::find($id)->update([
            $requestData,
        ]);

        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.project_document.update.success'),
            ],
        ]);
    }

    public function destroy($id)
    {
        //
    }

    public function createDocumentPdf(Request $request)
    {
        $pdf = PDF::loadView(ProjectService::checkDocumentType($request->get('document_type')));

        return $pdf->download('document.pdf');
    }

    public function previewPdf(Request $request)
    {
        $project = Project::with('payments')->find($request->get('project_id'));
        $lead = Leads::with('address')->find($project->lead_id);

        return view(ProjectService::checkDocumentType($request->get('document_type')), compact('project', 'lead'));
    }

}
