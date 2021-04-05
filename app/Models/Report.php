<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Report.
 *
 * @package namespace App\Models;
 */
//todo
class Report extends Model implements Transformable
{
    use TransformableTrait, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subcontractor_id', 'project_id', 'attachment_id', 'signature', 'note', 'date'
    ];

    protected $dates = [
        'date'
    ];

    protected $appends = [
        'subcontractor_name', 'general_contractor_name', 'date_time'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function getSubcontractorNameAttribute()
    {
        return optional($this->subcontractor)->name ?? '';
    }

    public function getGeneralContractorNameAttribute()
    {
        return optional($this->generalContractor)->user_name ?? '';
    }

    public function getAttachmentUrlAttribute()
    {
        return !is_null($this->attachment) ? optional($this->attachment)->file_url : null;
    }

    public function getDateTimeAttribute()
    {
        return !is_null($this->date) ? Carbon::parse($this->date)->format('m/d/Y h:i A') : '';
    }

    public function subcontractor()
    {
        return $this->belongsTo(SubContractors::class, 'subcontractor_id');
    }

    public function attachment() //todo make pivot if plural
    {
        return $this->belongsTo(Attachments::class, 'attachment_id');
    }
}
