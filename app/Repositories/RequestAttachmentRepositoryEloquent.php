<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\RequestAttachmentRepository;
use App\Models\RequestAttachment;
use App\Validators\RequestAttachmentValidator;

/**
 * Class RequestAttachmentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class RequestAttachmentRepositoryEloquent extends BaseRepository implements RequestAttachmentRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return RequestAttachment::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
