<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class EstimateRepositoryLineItems.
 *
 * @package namespace App\Models;
 */
class EstimateRepositoryLineItems extends Model implements Transformable
{
    use TransformableTrait;

    const TYPE_CATEGORY = 2;
    const TYPE_CODE     = 1;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'estimate_id', 'csi_code', 'folder'
    ];

    protected $casts = [
        'csi_code' => 'array',

    ];

    public function estimate()
    {
        return $this->belongsTo(EstimateRepository::class, 'estimate_id');
    }

}
