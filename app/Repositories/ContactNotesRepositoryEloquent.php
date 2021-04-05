<?php

namespace App\Repositories;

use App\Models\Notes;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\ContactNotesRepository;
use App\Models\ContactNotes;
use App\Validators\ContactNotesValidator;

/**
 * Class ContactNotesRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ContactNotesRepositoryEloquent extends BaseRepository implements ContactNotesRepository
{
    /**
     * Specify Model class name
     *
     * @param Notes $Notes
     */

    protected $notes;

    public function __construct(Notes $notes){
        $this->notes = $notes;
    }

    public function model()
    {
        return ContactNotes::class;
    }

    public function getNotes($id)
    {
        return $this->notes->where('id', $id)->get();
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}