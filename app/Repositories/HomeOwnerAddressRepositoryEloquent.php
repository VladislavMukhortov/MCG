<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Interfaces\HomeOwnerAddressRepository;
use App\Entities\HomeOwnerAddress;
use App\Validators\HomeOwnerAddressValidator;

/**
 * Class HomeOwnerAddressRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class HomeOwnerAddressRepositoryEloquent extends BaseRepository implements HomeOwnerAddressRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return HomeOwnerAddress::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
