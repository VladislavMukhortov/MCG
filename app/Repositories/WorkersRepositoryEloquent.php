<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\WorkersRepository;
use App\Models\User;
use App\Validators\WorkersValidator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class WorkersRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class WorkersRepositoryEloquent extends BaseRepository implements WorkersRepository
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
         return User::whereIs(User::ROLE_WORKER)->get();
    }

    public function store($data)
    {
        try {
            if (isset($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            }

            $name = "";
            $name = isset($data['first']) ? $data['first'].' ':'';
            $name .= isset($data['last']) ? $data['last'].' ':'';
            $data['name'] = $name;
            $data['password'] = Hash::make(rand(1111111111, 999999999));
            // dd($data);
            $account = $this->User->create($data);
            \Bouncer::assign(User::ROLE_WORKER)->to($account);
        } catch (\Exception $e) {
            return false;
        }
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

        $user = $this->User->find($id);
        $user->update($data);
        \Bouncer::assign(User::ROLE_WORKER)->to($user);
        return $user;
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
