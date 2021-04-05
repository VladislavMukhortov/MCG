<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\EstimateRepositoryLineItemsRepository;
use App\Models\EstimateRepositoryLineItems;
use App\Validators\EstimateRepositoryLineItemsValidator;

/**
 * Class EstimateRepositoryLineItemsRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class EstimateRepositoryLineItemsRepositoryEloquent extends BaseRepository implements EstimateRepositoryLineItemsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return EstimateRepositoryLineItems::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
