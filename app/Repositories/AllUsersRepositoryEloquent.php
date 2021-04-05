<?php

namespace App\Repositories;

use App\Http\Traits\Authorizable;
use Illuminate\Support\Collection;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\AllUsersRepository;
use App\Models\User;
use App\Validators\AllUsersValidator;
use App\Models\GeneralContractors;
use App\Models\SubContractors;
use App\Models\Leads;
use Illuminate\Support\Facades\Hash;


/**
 * Class AllUsersRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AllUsersRepositoryEloquent extends BaseRepository implements AllUsersRepository
{
    use Authorizable;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AllUsers::class;
    }

    protected $User;
    protected $General;
    protected $SubContractors;
    protected $Lead;

    
    public function __construct(User $User, GeneralContractors $General,SubContractors $SubContractors,Leads $Lead){
        $this->User = $User;
        $this->General = $General;
        $this->SubContractors = $SubContractors;
        $this->Lead = $Lead;

    }

    public function index()
    {
        return $this->User->get();
    }

    public function getRoleslist()
    {
        return \Bouncer::role()->all();
    }

    public function getUserAvailableRoleList(User $user)
    {
//        return \Bouncer::role()->when(is_null($user->lead), function ($query) {
//            return $query->where('name', '!=', User::ROLE_LEAD);
//        })->get(); //->pluck('title', 'id')
        return \Bouncer::role()->all(); //->pluck('title', 'id')
    }

    public function store(Collection $data)
    {
        $data = $data->prepend(1, 'user_status');
        $data = $data->map( function ($requestData, $key) {
            if ($key === 'password') {
                return Hash::make($requestData);
            }
            return $requestData;
        });

        return $this->User->create($data->toArray());
    }

    /**
     * @param User $user
     * @param int|null $roleId
     * @return User
     */
    public function assignRole(User $user, ?int $roleId)
    {
        $adminRole = \Bouncer::role()->whereName(User::ROLE_ADMIN)->first();
//        $accessed = $this->authorizeWithoutException('assignRole', [$user, $roleId === $adminRole->id]);

        \Bouncer::sync($user)->roles(!is_null($roleId) ? [$roleId] : []);

        if ($user->isA(User::ROLE_SUBCONTRACTOR)) {
            $user->subcontractor()->firstOrCreate(); //todo
        }

        if ($user->isA(User::ROLE_LEAD)) {
            //todo findOrCreate lead //request entity field is required
        }

        if ($user->isA(User::ROLE_GENERAL_CONTRACTOR)) {
            $user->generalContractor()->firstOrCreate(); //todo
        }

        return $user;
    }

    public function show($id)
    {
        return $this->User->find($id);
    }

    public function updateUser(User $user, Collection $data)
    {
        $data = $data->map( function ($requestData, $key) {
            if ($key === 'password') {
                return Hash::make($requestData);
            }
            return $requestData;
        });

        return $user->update($data->toArray());
    }

    public function update($data, $id) //todo refactor legacy
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }


        // $data['user_role_id'] = $id;

        $this->User->find($id)->update($data);  
        if (isset($data['user_role_id']) && $data['user_role_id'] == \Bouncer::role()->whereName(User::ROLE_GENERAL_CONTRACTOR)->first()->id) {
            $general['user_id'] = $id;
            $genContractor = $this->General->updateOrCreate($general);
            \Bouncer::assign(User::ROLE_GENERAL_CONTRACTOR)->to($genContractor);
        }elseif (isset($data['user_role_id']) && $data['user_role_id'] == \Bouncer::role()->whereName(User::ROLE_SUBCONTRACTOR)->first()->id) {
            $SubContractor['user_id'] = $id;
            // $this->User->find($id)->update($data);
            $sub = $this->SubContractors->updateOrCreate($SubContractor);
            \Bouncer::assign(User::ROLE_SUBCONTRACTOR)->to($sub);
        } 
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
