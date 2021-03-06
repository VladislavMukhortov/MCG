<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Interfaces\ContactAddressRepository;
use App\Entities\ContactAddress;
use App\Validators\ContactAddressValidator;

/**
 * Class ContactAddressRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ContactAddressRepositoryEloquent extends BaseRepository implements ContactAddressRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ContactAddress::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
