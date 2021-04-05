<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class EstimateTemplateLineItemsRepository.
 *
 * @package namespace App\Models;
 */
class EstimateTemplateLineItemsRepository extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['estimate_template_id', 'csi_code', 'folder'];

    protected $table    = 'estimate_template_line_items';

    protected $guarded  = ['id'];

    protected $casts    = [
          'csi_code' => 'array'
    ];

}
