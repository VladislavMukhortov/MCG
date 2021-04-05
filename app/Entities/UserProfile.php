<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class UserProfile.
 *
 * @package namespace App\Entities;
 */
class UserProfile extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'phonenumber',
        'emergancy_contact_name',
        'emergancy_contact_number',
        'driving_licence',
        'driving_licence_photo',
        'type',
        'rating',
        'company_name',
        'instagram_user_name'        
    ];


    public function getNameAttribute(){
        return $this->first_name." ". $this->last_name;
    }


    public function initials(){
        $words = explode(" ", $this->name );
        $initials = null;
        foreach ($words as $w) {
            $initials .= $w[0];
        }
        return strtoupper($initials);
     }



    public static function saveProfile($data,$id){
        $user_profile = self::firstOrCreate([
                            'user_id'=>$id
                        ]);
        $user_profile->fill($data)->save();
       return $user_profile;
    }

    public function user(){
        return $this->belongsTo(UserRepository::class, 'user_id', 'id');
    }

}
