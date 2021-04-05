<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Client.
 *
 * @package namespace App\Entities;
 */
class Client extends Model implements Transformable
{
    use TransformableTrait;


    protected $with=['userProfile'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_profile_id'];


       public function initials(){
        $words = explode(" ", $this->name );
        $initials = null;
        foreach ($words as $w) {
            $initials .= $w[0];
        }
        return strtoupper($initials);
     }

    public function userProfile(){
        return $this->belongsTo(UserProfile::class, 'user_profile_id', 'id');
    }

     public static function saveClient($id, $data){
         $client = self::firstOrNew([
             'user_profile_id' => $id
         ]);
         $client->fill($data)->save();
         return $client;
     }


}
