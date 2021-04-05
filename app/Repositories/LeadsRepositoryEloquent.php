<?php

namespace App\Repositories;

use App\Contracts\LeadsRepository;
use App\Http\Controllers\HelperController;
use App\Models\Address;
use App\Models\Leads;
use App\Models\Request;
use App\Models\User;
use App\Models\Contact;
use App\Models\Notes;
use App\Models\Attachments;
use App\Models\Activities;
use App\Models\EstimateRepository;
use App\Validators\LeadsValidator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Repositories\LeadsRepositoryRepository;
use Auth;


/**
 * Class LeadsRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class LeadsRepositoryEloquent extends BaseRepository implements LeadsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    protected $Lead;
    protected $Request;
    protected $User;
    protected $Contact;
    protected $Notes;
    protected $Attachments;
    protected $Activities;
    protected $EstimateRepository;
    protected $role_obj;


    public function __construct (Leads $Lead, Request $Request, User $User, Contact $Contact, Notes $Notes, Attachments $Attachments, Activities $Activities, EstimateRepository $EstimateRepository)
    {
        $this->Lead = $Lead;
        $this->Request = $Request;
        $this->User = $User;
        $this->Contact = $Contact;
        $this->Notes = $Notes;
        $this->Attachments = $Attachments;
        $this->Activities = $Activities;
        $this->EstimateRepository = $EstimateRepository;
        $this->role_obj = \Bouncer::role()->where('title', '=', User::ROLE_LEAD)->first();

    }

    public function model ()
    {
        return Leads::class;
    }

    public function getNoteslist ($id)
    {
        return $this->Notes->where('lead', $id)->get();
    }

    public function getAttachmentslist ($id)
    {
        return $this->Attachments->where('lead', $id)->get();
    }

    public function getActivitieslist ($id)
    {
        return $this->Activities->where('id', $id)->get();
    }

    public function getEstimateslist ($id)
    {
        return $this->EstimateRepository->where('lead_id', $id)->with('getCreatedby')->get();
    }

    public function getContactslist ($id)
    {
        return $this->Lead->with('getContacts', )->find($id);
    }

    public function index ()
    {
        return $this->Lead->with(['getUser', 'getRequest', 'leadsAttachment.attachment'])->where('created_by', Auth::id())->get();
    }

    public function store ($request)
    {

        $lead = [
            'user_id' => auth('api')->user() ? auth('api')->user()->id : NULL,
            'name' => $request->name,
            'token' => Str::random(50),
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'date_of_initial_contact' => null,
            'created' => Carbon::now()->toDateTimeString(),
            'created_by' => auth('api')->user() ? auth('api')->user()->id : NULL,
        ];

        $leadUser = $this->Lead->create($lead);
        \Bouncer::assign(User::ROLE_LEAD)->to($leadUser);

     /*   Contact::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'lead' => $request->id,
            'created_by' => $lead['created_by'] = auth('api')->user()->id,
        ]); */

        Address::create([
            'address' => $request->address,
            'street' => $request->street,
            'state'  => $request->state,
            'city'   => $request->city,
            'zip'    => $request->zip,
            'lead_id' => $leadUser->id,
        ]);


        return $leadUser;

//        $user = [];

//        try {
//
//            $request = $this->Request->with('contacts')->find($data['id']);
//            dd($request);
//            $user['name'] = $request->contacts->name;
//            $user['email'] = $request->contacts->email;
//            $user['user_status'] = 1;
//            $user['password'] = Hash::make(rand(1111111111, 999999999));
//
//
//            $userModel = $this->User->where('email', $user['email'])->first();
//
//
//            // echo "<pre>";
//            // print_r($checkEmail);exit;
//            /*if (isset($checkEmail)) {
//                return false;
//            }*/
//
//            if (!$userModel) {
//                $userModel = $this->User->create($user);
//            }
//
//            $lead['user_id'] = $userModel->id;
//            $lead['address'] = $request->contacts->address;
//            $lead['phone'] = $request->contacts->phone;
//            $lead['date_of_initial_contact'] = $request->contacts->created;
//            $lead['created'] = date('Y-m-d H:i:s');
//            $lead['created_by'] = Auth::id();
//            $lead['request'] = $data['id'];
//            $userrole = $this->Lead->create($lead);
//            \Bouncer::assign(User::ROLE_LEAD)->to($userrole);
//        } catch (\Exception $e) {
//            return false;
//        }


    }

    /**
     * Store new lead from initial form
     *
     * @param $request
     * @return mixed
     */
//    public function storeInitialLead ($request)
//    {
//
//        $leadId = Leads::create([
//            'name' => $request->name,
//            'last_name' => $request->lastname,
//            'phone' => $request->phone,
//            'email' => $request->email,
//            'created' => Carbon::now()->toDateTimeString(),
//
//
//        ])->id;
//
//        $leadData = $this->Lead;
//
//        $leadData->address()->create([
//            'address' => $request->address,
//            'street'  => $request->street,
//            'state'   => $request->state,
//            'city'    => $request->city,
//            'zip'     => $request->zip,
//            'lead_id' => $leadId
//        ]);
//
//
//        return $leadId;
//
//    }

    /**
     * Update Lead by secondary form
     *
     * @param $request
     */
    public function updateLead ($request)
    {

        Leads::where('id', $request->id)->update([
            'name' => $request->firstname,
            'last_name' => $request->lastname,
            'phone' => $request->phone,
            'email' => $request->email,
            'created' => Carbon::now()->toDateTimeString(),

        ]);

        $this->Lead->address()->where('id', $request->id)->update([
            'address' => $request->street1,
            'street'  => $request->street2,
            'state'   => $request->state,
            'city'    => $request->city,
            'zip'     => $request->zip,
        ]);

    }

    public function getLeadslist ()
    {
        return $this->Lead->get();
    }


    public function show ($id)
    {
        return $this->Lead->with(['address'])->find($id);
//        $leadModel = new LeadsRepositoryRepository;
//        $leads = $this->with(['leads'])->find($id);
//        $leads->status = $leadModel->getStatusAttribute($leads->status);

    }


    public function update ($request, $id)
    {
        $leadData = $this->Lead->find($id);
        $leadData->update($request->all());

        $leadData->address()->where('lead_id', $id)->update([
            'address' => $request->address,
            'street'  => $request->street,
            'state'   => $request->state,
            'city'    => $request->city,
            'zip'     => $request->zip,
        ]);

        $contactData = $this->Contact->where('lead', $leadData->id)->first();
        if ($contactData) {
            $contactData->update($request->all());
        }

    }


    public function delete ($id)
    {
        $lead = $this->Lead->find($id);
        $lead->address()->where('lead_id', $id)->destroy();

    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot ()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getRequestslist ($id)
    {
        return $this->Request->where('lead', $id)->with('user')->get();
    }
}
