<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\RequestNotesRepository;
use App\Models\RequestNotes;
use App\Validators\RequestNotesValidator;

/**
 * Class RequestNotesRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class RequestNotesRepositoryEloquent extends BaseRepository implements RequestNotesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return RequestNotes::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
