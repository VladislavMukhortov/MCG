<?php

namespace App\Models;

use App\Observers\RequestsObserver;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class RequestNotes.
 *
 * @package namespace App\Models;
 */
class RequestNotes extends Model implements Transformable
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
