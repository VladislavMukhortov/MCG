<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Contact.
 *
 * @package namespace App\Entities;
 */
class Contact extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_profile_id'];


    protected $guarded=['id'];


    protected $with=['userProfile'];


    public function initials(){
        $words = explode(" ", $this->name );
        $initials = null;
        foreach ($words as $w) {
            $initials .= $w[0];
        }
        return strtoupper($initials);
     }

     public function userProfile(){
        return $this->belongsTo(UserProfile::class,'user_profile_id', 'id');
     }
     

     public static function saveContact($user_id, $contact_id=0){
        $contact = Self::firstOrCreate([
            'user_profile_id'=>$user_id
        ]);
        return $contact;
     }

   
}
