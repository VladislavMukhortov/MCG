<?php

namespace App\Models;

use App\Models\User;
use Database\Factories\GeneralContractorFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
/**
 * Class GeneralContractors.
 *
 * @package namespace App\Models;
 */
class GeneralContractors extends Model implements Transformable
{
    use TransformableTrait, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;

    protected $fillable = ['user_id','phone','address','website'];

    protected $appends = ['user_name', 'website_domain_name'];

    protected $casts = [
        'address' => 'array',
    ];

    public function getUserNameAttribute()
    {
        return optional($this->user)->name;
    }

    public function getWebsiteDomainNameAttribute()
    {
        return is_string($this->website) ? parse_url($this->website, PHP_URL_HOST) : null;
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function scopeUserId(Builder $query, ?User $user)
    {
        return $query->whereUserId(optional($user)->id)->whereNotNull('user_id');
    }

    /** @return GeneralContractorFactory */
    protected static function newFactory()
    {
        return GeneralContractorFactory::new();
    }
}
