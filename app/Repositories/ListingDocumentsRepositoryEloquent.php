<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Interfaces\ListingDocumentsRepository;
use App\Entities\ListingDocuments;
use App\Validators\ListingDocumentsValidator;

/**
 * Class ListingDocumentsRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ListingDocumentsRepositoryEloquent extends BaseRepository implements ListingDocumentsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ListingDocuments::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
