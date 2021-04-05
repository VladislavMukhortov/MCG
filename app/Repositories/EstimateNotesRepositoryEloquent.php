<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\EstimateNotesRepository;
use App\Models\EstimateNotes;
use App\Validators\EstimateNotesValidator;

/**
 * Class EstimateNotesRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class EstimateNotesRepositoryEloquent extends BaseRepository implements EstimateNotesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return EstimateNotes::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
