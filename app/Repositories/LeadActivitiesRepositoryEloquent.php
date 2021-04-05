<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\LeadActivitiesRepository;
use App\Models\LeadActivities;
use App\Validators\LeadActivitiesValidator;

/**
 * Class LeadActivitiesRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class LeadActivitiesRepositoryEloquent extends BaseRepository implements LeadActivitiesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return LeadActivities::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
