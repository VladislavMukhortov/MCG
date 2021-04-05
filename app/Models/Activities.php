<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Activities.
 *
 * @package namespace App\Models;
 */
class Activities extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['description','user','project','estimate','lead','request','email','created_at'];

    public function getuser(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user');
    }

    public function leads(): HasMany
    {
        return $this->hasMany(Leads::class, 'id', 'lead');
    }

}
