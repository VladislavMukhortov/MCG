<?php

namespace App\Http\Controllers\Api\v_1\Lead;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GoogleApiController;
use App\Http\Controllers\UserController;
use App\Http\Requests\SendEmailRequest;
use App\Http\Requests\LeadsRequest;
use App\Mail\Email;
use App\Models\Address;
use App\Models\Contact;
use App\Models\EstimateRepository;
use App\Models\LeadContact;
use App\Models\Leads;
use App\Models\Notes;
use App\Models\Question;
use App\Repositories\LeadsRepositoryEloquent;
use App\Repositories\TaskRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\HelperController;


class LeadController extends Controller
{
    protected $repository;
    protected $taskRepository;
    protected $googleApi;


    public function __construct(LeadsRepositoryEloquent $repository, TaskRepositoryEloquent $taskRepository, GoogleApiController $googleApi)
    {
        $this->authorizeResource(Leads::class, 'lead');
        $this->repository = $repository;
        $this->taskRepository = $taskRepository;
        $this->googleApi = $googleApi;
    }

    public function index()
    {
        /*    if (session()->has('home')) {
                session()->forget('home');
            }
            $leads = $this->repository->index();
            $allLeads = $this->repository->getLeadslist();

            $states = HelperController::getStates();

            return response()->json([
                'success' => true,
                'data' => [
                    'leads' => $leads,
                    'allLeads' => $allLeads,
                    'states' => $states
                ],
            ], 200); */

    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $userEmail = Leads::where('email', $request->get('email'))->first();

        if (!$userEmail) {
            $lead = $this->repository->store($request);

            return response()->json([
                'success' => true,
                'messages' => [
                    __('pages.leads.create.success')
                ],

                'data' => [
                    'lead' => $lead
                ]
            ], 200);

        } else {
            return response()->json([
                'success' => false,
            ], 200);

        }
    }

    public function show(Leads $lead)
{
    if ($lead->search) {
        $lead = Leads::search($lead->search);
    } elseif ($lead->orderBy) {
        $lead = Leads::orderBy($lead->orderByField, $lead->orderBy);
    } else {
        $lead = $this->repository->show($lead->id, $lead->id);
    }

    return response()->json([
        'success' => true,
        'data' => [
            'lead'  => $lead,
        ]
    ], 200);
}

    public function edit(Leads $lead)
    {
        //
    }

    /**
     * Update lead with validation
     *
     * @param Request $request
     * @param Leads $lead
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(LeadsRequest $request, Leads $lead)
    {

        $this->repository->update($request, $lead->id);

        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.leads.update.success')
            ],
            'data' => [
                'leadId' => $lead->id
            ]
        ], 200);

    }

    /**
     * Remove lead
     *
     * @param Leads $lead
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Leads $lead)
    {
        $lead = Leads::where('id', $lead->id)->first();

        $lead->requests()->delete();

        $lead->delete();

        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.leads.delete.success')
            ]
        ], 200);
    }

    /**
     * Get list of leads by user ID
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMyLeads(Leads $leads)
    {
        $userId = auth('api')->user()->id;

        $userLeads = Leads::where('user_id', $userId)->paginate(30);

        return response()->json([
            'success' => true,
            'data' => [
                'leads' => $userLeads
            ]
        ], 200);
    }

    /**
     * Get list of all leads
     *
     * @param Leads $leads
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllLeads(Leads $leads)
    {
        $allLeads =  $leads->paginate(30);


        return response()->json([
            'success' => true,
            'data' => [
                'leads' => $allLeads
            ]
        ], 200);


    }

    public function getContactList(Leads $lead)
    {
        $contacts = $this->repository->getContactslist($lead->id);
        $contacts = $contacts->getContacts;

        return response()->json([
            'success' => true,
            'data' => [
                'contacts'  => $contacts,
            ]
        ], 200);

    }

    public function getAllContacts()
    {
        $contacts = Contact::all();

        return response()->json([
            'success' => true,
            'data' => [
                'contacts'  => $contacts,
            ]
        ], 200);

    }

    public function getActivitiesList($id)
    {
        $activityList = $this->repository->getActivitieslist($id);

        return response()->json([
            'success' => true,
            'data' => [
                'activities'  => $activityList,
            ]
        ], 200);

    }

    public function getEstimatesList($id)
    {
        if(Leads::findOrFail($id)){
        return response()->json([
            'success' => true,
            'data' => [
                'estimates'  => $this->repository->getEstimateslist($id)
            ]
        ], 200);
        }
    }

    public function getAllTasks($id)
    {

        if(Leads::findOrFail($id)) {
            return response()->json([
                'success' => true,
                'data' => [
                    'tasks' => $this->taskRepository->where('lead', $id)->get(),
                ]
            ], 200);
        }
    }

    public function getTask($id, $taskId)
    {
        $task = $this->taskRepository->where('id', $taskId)->get();

        return response()->json([
            'success' => true,
            'data' => [
                'task'  => $task,
            ]
        ], 200);

    }

    public function getNotes($id, Leads $leads)
    {

        if(Leads::findOrFail($id)) {
            $notes = $leads->with('getNotes')->select('id')->find($id);
        return response()->json([
            'success' => true,
            'data' => [
                'notes'  => $notes->getnotes
            ]
        ], 200);
        }

    }

    public function getRequests($id)
    {

        if(Leads::findOrFail($id)) {
            return response()->json([
                'success' => true,
                'data' => [
                    'requests' => $this->repository->getRequestslist($id),
                ]
            ], 200);
        }
    }

    public function getAttachments($id)
    {

        if(Leads::findOrFail($id)) {
        return response()->json([
            'success' => true,
            'data' => [
                'attachments'  => $this->repository->getAttachmentslist($id),
            ]
        ], 200);
        }
    }

    public function getContacts($id, Leads $leads)
    {

        if(Leads::findOrFail($id)) {
            $contacts = $leads->with('getcontacts.getaddress')->select('id')->find($id);
            return response()->json([
                'success' => true,
                'data' => [
                    'contacts' => $contacts->getcontacts,
                ]
            ], 200);
        }
    }

    public function getQuestionsList($id)
    {
        if(Leads::findOrFail($id)) {
            return response()->json([
                'success' => true,
                'data' => [
                    'questions' => Question::where('lead_id', $id)->get()
                ]
            ], 200);
        }
    }

    public function getQuestion($id, $questionId, Question $question)
    {
        $question->where('id', $questionId)->with(['lead'])->get();

        return response()->json([
            'success' => true,
            'data' => [
                'question'  => $question,
            ]
        ], 200);
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
                'emails'  => Leads::findOrFail($id)->emails()->get()
            ]
        ], 200);

    }

    public function sendVerificationEmail(string $id)
    {
        $lead = Leads::find($id);

        if (empty($lead->token)) {
            return response()->json([
                'success' => false,
                'messages' => [
                    __('pages.leads.email.error')
                ]
            ], 200);
        }

        $data = [
            'receiver' => $lead->email,
            'subject' => 'verification email',
            'body' => route('mailverification', $lead->token),
        ];

        Mail::to($lead->email)->send(new Email($data));

        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.leads.email.success')
            ]
        ], 200);

    }

    public function checkUserToken(string $token)
    {
        $lead = Leads::where('token', $token)->first();

        if (!$lead) {

            return response()->json([
                'success' => false,
                'messages' => [
                    __('pages.leads.verification.warning_one')
                ]
            ], 200);


        }

        $user = UserController::createLeadUser($lead);

        if (!$user) {

            return response()->json([
                'success' => false,
                'messages' => [
                    __('pages.leads.verification.warning_two')
                ],
            ], 200);
        }

        $lead->user_id = $user['id'];
        $lead->token = 'verified';
        $lead->save();

        UserController::sendUserPassword($user['password'], $user['email']);

        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.leads.verification.success')
            ]
        ], 200);
    }

}
