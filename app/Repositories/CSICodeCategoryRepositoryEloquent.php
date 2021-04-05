<?php

namespace App\Repositories;

use App\Models\CsiCode;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\CSICodeCategoryRepository;
//use App\Models\CSICodeCategory;
//use App\Validators\CSICodeCategoryValidator;

/**
 * Class CSICodeCategoryRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CSICodeCategoryRepositoryEloquent extends BaseRepository implements CSICodeCategoryRepository
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
//    public function getByLevel(int $lvl = 1)
//    {
//        return CSICodeCategory::whereLevelId($lvl)->get();
//    }
//
//    public function getChildByLevel(int $lvl = 1, $parentCategoryId = null)
//    {
//        return CSICodeCategory::whereLevelId($lvl)->whereJsonContains('parent', $parentCategoryId)->get();
//    }
//
//    /**
//     * Boot up the repository, pushing criteria
//     */
//    public function boot()
//    {
//        $this->pushCriteria(app(RequestCriteria::class));
//    }

}
