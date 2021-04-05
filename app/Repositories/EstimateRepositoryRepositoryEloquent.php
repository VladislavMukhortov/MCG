<?php

namespace App\Repositories;

use App\Contracts\EstimateRepositoryRepository;
use App\Http\Controllers\UserController;
use App\Models\CsiCode;
use App\Models\EstimateRepository;
use App\Models\EstimateRepositoryLineItems;
use App\Models\EstimateTemplateRepository;
use App\Models\Leads;
use App\Models\Notes;
use App\Models\Attachments;
use App\Models\Activities;
use App\Models\EstimateTemplateLineItemsRepository;
use App\Models\User;
use App\Validators\EstimateRepositoryValidator;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;


/**
 * Class EstimateRepositoryRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class EstimateRepositoryRepositoryEloquent extends BaseRepository implements EstimateRepositoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */


    protected $EstimateRepository;
    protected $Leads;
    protected $EstimateTemplateRepository;
    protected $Notes;
    protected $Attachments;
    protected $Activities;

  
    public function index()
    {
        return $this->with(['leads'])->where('created_by' , Auth::id())->get();
    }

    public function model()
    {
        return EstimateRepository::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }


    
}
