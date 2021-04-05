<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\CsiController;
use App\Http\Requests\EstimateUpdateRequest;
use App\Http\Requests\InsertEstimateTemplateRequest;
use App\Models\CsiCode;
use App\Models\EstimateRepository;
use App\Models\EstimateTemplateRepository;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Repositories\EstimateRepositoryRepositoryEloquent;
use App\Repositories\CSIL1RepositoryEloquent;
use App\Repositories\CSIL2RepositoryEloquent;
use App\Repositories\EstimateTemplateRepositoryRepositoryEloquent;
use App\Repositories\CSIL3RepositoryEloquent;
use App\Repositories\CSICodesRepositoryEloquent;
use App\Repositories\LeadsRepositoryEloquent;

use Illuminate\Support\Facades\Auth;
use Response;

class EstimateController extends Controller
{
    use AuthorizesRequests;

    protected $estimateRepository;

    protected $estimateTemplateResository;

    protected $leadRepository;

    public function __construct(EstimateRepositoryRepositoryEloquent $estimateRepository,
                                EstimateTemplateRepositoryRepositoryEloquent $estimateTemplateResository,
                                LeadsRepositoryEloquent $leadRepository)
    {
        $this->estimateRepository = $estimateRepository;

        $this->estimateTemplateResository = $estimateTemplateResository;

        $this->leadRepository = $leadRepository;
    }

    public function index(Request $request)
    {

        $this->authorize('viewAny', new EstimateRepository());

        if ($request->user()->is_admin || $request->user()->is_manager) {
            //todo refactor(relocate body to Another Controller)
            $estimates      = $this->estimateRepository->index();
            $leadslist      = $this->estimateRepository->getLeadslist();
            $allestimates   = $this->estimateRepository->getEstimateslist();
//            $estimateLead    = $this->estimateRepository->getRequestLead();

            return view('estimate.index', compact('estimates', 'leadslist', 'allestimates'));
        }
        if ($request->user()->is_lead) {
            //todo refactor(relocate body to Another Controller)

            return $this->indexForLead($request);
        }

        return abort(404);
    }

    protected function indexForLead(Request $request)
    {
        $estimates = $this->estimateRepository->getLeadEstimates($request->user());

        return view('estimate.lead.index', compact('estimates'));
    }

    public function getLineItems(EstimateRepository $estimate)
    {
        $this->authorize('viewAny', new EstimateRepository()); //todo

        return $estimate->load('lineItems');

//        return response()->json([
//            'lineItems' => optional($estimate->lineItems)->csi_code,
//            'lineItemId' => optional($estimate->lineItems)->id
//        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->authorize('viewAny', new EstimateRepository());

        $estimate = $this->estimateRepository->store($request->all());
        return redirect()->route('estimate-reps.store');
    }

    public function show(EstimateRepository $estimate, Request $request)
    {
        $this->authorize('viewAny', new EstimateRepository());

        if ($request->user()->is_admin || $request->user()->is_manager) {
            return $this->showForAdmin($estimate, $request);
        }
        if ($request->user()->is_lead) {
            return $this->showForLead($estimate, $request);
        }
    }

    public function showForAdmin(EstimateRepository $estimate, Request $request)
    {
        $reads = $this->estimateRepository->with([
            'attachments',
            'estimateAttachments.attachment',
            'estimateNotes.notes',
            'lineItems',
            'questions',
            'leads',
        ])->find($estimate->id);
        $templatelist = $this->estimateTemplateResository->all();
        $attachmentTypes = $this->estimateRepository->getAttachmentTypes();

        foreach ($reads->attachments as $keyAttach => $attachment) {
            foreach ($attachmentTypes as $keyType => $attachmentType) {
                if ($attachment->estimate_attachment_type == ($keyType + 1) ) {
                    $reads->attachments[$keyAttach]['attachment_type'] = $attachmentTypes[$keyType];
                }
            }
        }

        $level_1 = CsiController::getAllLvl_1();
        $level_2 = CsiController::getAllLvl_2();
        $level_3 = CsiController::getAllLvl_3();
        $level_4 = CsiController::getAllLvl_4();

        $csiCodes = CsiCode::all();

        $allCsiTree = [];
        if ($csiCodes)
        {
            $allCsiTree = CsiController::getAllCsiTree($csiCodes);
        }

        $notelist = [];//$this->estimateRepository->getNoteslist($id);
        $attachmentlist = [];//$this->estimateRepository->getAttachmentslist($id);
        $activitylist = [];//$this->estimateRepository->getActivitieslist($id);


        return view('estimate.view-edit',
            compact('reads',
                'templatelist',
                'notelist',
                'attachmentlist',
                'activitylist',
                'attachmentTypes',
                'level_1', 'level_2',
                'level_3',
                'level_4',
                'csiCodes',
                'allCsiTree'
            ));
    }

    public function showForLead(EstimateRepository $estimate, Request $request)
    {
        $estimate->load(['attachments', 'lineItems', 'questions']);

        return view('estimate.lead.show', compact('estimate'));
    }

    public function edit(EstimateRepository $estimate)
    {
        //
    }

    public function update(EstimateUpdateRequest $request, EstimateRepository $estimate)
    {
        $this->authorize('viewAny', new EstimateRepository());

        $reads = $this->estimateRepository->update($request->validated(), $estimate->id);
        return redirect()->route('estimate-reps.show', $estimate->id);
    }

    public function destroy(EstimateRepository $estimate)
    {
        $this->authorize('viewAny', new EstimateRepository());

        $reads = $this->estimateRepository->delete($estimate->id);
        return redirect()->back();
    }

    public function insertEstimateTemplate(EstimateRepository $estimate, InsertEstimateTemplateRequest $request)
    {
        $this->authorize('viewAny', new EstimateRepository());

        $this->estimateRepository->createLineItemsFromTemplate($estimate, $request->get('estimate_template_id'));

        return redirect()->route('estimate-reps.show', $estimate)->with('success', 'Template Added Successfully');
    }

    public function updateEstimateTemplate(Request $request, $id)
    {
        $this->authorize('viewAny', new EstimateRepository());

        $this->estimateRepository->find($id)->update([
            'estimate_template' => $request->get('estimate_template')
        ]);
        return redirect(route('estimate-reps.show', ['estimate_rep' => $id]))->with('success', 'Template Added Successfully');
    }
}
