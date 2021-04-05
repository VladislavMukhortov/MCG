<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class SubcontractorNotes.
 *
 * @package namespace App\Models;
 */
class SubcontractorNotes extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    protected $guarded=['id'];

    public function notes(){
        return $this->hasOne(Notes::class, 'id', 'note_id');
    }

}
