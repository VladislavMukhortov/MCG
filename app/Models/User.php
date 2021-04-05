<?php

namespace App\Models;

use App\Models\User\Roleable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Silber\Bouncer\Database\HasRolesAndAbilities;


/**
 * Class User
 * @package App\Models
 * @property boolean is_lead
 * @property boolean is_manager
 * @property boolean is_admin
 * @property boolean is_subcontractor
 * @property boolean is_general_contractor
 */
class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, HasRolesAndAbilities, Roleable;

    public const STATUS_ACTIVE = 1;

    public const ROLE_GENERAL_CONTRACTOR    = 'General Contractor';
    public const ROLE_REPRESENTATIVE        = 'Representatives';
    public const ROLE_SUBCONTRACTOR         = 'Subcontractors';
    public const ROLE_MANAGER               = 'Managers';
    public const ROLE_WORKER                = 'Workers';
    public const ROLE_ADMIN                 = 'Admins';
    public const ROLE_LEAD                  = 'Lead';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_status',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

  /*  protected $appends = [
        'role_name', 'is_admin', 'is_active', 'is_manager', 'is_subcontractor', 'is_general_contractor'
    ]; //attributes stored in Roleable trait */

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function getIsActiveAttribute()
    {
        return $this->user_status === self::STATUS_ACTIVE;
    }

    public function generalContractor()
    {
        return $this->hasOne(GeneralContractors::class, 'user_id', 'id');
    }

    public function subcontractor()
    {
        return $this->hasOne(SubContractors::class, 'user_id');
    }

    public function lead()
    {
        return $this->hasOne(Leads::class, 'user_id');
    }

    public function account()
    {
        return $this->hasOne(Account::class, 'user_id');
    }

    public function receivedDocuments()
    {
        return $this->hasMany(Document::class, 'recipient_id');
    }

    public function sentDocuments()
    {
        return $this->hasMany(Document::class, 'sender_id');
    }

    public function getAddress(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public static function getAdminUser()
    {
        return self::whereIs(User::ROLE_ADMIN)->paginate(30);
    }

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class, 'event_user','user_id','event_id');
    }
}
