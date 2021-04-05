<?php

namespace App\Repositories;

use App\Contracts\TaskRepository;
use App\Models\Task;
use App\Models\User;
use App\Validators\TaskValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class TaskRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TaskRepositoryEloquent extends BaseRepository implements TaskRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    // protected $User;

    // public function __construct(User $User){
    //     $this->User = $User;
    // }

    public function model()
    {
        return Task::class;
    }

    //  public function getUserlist()
    // {
    //     return $this->User->get();
    // }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
