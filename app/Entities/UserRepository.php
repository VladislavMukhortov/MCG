<?php

namespace App\Entities;

use Hash;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Silber\Bouncer\Database\HasRolesAndAbilities;

/**
 * Class UserRepository.
 *
 * @package namespace App\Entities;
 */
class UserRepository extends Model implements Transformable
{
    use TransformableTrait;
    use HasRolesAndAbilities;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phonenumber',
        'contact_id'
    ];

    protected $table='users';

    protected $guarded=['id'];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];


    public function getRole(){

    }

    
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
   
    
     public function user(){
        return $this->hasOne(Contact::class,'id','user_id');
    }

    public function userProfile(){
        return $this->hasOne(UserProfile::class,'user_id','id');
    }


}
