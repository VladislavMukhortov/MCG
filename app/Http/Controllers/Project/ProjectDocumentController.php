<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Models\Leads;
use App\Models\ProjectDocument;
use Illuminate\Http\Request;
use PDF;
use \App\Models\Project;

class ProjectDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $prj = Project::select(['id', 'lead_id'])->find($request->get('project_id'));
        $name = '';
        switch ($request->get('document_type')) {
            case 0:
                return false;
                break;
            case 1:
                $name = 'Work Agreement, Architectural';
                break;
            case 2:
                $name = 'Engineering Service Contract';
                break;
            case 3:
                $name = 'Home Improvement Contract';
                break;
        }

        $lead = Leads::select('name')->find($prj->lead_id);
        ProjectDocument::create([
            'project_id' => $prj->id,
            'name' => $name,
            'subcontractor' => null,
            'lead' => $lead->name,
            'status' => 'new',
            'date_sent' => null,
        ]);

        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function createDocumentPdf(Request $request)
    {
        $pdf = PDF::loadView('Project.pdf');

        return $pdf->download('demo.pdf');
    }

    public function previewPdf(Request $request)
    {
        return view('Project.pdf');
    }
}
