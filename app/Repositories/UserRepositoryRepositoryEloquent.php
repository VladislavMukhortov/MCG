<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Interfaces\UserRepositoryRepository;
use App\Entities\UserRepository;
use App\Entities\UserProfile;
use App\Entities\Contact;
use App\Entities\Client;
use App\Interfaces\UserProfileRepository;
use App\Validators\UserRepositoryValidator;
use Bouncer;

/**
 * Class UserRepositoryRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UserRepositoryRepositoryEloquent extends BaseRepository implements UserRepositoryRepository, UserProfileRepository
{

   

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UserRepository::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function create($data){
        
        $user=$this->model->create($data);
        Bouncer::assign($data['role'])->to( $user);
        Contact::saveContact($user->id);
        $UserProfile=UserProfile::saveProfile($data,$user->id);
        if($data['role']=='Client'){
            Client::saveClient($UserProfile->id, $data);
        }
        return $user;
    }

    public function update($data, $id){
      
        $user=$this->model->firstOrNew(['id'=>$id]);
        $user->fill($data)->save();
       
        Bouncer::assign($data['role'])->to($user);
        Contact::saveContact($user->id);
        $UserProfile=UserProfile::saveProfile($data,$user->id);
        if($data['role']=='Client'){
            Client::saveClient($UserProfile->id, $data);
        }
        return $user;
    }

   

    
    
    
}
