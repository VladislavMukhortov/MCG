<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\TaskNotesRepository;
use App\Models\TaskNotes;
use App\Validators\TaskNotesValidator;

/**
 * Class TaskNotesRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TaskNotesRepositoryEloquent extends BaseRepository implements TaskNotesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TaskNotes::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
