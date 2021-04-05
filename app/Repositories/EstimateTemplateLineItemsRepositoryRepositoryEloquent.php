<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\EstimateTemplateLineItemsRepositoryRepository;
use App\Models\EstimateTemplateLineItemsRepository;
use App\Validators\EstimateTemplateLineItemsRepositoryValidator;

/**
 * Class EstimateTemplateLineItemsRepositoryRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class EstimateTemplateLineItemsRepositoryRepositoryEloquent extends BaseRepository implements EstimateTemplateLineItemsRepositoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return EstimateTemplateLineItemsRepository::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
