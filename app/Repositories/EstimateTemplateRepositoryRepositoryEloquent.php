<?php

namespace App\Repositories;

use App\Http\Controllers\EstimateTemplateController;
use App\Models\CsiCode;
use App\Models\EstimateTemplateLineItemsRepository;
use Illuminate\Support\Collection;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\EstimateTemplateRepositoryRepository;
use App\Models\EstimateTemplateRepository;
use App\Validators\EstimateTemplateRepositoryValidator;

/**
 * Class EstimateTemplateRepositoryRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class EstimateTemplateRepositoryRepositoryEloquent extends BaseRepository implements EstimateTemplateRepositoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return EstimateTemplateRepository::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }


    
}
