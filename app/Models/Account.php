<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;


/**
 * Class Account.
 *
 * @package namespace App\Models;
 */
class Account extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public $timestamps = false;
    protected $fillable = ['user_id','calendar_sync_token','email_signature'];

    public function userData()
    {
    	return $this->hasOne(User::class, 'id', 'user_id');
    }

    public static function getUserAccount(int $userId)
    {
        return self::firstOrCreate(['user_id' => $userId]);
    }

}
