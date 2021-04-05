<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class SubcontractorStatus extends Model
{
    use HasFactory;

    public $timestamps = false;

    public const STATUS_PENDING_DOCUMENTS   = 1;
    public const STATUS_PENDING_APPROVAL    = 2;
    public const STATUS_REJECTED            = 3;
    public const STATUS_APPROVED            = 4;

    protected $fillable = [
        'name', 'title'
    ];

    public static function getStatusNames()
    {
        return collect([
            self::STATUS_PENDING_DOCUMENTS  => Str::snake('pending documents'),
            self::STATUS_PENDING_APPROVAL   => Str::snake('pending approval'),
            self::STATUS_REJECTED           => Str::snake('rejected'),
            self::STATUS_APPROVED           => Str::snake('approved'),
        ]);
    }

    /**
     * @return HasMany
     */
    public function subcontractors()
    {
        return $this->hasMany(SubContractors::class, 'status_id');
    }
}
