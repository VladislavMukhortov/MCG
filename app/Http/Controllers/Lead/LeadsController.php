<?php

namespace App\Http\Controllers\Lead;

use App\Http\Controllers\Controller;;
use App\Http\Controllers\UserController;
use App\Http\Requests\SendEmailRequest;
use App\Http\Requests\LeadsRequest;
use App\Mail\Email;
use App\Models\Contact;
use App\Models\Leads;
use App\Repositories\LeadsRepositoryEloquent;
use App\Repositories\TaskRepositoryEloquent;
use App\Services\GoogleApiService;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\HelperController;
use Illuminate\Support\Str;
use phpseclib\Crypt\Hash;


class LeadsController extends Controller
{
    protected $repository;
    protected $taskRepository;
    protected $googleApi;


    public function __construct(LeadsRepositoryEloquent $repository, TaskRepositoryEloquent $taskRepository, GoogleApiService $googleApi)
    {
        $this->authorizeResource(Leads::class, 'lead');
        $this->repository = $repository;
        $this->taskRepository = $taskRepository;
        $this->googleApi = $googleApi;
    }

    public function index()
    {
        if (session()->has('home')) {
            session()->forget('home');
        }
        $leads = $this->repository->index();
        $allleads = $this->repository->getLeadslist();

        $states = HelperController::getStates();

        return view('Lead.index', compact('leads', 'allleads', 'states'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $userEmail = Leads::where('email', $request->get('email'))->first();

        if ($userEmail) {
            return $userEmail;
        } else {
            $dataRequest = $request->all();

            $request = $this->repository->store($dataRequest);
            $contact = Contact::create([
                'name' => HelperController::nameGenerate($dataRequest),
                'phone' => isset($dataRequest['phone']) ? $dataRequest['phone'] : null,
                'email' => isset($dataRequest['email']) ? $dataRequest['email'] : '',
                'lead' => $request->id,
                'created_by' => $lead['created_by'] = Auth::id(),
            ]);
            $request->address()->update([
                'contact_id' => $contact->id,
            ]);
            //$this->sendVerificationEmail($request->id);

            if ($request) {
                return redirect()->route('leads.index');
            }
            return redirect()->route('leads.index');
        }
    }

    public function show(Leads $lead)
    {
        $contactList = $this->repository->getContactslist($lead->id);

        $reads = $this->repository->show($lead->id);
        $activitylist = $this->repository->getActivitieslist($lead->id);
        $estimatelist = $this->repository->getEstimateslist($lead->id);
        $contactlist = $contactList->getContacts;
        $all_task = $this->taskRepository->all();
        $lead_task = $this->taskRepository->where('lead', $lead->id)->get();
        $requestlist = $this->repository->getRequestslist($lead->id);
        $attachmentlist = $this->repository->getAttachmentslist($lead->id);

        $states = HelperController::getStates();
        $allContacts = Contact::all();

        $fullAddress = HelperController::addressGenerate($reads->address);

        if (isset($contactlist)) {
            foreach ($allContacts as $key => $contact) {
                foreach ($contactlist as $hasContact) {
                    if ($contact->id === $hasContact->id) {
                        unset($allContacts[$key]);
                    } else{
                        continue;
                    }
                }

            }
        }
        $contacts = $allContacts;

        return view('Lead.view-edit', compact('fullAddress', 'reads', 'activitylist', 'estimatelist', 'contactlist', 'all_task', 'lead_task', 'requestlist', 'states', 'contacts', 'attachmentlist', 'lead'));
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

        $leads = $this->repository->update($request->all(), $lead->id);
        return redirect()->route('leads.show', $lead);

    }

    public function destroy(Leads $lead)
    {
        $lead = Leads::where('id', $lead->id)->first();
        $lead->delete();

        return redirect()->back();
////        $reads = $this->repository->delete($id);
//        return redirect()->route('leads.index');
    }

    /**
     * Send email to lead owner
     *
     * @param SendEmailRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Google\Exception
     */
    public function sendEmail(SendEmailRequest $request, $id)
    {
        $lead = Leads::find($id);

        $message = $this->googleApi->createMessage("noreply@moderncitigroup.com", $lead->email, "Message from MCG", "<p>Greetings $lead->name at $lead->email.</p><p>You have got a new message from the MCG team.</p><p></p><p>$request->subject</p><p>$request->body</p>");

        $this->googleApi->sendMessage($message);

        return redirect()->back()->with('email-success', 'Message sent.');
    }

    public function sendVerificationEmail(string $id)
    {
        $lead = Leads::find($id);

        if (empty($lead->token)) {
            return false;
        }

        $data = [
            'receiver' => $lead->email,
            'subject' => 'verification email',
            'body' => route('mailverification', $lead->token),
        ];

        Mail::to($lead->email)->send(new Email($data));

        return redirect()->route('leads.index')->with('link-sent', 'lead verified or does not exist');

    }

    public function checkUserToken(string $token)
    {
        $lead = Leads::where('token', $token)->first();

        if (!$lead) {
            redirect()->route('leads.index')->with('wrong-lead', 'lead verified or does not exist');
        }

        $user = UserController::createLeadUser($lead);

        if (!$user) {
            return redirect()->route('leads.index')->with('wrong-lead', 'user already not exist');
        }

        $lead->user_id = $user['id'];
        $lead->token = 'verified';
        $lead->save();

        UserController::sendUserPassword($user['password'], $user['email']);

        return redirect()->route('leads.index')->with('success-lead', 'success verification');
    }

}
