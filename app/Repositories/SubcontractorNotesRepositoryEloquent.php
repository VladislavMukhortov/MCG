<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\SubcontractorNotesRepository;
use App\Models\SubcontractorNotes;
use App\Validators\SubcontractorNotesValidator;

/**
 * Class SubcontractorNotesRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class SubcontractorNotesRepositoryEloquent extends BaseRepository implements SubcontractorNotesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return SubcontractorNotes::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
