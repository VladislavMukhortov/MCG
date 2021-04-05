<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class EstimateActivities.
 *
 * @package namespace App\Models;
 */
class EstimateActivities extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    public function notes(){
        return $this->hasOne(Notes::class, 'id', 'note_id');
    }

    public function attachment(){
        return $this->hasOne(Attachments::class, 'id', 'attachment_id');
    }

    public function activities(){
        return $this->hasOne(Activities::class, 'id', 'activities_id');
    }

}
