<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Project.
 *
 * @package namespace App\Models;
 */
class Project extends Model implements Transformable
{
    use TransformableTrait, HasFactory;


    protected $fillable = [
        'lead_id', 'author_id', 'name', 'status_id', 'start_date', 'finish_date', 'created_at'
    ];

    protected $appends = [
        'status_name', 'unassigned_line_items', 'total_line_items', 'full_address', 'lead_name', 'author_name'
    ];

    protected $casts = [
        'created_at'    => 'datetime:m/d/y g:i A',
    ];
//    protected $dateFormat = 'm/d/y g:i A';

    public function getStatusNameAttribute()
    {
        return optional($this->status)->name;
    }

    public function getUnassignedLineItemsCountAttribute()
    {
        //todo
    }

    public function getTotalLineItemsCountAttribute()
    {
        //todo
    }

    public function getEstimatesLineItemsAttribute()
    {
        if (!$this->relationLoaded('estimate')) {
            $this->load('estimate.lineItems');
        }
        return optional($this->estimate)->lineItems;
    }

    public function getLeadEstimatesLineItems()
    {
        return collect(); //todo
    }

//    public function getFullAddressAttribute()
//    {
//        return implode(', ', array_reverse($this->address ?? []));
//    }

    public function getLeadNameAttribute()
    {
        return optional(optional($this->lead)->getUser)->name;
    }

    public function getAuthorNameAttribute()
    {
        return optional($this->createdBy)->name;
    }

    public function getProjectTotalAttribute()
    {
        //todo
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function lead()
    {
        return $this->belongsTo(Leads::class, 'lead_id');
    }

    public function status()
    {
        return $this->belongsTo(ProjectStatus::class, 'status_id');
    }

    //todo
//    public function lineItems()
//    {
//
//    }

    public function bidders()
    {
        return $this->hasMany(Bidder::class);
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    public function notes()
    {
        return $this->hasMany(Notes::class, 'project');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class , 'project');
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function activities()
    {
        return $this->hasMany(Activities::class, 'project');
    }

    public function attachments()
    {
        return $this->hasMany(Attachments::class, 'project');
    }

    public function estimate()
    {
        return $this->hasOne(EstimateRepository::class, 'project');
    }

    public function leadEstimates()
    {
//        return $this->hasManyThrough();
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function payouts()
    {
        return $this->hasMany(Payout::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class , 'project_id');
    }

    public function completionReports()
    {
        return $this->hasMany(Report::class, 'project_id');
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class, 'id', 'project_id');
    }

    public function projectDocuments(): BelongsTo
    {
        return $this->belongsTo(ProjectDocument::class, 'id', 'project_id');
    }
}
