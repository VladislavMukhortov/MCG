<?php

namespace App\Repositories;

use App\Models\Leads;
use Illuminate\Support\Carbon;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\RequestRepository;
use App\Models\Request;
use App\Models\User;
use App\Models\Contact;
use App\Models\Notes;
use App\Models\Attachments;
use App\Models\Activities;
use App\Validators\RequestValidator;
use Auth;

/**
 * Class RequestRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class RequestRepositoryEloquent extends BaseRepository implements RequestRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */

    protected $Request;
    protected $Contact;
    protected $Notes;
    protected $Attachments;
    protected $Activities;

    public function __construct(Request $Request , Contact $Contact , Notes $Notes , Attachments $Attachments , Activities $Activities){
        $this->Request = $Request;
        $this->Contact = $Contact;
        $this->Notes = $Notes;
        $this->Attachments = $Attachments;
        $this->Activities = $Activities;
    }

    public function model()
    {
        return Request::class;
    }

    public function index()
    {
        return $this->Request->with(['contacts'])->where('created_by' , auth('api')->user()->id);
    }

    public function getRequestslist()
    {
        return $this->Request->get();
    }

    public function getContactslist()
    {
        return $this->Contact->get();
    }

    public function getNoteslist($id)
    {
        return $this->Notes->where('request' , $id)->get();
    }

    public function getAttachmentslist($id)
    {
        return $this->Attachments->where('request' , $id)->select('file','attachment_description')->get();
    }

    public function getActivitieslist($id)
    {
        return $this->Activities->where('request' , $id)->get();
    }

    public function store($data)
    {
        return $this->Request->create($data)->id;
    }

    public function show($id)
    {
        return $this->Request->with(['contacts','user'])->find($id);
    }

    public function update($data,$id)
    {
        $this->Request->find($id)->update($data);
    }

    public function delete($id)
    {
        $this->Request->find($id)->delete();
    }

    public function getRequestLead($leadId)
    {
        return Leads::find($leadId);
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
