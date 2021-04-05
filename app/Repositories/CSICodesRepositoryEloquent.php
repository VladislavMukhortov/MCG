<?php

namespace App\Repositories;

use App\Models\CsiCode;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\CSICodesRepository;
//use App\Models\CSICodes;

/**
 * Class CSICodesRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CSICodesRepositoryEloquent extends BaseRepository implements CSICodesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CsiCode::class;
    }
//
//    /**
//     * Boot up the repository, pushing criteria
//     */
//    public function boot()
//    {
//        $this->pushCriteria(app(RequestCriteria::class));
//    }
//
//    public function latest(?int $count = 5)
//    {
//        return CSICodes::latest()->take($count)->get();
//    }

}
