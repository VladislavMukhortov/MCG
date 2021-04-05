<?php

namespace App\Models;

use App\Models\User;
use Database\Factories\SubcontractorFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class SubContractors.
 *
 * @package namespace App\Models
 */
class SubContractors extends Model implements Transformable
{
    use TransformableTrait, HasFactory;

    protected $table = 'subcontractors';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $attributes = [
        'status_id' => 1,
    ];

    public $timestamps = false;

    protected $fillable = [
        'user_id', 'company_name', 'primary_contact_name', 'phone', 'address', 'website', 'type', 'vendor_source',
        'parent_vendor', 'status_id', 'csi_code', 'entity_type', 'workers_compensation', 'licensed', 'general_liability',
        'crew_size', 'languages', 'drivers_license', 'has_tools', 'has_vehicle', 'years_of_experience', 'w9_uploaded',
        'coi_uploaded', 'license_uploaded'
    ];

    public function getNameAttribute()
    {
        return optional($this->user)->name ?? '';
    }

    public function getWebsiteDomainNameAttribute()
    {
        return is_string($this->website) ? parse_url($this->website, PHP_URL_HOST) : null;
    }

    public function getStatusNameAttribute()
    {
        return optional($this->status)->title ?? '';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function documents()
    {
        return $this->morphMany(Document::class, 'recipientable');
    }

    public function pendingDocuments()
    {
        return $this->morphMany(Document::class, 'recipientable')->whereStatusId(DocumentStatus::STATUS_PENDING);
    }

    public function userGetdata()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function vendor()
    {
        return $this->hasOne(__CLASS__, 'id', 'parent_vendor');
    }

    public function subContractorsNote()
    {
        return $this->hasMany(SubcontractorNotes::class, 'subcontractor_id', 'id');
    }

    public function subContractorsAttachments()
    {
        return $this->hasMany(SubcontractorAttachment::class, 'subcontractor_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo(SubcontractorStatus::class, 'status_id');
    }

    public function scopeUserId(Builder $query, ?User $user)
    {
        return $query->whereUserId(optional($user)->id)->whereNotNull('user_id');
    }

    public function notes(): BelongsTo
    {
        return $this->belongsTo(Notes::class, 'subcontractor', 'id');
    }

    public function attachments(): BelongsTo
    {
        return $this->belongsTo(Attachments::class, 'subcontractor', 'id');
    }

    public function contacts(): BelongsTo
    {
        return $this->belongsTo(Contact::class, 'subcontractor', 'id');
    }

    /** @return SubcontractorFactory */
    protected static function newFactory()
    {
        return SubcontractorFactory::new();
    }
}
