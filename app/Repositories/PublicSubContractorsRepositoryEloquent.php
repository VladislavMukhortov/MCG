<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\PublicSubContractorsRepository;
use App\Models\PublicSubContractors;
use App\Validators\PublicSubContractorsValidator;

/**
 * Class PublicSubContractorsRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PublicSubContractorsRepositoryEloquent extends BaseRepository implements PublicSubContractorsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PublicSubContractors::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
