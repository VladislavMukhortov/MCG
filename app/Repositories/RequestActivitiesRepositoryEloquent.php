<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\RequestActivitiesRepository;
use App\Models\RequestActivities;
use App\Validators\RequestActivitiesValidator;

/**
 * Class RequestActivitiesRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class RequestActivitiesRepositoryEloquent extends BaseRepository implements RequestActivitiesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return RequestActivities::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
