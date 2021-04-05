<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\EstimateActivitiesRepository;
use App\Models\EstimateActivities;
use App\Validators\EstimateActivitiesValidator;

/**
 * Class EstimateActivitiesRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class EstimateActivitiesRepositoryEloquent extends BaseRepository implements EstimateActivitiesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return EstimateActivities::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
