<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class EstimateTemplateRepository.
 *
 * @package namespace App\Models;
 */
class EstimateTemplateRepository extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['template_name', 'total', 'created_by'];

    
    public function user(){
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function lineItems(): BelongsToMany
    {
        return $this->belongsToMany(CsiCode::class, 'estimate_template_line_items', 'estimate_template_id', 'csi_code');
    }

}
