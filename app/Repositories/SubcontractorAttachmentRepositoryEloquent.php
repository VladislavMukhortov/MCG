<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\SubcontractorAttachmentRepository;
use App\Models\SubcontractorAttachment;
use App\Validators\SubcontractorAttachmentValidator;

/**
 * Class SubcontractorAttachmentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class SubcontractorAttachmentRepositoryEloquent extends BaseRepository implements SubcontractorAttachmentRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return SubcontractorAttachment::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
