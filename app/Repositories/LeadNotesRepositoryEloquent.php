<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\LeadNotesRepository;
use App\Models\LeadNotes;
use App\Validators\LeadNotesValidator;

/**
 * Class LeadNotesRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class LeadNotesRepositoryEloquent extends BaseRepository implements LeadNotesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return LeadNotes::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
