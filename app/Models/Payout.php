<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Payout.
 *
 * @package namespace App\Models;
 */
class Payout extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date', 'project_id', 'subcontractor_id', 'amount', 'status_id'
    ];

    protected $appends = ['status_name', 'subcontractor_company_name'];

    protected $casts = [
        'date' => 'date'
    ];

    public function getStatusNameAttribute()
    {
        return optional($this->status)->name;
    }

    public function getSubcontractorCompanyNameAttribute()
    {
        return optional($this->subcontractor)->company_name;
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function subcontractor()
    {
        return $this->belongsTo(SubContractors::class);
    }

    public function status()
    {
        return $this->belongsTo(PayoutStatus::class);
    }

}
