<?php

namespace App\Repositories;

use App\Contracts\SubContractorsRepository;
use App\Models\SubContractors;
use App\Models\User;
use App\Models\Contact;
use App\Models\Notes;
use App\Models\Attachments;
use App\Validators\SubContractorsValidator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;


/**
 * Class SubContractorsRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class SubContractorsRepositoryEloquent extends BaseRepository implements SubContractorsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */

    protected $SubContractors;
    protected $User;
    protected $Notes;
    protected $Attachments;
    protected $Contact;


    public function __construct(SubContractors $SubContractors , User $User , Contact $Contact , Notes $Notes , Attachments $Attachments){
        $this->SubContractors = $SubContractors;
        $this->User = $User;
        $this->Contact = $Contact;
        $this->Notes = $Notes;
        $this->Attachments = $Attachments;
    }

    public function model()
    {
        return SubContractors::class;
    }

    public function getAllNames()
    {
        return SubContractors::select('id', 'company_name')->get();
    }


    public function getVendorslist()
    {
        return $this->SubContractors->get();
    }

    public function getNoteslist($id)
    {
        return $this->Notes->where('subcontractor' , $id)->get();
    }

    public function getAttachmentslist($id)
    {
        return $this->Attachments->where('subcontractor' , $id)->get();
    }

    public function getContactslist($id)
    {
        return $this->Contact->where('subcontractor' , $id)->get();
    }

    public function index()
    {
        // return $this->SubContractors->with('userGetdata')->get();
        return $this->SubContractors->whereHas('userGetdata', function(Builder $query){
            $query->with('role', function($query){
                $query->where('title', 'SubContractors');
            });
        })->get();
        // return $this->User->where('user_role_id' , 5)->get();

    }

    public function store($data)
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }else {
            $data['password'] = Hash::make(rand(1111111111, 999999999));
        }
        // dd($user);

        $name = "";
        $name = isset($data['first']) ? $data['first'].' ':'';
        $name .= isset($data['last']) ? $data['last'].' ':'';
        $data['name'] = $name;
        $user = $this->User->create($data);
        $data['user_id'] = $user->id;
        $name = "";
        $name = isset($data['first']) ? $data['first'].' ':'';
        $name .= isset($data['last']) ? $data['last'].' ':'';
        $data['primary_contact_name'] = $name;
        $address = "";
        $address = isset($data['address']) ? $data['address'].',':'';
        $address .= isset($data['street_address']) ? $data['street_address'].',':'';
        $address .= isset($data['state']) ? $data['state'].',':'';
        $address .= isset($data['city']) ? $data['city'].',':'';
        $address .= isset($data['zip']) ? $data['zip'].'.':'';
        $data['address'] = $address;

        // $data['parent_vendor'] =
        $admin = $this->SubContractors->create($data);
        // $data['parent_vendor'] = $admin->id;
        \Bouncer::assign(User::ROLE_SUBCONTRACTOR)->to($admin);

    }

    public function show($id)
    {
        return $this->SubContractors->with('userGetdata')->find($id);
    }

    public function update($data,$id)
    {
        $name = "";
        $name = isset($data['first']) ? $data['first'].' ':'';
        $name .= isset($data['last']) ? $data['last'].' ':'';
        $data['primary_contact_name'] = $name;
        $address = "";
        $address = isset($data['address']) ? $data['address'].',':'';
        $address .= isset($data['street_address']) ? $data['street_address'].',':'';
        $address .= isset($data['state']) ? $data['state'].',':'';
        $address .= isset($data['city']) ? $data['city'].',':'';
        $address .= isset($data['zip']) ? $data['zip'].'.':'';
        $data['address'] = $address;
        $this->SubContractors->find($id)->update($data);
        $name = "";
        $name = isset($data['first']) ? $data['first'].' ':'';
        $name .= isset($data['last']) ? $data['last'].' ':'';
        $data['name'] = $name;
        $this->SubContractors->with('userGetdata')->find($id)->userGetdata->update($data);
    }

    public function delete($id)
    {
        $this->User->find($id)->delete();
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
