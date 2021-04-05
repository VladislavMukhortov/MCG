<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\EstimateAttachmentRepository;
use App\Models\EstimateAttachment;
use App\Validators\EstimateAttachmentValidator;

/**
 * Class EstimateAttachmentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class EstimateAttachmentRepositoryEloquent extends BaseRepository implements EstimateAttachmentRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return EstimateAttachment::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
