<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Interfaces\HomeOwnerRepository;
use App\Entities\HomeOwner;
use App\Validators\HomeOwnerValidator;

/**
 * Class HomeOwnerRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class HomeOwnerRepositoryEloquent extends BaseRepository implements HomeOwnerRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return HomeOwner::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
