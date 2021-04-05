<?php

namespace App\Models;

use App\Models\EstimateTemplateRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use App\Models\Leads;


/**
 * Class EstimateRepository.
 *
 * @package namespace App\Models;
 */
class EstimateRepository extends Model implements Transformable
{
    use TransformableTrait;

    const STATUS_DRAFT      = 1;
    const STATUS_SENT       = 2;
    const STATUS_VIEWED     = 3;
    const STATUS_REJECTED   = 4;
    const STATUS_APPROVED   = 5;
    const STATUS_PROJECT    = 6;

    const TYPE_PRE_ESTIMATE     = 1;
    const TYPE_FINAL_ESTIMATE   = 2;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $attributes = [
        'status' => 1,
    ];

    protected $fillable = ['lead_id', 'job_id', 'job_name', 'date_sent', 'status', 'reject_reason', 'type', 'project', 'total_price', 'total_cost', 'pdf_url', 'cover_photo', 'signature', 'estimate_template', 'size', 'info', 'inspiration_external', 'created_by', 'created_at'];

    public function getStatusNameAttribute()
    {
        switch ($this->status) {
            case self::STATUS_REJECTED:
                return 'Rejected';
            case self::STATUS_APPROVED:
                return 'Approved';
            case self::STATUS_PROJECT:
                return 'Project';
            case self::STATUS_VIEWED:
                return 'Viewed';
            case self::STATUS_DRAFT:
                return 'Draft';
            case self::STATUS_SENT:
                return 'Sent';
            default:
                return '';
        }
    }

    public function getTypeNameAttribute()
    {
        switch ($this->type) {
            case self::TYPE_FINAL_ESTIMATE:
                return 'Final Estimate';
            case self::TYPE_PRE_ESTIMATE:
                return 'Pre-Estimate';
            default:
                return '';
        }
    }

    public function getCreatedByNameAttribute()
    {
        return optional($this->getCreatedby)->name ?? '';
    }

    public function leads()
    {
        return $this->hasOne(Leads::class, 'id', 'lead_id')->select('id','name','last_name');
    }

    public function contacts()
    {
        return $this->hasOne(Contact::class, 'id', 'lead_id')->select('id','name','last_name','email');
    }

    public function emails()
    {
        return $this->hasMany(Email::class, 'estimate_id', 'id');
    }

    public function estimateTemplate()
    {
        return $this->hasOne(EstimateTemplateRepository::class, 'id', 'estimate_template');
    }

    public function getCreatedby()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function estimateAttachments()
    {
        return $this->hasMany(EstimateAttachment::class, 'estimate_template_id', 'id');
    }

    public function estimateNotes()
    {
        return $this->hasMany(EstimateNotes::class, 'estimate_id', 'id');
    }

    public function estimateActivities()
    {
        return $this->hasMany(EstimateActivities::class, 'estimate_id', 'id');
    }

    public function lineItems(): BelongsToMany
    {
        return $this->belongsToMany(CsiCode::class, 'estimate_repository_line_items', 'estimate_id', 'csi_code');
    }

    public function attachments()
    {
        return $this->hasMany(Attachments::class, 'estimate');
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'estimate_id');
    }

    public function estimateForm()
    {
        return $this->hasMany(EstimateForm::class, 'estimate_id');
    }

    public function estimateWalkthoughForm()
    {
        return $this->hasMany(EstimateWalkthroughForm::class, 'estimate_id');
    }

    public static function getStatuses()
    {
        return collect([
            self::STATUS_APPROVED   => Str::title('approved'),
            self::STATUS_REJECTED   => Str::title('rejected'),
            self::STATUS_PROJECT    => Str::title('project'),
            self::STATUS_VIEWED     => Str::title('viewed'),
            self::STATUS_DRAFT      => Str::title('draft'),
            self::STATUS_SENT       => Str::title('sent'),
        ])->sortKeys();
    }

    public function estimateCodePrices()
    {
        return $this->belongsToMany(CsiCode::class, 'code_estimate_prices', 'estimate_id', 'code_id');
    }

    public function getTypeAttribute($id)
    {
        if ($id) {
            $status = [1 => 'Pre-estimate', 2 => 'Final estimate'];
            return $status[$id];
        }
    }

    public function getStatusAttribute($id)
    {
        if ($id) {
            $status = ['Draft', 'Sent', 'Viewed', 'Rejected', 'Approved', 'Project'];
            return $status[$id];
        }
    }

}
