<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Payment.
 *
 * @package namespace App\Models;
 */
class Payment extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['project_id', 'status_id', 'amount', 'due_date'];

    protected $appends = ['status_name', 'is_paid'];

    protected $casts = [
      'due_date' => 'date'
    ];

    public function getIsPaidAttribute()
    {
        return $this->status_id === PaymentStatus::STATUS_PAID;
    }

    public function getStatusNameAttribute()
    {
        return optional($this->status)->name;
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function status()
    {
        return $this->belongsTo(PaymentStatus::class);
    }

}
