<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Interfaces\ClientAddressRepository;
use App\Entities\ClientAddress;
use App\Validators\ClientAddressValidator;

/**
 * Class ClientAddressRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ClientAddressRepositoryEloquent extends BaseRepository implements ClientAddressRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ClientAddress::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
