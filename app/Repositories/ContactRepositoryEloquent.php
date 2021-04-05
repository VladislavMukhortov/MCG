<?php

namespace App\Repositories;

use App\Http\Controllers\HelperController;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\ContactRepository;
use App\Models\Contact;
use App\Validators\ContactValidator;
use App\Models\User;
use App\Models\Notes;
use App\Models\Request;
use Illuminate\Support\Facades\Hash;
use Auth;

/**
 * Class ContactRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ContactRepositoryEloquent extends BaseRepository implements ContactRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */

    protected $Contact;
    protected $User;
    protected $Notes;
    protected $Request;
    
    public function __construct(Contact $Contact , User $User , Notes $Notes , Request $Request){
        $this->Contact = $Contact;
        $this->User = $User;
        $this->Notes = $Notes;
        $this->Request = $Request;
    }

    public function model()
    {
        return Contact::class;
    }

    public function index()
    {
        return $this->Contact->where('created_by' , Auth::id())->with('address')->get();
    }

    public function getContacts()
    {
        return $this->Contact->with('address')->get();
    }

    public function getNoteslist($id)
    {
        return $this->Notes->where('contact' , $id)->get();    
    }

    public function getRequestslist($id)
    {
        return $this->Request->where('contact' , $id)->get();    
    }

    public function store($data)
    {
//        try {
            $data['name'] = $data['first'];
            $data['last_name'] = $data['last'];

            $data['created'] = date('Y-m-d H:i:s');
            $data['display_name'] = $data['name'] . '(' . $data['email'] . ')';
            $data['created_by'] = Auth::id();


            $contact = $this->Contact->create($data);
            $data['contact_id'] = $contact['id'];

            return $this->Contact->address()->create($data);
//        }
//        } catch (\Exception $e) {
//            return false;
//        }
    }

    public function show($id)
    {
        return $this->Contact->with('address')->find($id);
    }

    public function update($data, $id)
    {
        $data['name'] = $data['first'];
        $data['last_name'] = $data['last'];

        $this->Contact->find($id)->update($data);
        return $this->Contact->find($id)->address()->update([
            'address' => $data['address'],
            'street'  => $data['street'],
            'state'   => $data['state'],
            'city'    => $data['city'],
            'zip'     => $data['zip'],
        ]);
    }

    public function delete($id)
    {
        $this->Contact->find($id)->delete();
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
