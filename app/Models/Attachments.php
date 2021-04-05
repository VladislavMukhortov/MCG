<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Attachments.
 *
 * @package namespace App\Models;
 */
class Attachments extends Model implements Transformable
{
    use TransformableTrait;

    const DEFAULT_FILE_NAME         = 'file';

    const TYPE_EMPTY                = null;
    const TYPE_EXISTING_CONDITION   = 1;
    const TYPE_CONCEPT_IMAGE        = 2;
    const TYPE_FLOOR_PLAN           = 3;
    const TYPE_OTHER                = 4;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $attributes = [
        'status' => 1,
    ];
    protected $fillable = [
        'attachment_description','status','file','subcontractor','general_contractor','project','uploaded_by',
        'lead','estimate','request','ticket','line_item','subcontractor_attachment_type',
        'estimate_attachment_type','created_at'
    ];

    public function getuploadby()
    {
        return $this->belongsTo(User::class,  'uploaded_by');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project');
    }

    public function estimate()
    {
        return $this->belongsTo(EstimateRepository::class, 'estimate');
    }

    public function lead()
    {
        return $this->belongsTo(Leads::class, 'lead');
    }

    public function subcontractor()
    {
        return $this->belongsTo(SubContractors::class, 'subcontractor');
    }

    public function generalContractor()
    {
        return $this->belongsTo(GeneralContractors::class, 'general_contractor');
    }

    public function scopeLeadOwn(Builder $query, ? int $leadId)
    {
        return $query->whereLead($leadId)->whereNotNull('lead');
    }
}
