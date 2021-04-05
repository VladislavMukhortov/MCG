<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\UsersRepository;
use App\Models\User;
use Silber\Bouncer\Database\Role;

/**
 * Class UsersRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UsersRepository
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

    public function getRoles()
    {
        return \Bouncer::role()->all();
    }

    public function index()
    {
        return $this->User->get();
    }
     

    public function store($data)
    {
        $account = $this->User->create($data); 
    }

    public function getAllByRole(?string $roleName = null)
    {
        return User::whereIs($roleName)->get();
    }

    public function storeRole($data) //todo legacy
    {
        $data['name']=$data['title'];
        $role = \Bouncer::role()->firstOrCreate([
            'name' => $data['name'],
            'title' =>$data['name'],
        ]);

        if(!empty($data['permissions'])){
            $permissions= explode(",",$data['permissions']);
            foreach($permissions as $permission){
                $per =  \Bouncer::ability()->firstOrCreate([
                    'name' => $permission,
                    'title' => $permission,
                ]);
                \Bouncer::allow( $role)->to( $per);
            }
        }
    }

    public function updateRole($data, $id) //todo legacy
    {
        $role = \Bouncer::role()->find($id);
        $role->update([ //todo change data keys, make different
            'name' => $data['user_role'],
            'title' =>$data['user_role'],
        ]);

        if(!empty($data['permissions'])){
            $permissions= collect(explode(",",$data['permissions']));

            $createdPermissionsIds = $permissions->map( function ($permissionName) {
                $permission = \Bouncer::ability()->firstOrCreate([
                    'name'  => $permissionName,
                    'title' => $permissionName,
                ]);
                return $permission->id;
            });

            $role->abilities()->sync($createdPermissionsIds);
        }

        return $role;
    }

    public function deleteRole($roleId)
    {
        return \Bouncer::role()->find($roleId)->delete();
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
