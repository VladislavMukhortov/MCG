<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class LeadsAttachment.
 *
 * @package namespace App\Models;
 */
class LeadsAttachment extends Model implements Transformable //todo refactor
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    protected $guarded=['id'];


    public function attachment(){  //todo refactor
        return $this->hasOne(Attachments::class,'id','attachment_id');
    }

}
