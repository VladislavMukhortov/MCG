<?php

namespace App\Repositories;

use App\Contracts\NotesRepository;
use App\Models\ContactNotes;
use App\Models\EstimateNotes;
use App\Models\LeadNotes;
use App\Models\Notes;
use App\Models\RequestNotes;
use App\Models\SubcontractorNotes;
use App\Models\TaskNotes;
use App\Validators\NotesValidator;
use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
/**
 * Class NotesRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class NotesRepositoryEloquent extends BaseRepository implements NotesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */

    protected $Notes;

    public function __construct(Notes $Notes){
        $this->Notes = $Notes;

    }

    public function model()
    {
        return Notes::class;
    }

    public function store($data)
    {
        $data['created_by'] = auth('api')->user()->id;
        $notes = $this->Notes->create($data);
        if(!empty($data['contact'])){
            return ContactNotes::create([
                'contact_id'=>$data['contact'],
                'note_id'=>$notes->id
            ]);
        }
        if(!empty($data['request'])){

            return RequestNotes::create([
                'request_id'=>$data['request'],
                'note_id'=>$notes->id
            ]);
        }
        if(!empty($data['estimate'])){
            return EstimateNotes::create([
                'estimate_id'=>$data['estimate'],
                'note_id'=>$notes->id
            ]);
        }
        if(!empty($data['lead'])){
            return LeadNotes::create([
                'lead_id'=>$data['lead'],
                'note_id'=>$notes->id
            ]);
        }
        if(!empty($data['subcontractor'])){
            return SubcontractorNotes::create([
                'subcontractor_id'=>$data['subcontractor'],
                'note_id'=>$notes->id
            ]);
        }
        if(!empty($data['task'])){
            return TaskNotes::create([
                'task_id'=>$data['task'],
                'note_id'=>$notes->id
            ]);
        }

        return $notes;

    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
