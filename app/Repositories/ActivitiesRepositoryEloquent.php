<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\ActivitiesRepository;
use App\Models\Activities;
use App\Validators\ActivitiesValidator;

/**
 * Class ActivitiesRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ActivitiesRepositoryEloquent extends BaseRepository implements ActivitiesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Activities::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
