<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Question.
 *
 * @package namespace App\Models;
 */
class Question extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subject', 'description', 'status_id', 'author_id', 'lead_id', 'project_id', 'estimate_id', 'type_id',
        'subcontractor_id', 'line_item_id'
    ];

    //todo 'line_item_id'
    //status = 'new' || 'In Progress' ||  'Closed'
    //type = 'Internal' || 'External'

    public function getStatusTitleAttribute()
    {
        return optional($this->status)->title ?? '';
    }

    public function getTypeTitleAttribute()
    {
        return optional($this->type)->title ?? '';
    }

    public function getIsClosedAttribute()
    {
        return $this->status_id === QuestionStatus::STATUS_CLOSED;
    }

    public function getAuthorNameAttribute()
    {
        return optional($this->user)->name ?? '';
    }

	public function user()
    {
        return $this->belongsTo(User::class, 'author_id')->select('id', 'name', 'email');
    }

    //Переделал remarks и attachments (c) Влад
    public function remarks(): HasMany
    {
        return $this->hasMany(RemarkFile::class, 'question_id', 'id');
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(Attachments::class, 'question_id','id');
    }
    //

    public function status(): BelongsTo
    {
        return $this->belongsTo(QuestionStatus::class, 'status_id', 'id');
    }

    public function type()
    {
        return $this->belongsTo(QuestionType::class, 'type_id');
    }

    public function lead()
    {
        return $this->belongsTo(Leads::class, 'lead_id');
    }

    /**
     * @param Builder $query
     * @param Leads|null $lead
     * @return mixed
     */
    public function scopeForLead(Builder $query, ? Leads $lead)
    {
        return $query->whereLeadId(optional($lead)->id)->whereNotNull('lead_id');
    }

}
