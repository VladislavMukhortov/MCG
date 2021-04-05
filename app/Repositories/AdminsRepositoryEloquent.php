<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\AdminsRepository;
use App\Models\User;
use App\Validators\UserValidator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


/**
 * Class AdminsRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AdminsRepositoryEloquent extends BaseRepository implements AdminsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */

    protected $User;
    
    public function __construct(User $User){
        $this->User = $User;
    }

    public function model()
    {
        return User::class;
    }

    public function index()
    {
        return $this->User->whereIs(User::ROLE_ADMIN)->get();
    }

    public function store($data)
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
         
        $admin = $this->User->create($data);
        
    }

    public function show($id)
    {
        return $this->User->find($id);
    }

    public function update($data,$id)
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        return $this->User->find($id)->update($data);
    }

    public function delete($id)
    {
        $reads = $this->User->find($id)->delete();
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
