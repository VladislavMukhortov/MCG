<?php

namespace App\Http\Controllers\Api\v_1;

use App\Http\Controllers\Admin\CsiController;
use App\Http\Controllers\GoogleApiController;
use App\Http\Requests\EstimateRequest;
use App\Http\Requests\InsertEstimateTemplateRequest;
use App\Http\Requests\UpdateEstimateTemplateRequest;
use App\Models\Attachments;
use App\Models\EstimateRepository;
use App\Models\HashLink;
use App\Models\Leads;
use App\Models\Notes;
use App\Models\Question;
use App\Services\EstimateService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Repositories\EstimateRepositoryRepositoryEloquent;
use App\Repositories\EstimateTemplateRepositoryRepositoryEloquent;
use App\Repositories\LeadsRepositoryEloquent;
use Illuminate\Support\Str;
use Response;

class EstimateController extends Controller
{
    use AuthorizesRequests;

    protected $estimateRepository;
    protected $estimateTemplateResository;
    protected $leadRepository;
    protected $estimateService;

    public function __construct (EstimateRepositoryRepositoryEloquent $estimateRepository, EstimateTemplateRepositoryRepositoryEloquent $estimateTemplateResository, LeadsRepositoryEloquent $leadRepository, EstimateService $estimateService)
    {
        $this->estimateRepository = $estimateRepository;
        $this->estimateTemplateResository = $estimateTemplateResository;
        $this->leadRepository = $leadRepository;
        $this->estimateService = $estimateService;
    }

    public function index ()
    {
        //
    }

    /**
     * Store estimate by ID
     *
     * @param EstimateRequest $request
     * @param EstimateService $estimateService
     * @return \Illuminate\Http\JsonResponse
     */
    public function store (EstimateRequest $request)
    {
        return response()->json(['success' => true, 'messages' => [__('pages.estimates.create.success'),], 'data' => ['estimate' => $this->estimateService->store($request->all())]], 200);
    }

    /**
     * Get estimate by ID
     *
     * @param EstimateRepository $estimate
     * @return \Illuminate\Http\JsonResponse
     */
    public function show (EstimateRepository $estimate)
    {
        return response()->json(['success' => true, 'data' => ['estimates' => $this->estimateService->show($estimate->id)]], 200);

    }

    /**
     * Update Estimate
     *
     * @param EstimateRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update (EstimateRequest $request, $id)
    {
        if (EstimateRepository::findOrFail($id)) {
            return response()->json(['success' => true, 'messages' => [__('pages.estimates.update.success'),], 'data' => ['estimate' => $this->estimateService->update($request->all(), $id)]], 200);
        }
    }

    /**
     * Delete estimate
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy ($id)
    {
        if (EstimateRepository::findOrFail($id)) {

            EstimateRepository::find($id)->delete();

            return response()->json(['success' => true, 'messages' => [__('pages.estimates.delete.success'),], 'data' => ['estimate' => $id]], 200);
        }
    }

    /**
     * Get all Estimates
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllEstimates ()
    {
        $allEstimates = EstimateRepository::with(['leads'])->get();

        return response()->json(['success' => true, 'data' => ['allEstimates' => $allEstimates]], 200);
    }

    /**
     * Get LineItems
     *
     * @param EstimateRepository $estimate
     * @return \Illuminate\Http\JsonResponse
     */
    public function getLineItems (EstimateRepository $estimate)
    {

        if (EstimateRepository::findOrFail($estimate->id)) {

            return response()->json(['success' => true, 'data' => ['lineItems' => $estimate->load('lineItems')]], 200);
        }
    }

    /**
     * Get Attachments by ID
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAttachments ($id)
    {
        $estimate = EstimateRepository::findOrFail($id);

        if ($estimate) {
            return response()->json(['success' => true, 'data' => ['attachments' => Attachments::where('estimate', $id)->select('id', 'file', 'attachment_description')->get()]], 200);
        }
    }

    /**
     * Get Notes by ID
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getNotes ($id)
    {
        $estimate = EstimateRepository::findOrFail($id);

        if ($estimate) {
            return response()->json(['success' => true, 'data' => ['notes' => Notes::where('estimate', $id)->select('id', 'notes')->get()]], 200);
        }
    }

    /**
     * Get Questions by ID
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getQuestions ($id)
    {
        $estimate = EstimateRepository::findOrFail($id);

        if ($estimate) {
            return response()->json(['success' => true, 'data' => ['questions' => Question::where('estimate_id', $id)->select('id', 'author_id', 'subject', 'description')->with('user')->get()]], 200);
        }

    }

    /**
     * Get Lead by ID
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getLead ($id)
    {
        $estimate = EstimateRepository::findOrFail($id);

        if ($estimate) {
            return response()->json(['success' => true, 'data' => ['lead' => EstimateRepository::where('id', $id)->select('lead_id', 'status', 'type')->with(['leads'])->find($id)]], 200);
        }

    }

    /**
     * Get list of Lead emails
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getEmails($id)
    {
        return response()->json([
            'success' => true,
            'data' => [
                'emails'  => EstimateRepository::findOrFail($id)->emails()->get()
            ]
        ], 200);

    }

    /**
     * Get list of templates
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getEstimateTemplateList ()
    {
        return response()->json(['success' => true, 'data' => ['templateList' => $this->estimateTemplateResository->all()]], 200);
    }

    public function insertEstimateTemplate ($estimateId, InsertEstimateTemplateRequest $request)
    {
        if (EstimateRepository::findOrFail($estimateId)) {

            $this->estimateService->createLineItemsFromTemplate($estimateId, $request->get('estimate_template_id'));

            return response()->json(['success' => true, 'messages' => [__('pages.estimates.insert_estimate_template.success')]], 200);
        }
    }

    public function updateEstimateTemplate (UpdateEstimateTemplateRequest $request, $id)
    {
        if (EstimateRepository::findOrFail($id)) {

            $this->estimateRepository->find($id)->update($request->all());

            return response()->json(['success' => true, 'messages' => [__('pages.estimates.update-estimate-template.success'),]], 200);
        }
    }

    /**
     * Send email to estimate to fill Start Completion Form
     *
     * @param $id
     * @param Leads $leads
     * @param GoogleApiController $googleApi
     * @return \Illuminate\Http\JsonResponse
     * @throws \Google\Exception
     */
    public function sendPreEstimateEmail ($id, Leads $leads, GoogleApiController $googleApi)
    {

        $lead = $leads->where('id', $id)->first();

        $generatedLink = HashLink::where('user_id', $lead->id)->first();

        if (isset($generatedLink['link'])) {

            $message = $googleApi->createMessage("noreply@moderncitigroup.com", $lead->email, "Create new request", "<p>Greetings $lead->name $lead->last_name at $lead->email.</p><p>Please, use link below to fill Start Completion Form.</p>" . URL::route('lead-form.show', $hash));

            $googleApi->sendMessage($message);

        } else {

            $hash = Str::random(10);

            HashLink::create(['lead_id' => $lead->id, 'user_id' => $lead->id, 'link' => $hash, 'type' => '1']);

            $message = $googleApi->createMessage("noreply@moderncitigroup.com", $lead->email, "Create new request", "<p>Greetings $lead->name $lead->last_name at $lead->email.</p><p>Please, use link below to fill Start Completion Form.</p>" . URL::route('lead-form.show', $hash));

            $googleApi->sendMessage($message);

        }

        return response()->json(['success' => true, 'messages' => [__('pages.estimates.email.success'),]], 200);

    }

    /**
     * Send email to estimate to fill Final Completion Form
     *
     * @param $id
     * @param Leads $leads
     * @param GoogleApiController $googleApi
     * @return \Illuminate\Http\JsonResponse
     * @throws \Google\Exception
     */
    public function sendFinalEstimateEmail ($id, Leads $leads, GoogleApiController $googleApi)
    {

        $lead = $leads->where('id', $id)->first();

        $generatedLink = HashLink::where('user_id', $lead->id)->first();

        if (isset($generatedLink['link'])) {

            $message = $googleApi->createMessage("noreply@moderncitigroup.com", $lead->email, "Create new request", "<p>Greetings $lead->name $lead->last_name at $lead->email.</p><p>Please, use link below to fill Start Completion Form.</p>" . URL::route('lead-form.show', $hash));

            $googleApi->sendMessage($message);

        } else {

            $hash = Str::random(10);

            HashLink::create(['lead_id' => $lead->id, 'user_id' => $lead->id, 'link' => $hash]);

            $message = $googleApi->createMessage("noreply@moderncitigroup.com", $lead->email, "Create new request", "<p>Greetings $lead->name $lead->last_name at $lead->email.</p><p>Please, use link below to fill Start Completion Form.</p>" . URL::route('lead-form.show', $hash));

            $googleApi->sendMessage($message);

        }

        return response()->json(['success' => true, 'messages' => [__('pages.estimates.email.success'),]], 200);

    }


}
