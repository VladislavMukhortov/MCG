<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Document.
 *
 * @package namespace App\Models;
 */
class Document extends Model implements Transformable
{
    use TransformableTrait, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'url', 'status_id', 'recipientable_type', 'recipientable_id', 'recipient_id', 'sender_id', 'sent_at',
        'renewal_date', 'signature', 'project_id',
        ];

    protected $appends = [
      'status_name', 'sender_name', 'date_sent', 'renewal_date_time'
    ];

    public function recipientable()
    {
        return $this->morphTo();
    }
    
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function resipient()
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }

    public function getDateSentAttribute()
    {
        return !is_null($this->sent_at) ? Carbon::parse($this->sent_at)->format('m/d/Y h:i A') : null;
    }

    public function getRenewalDateTimeAttribute()
    {
        return !is_null($this->renewal_date) ? Carbon::parse($this->sent_at)->format('m/d/Y h:i A') : null;
    }

    public function getSenderNameAttribute()
    {
        return optional($this->sender)->name ?? '';
    }

    public function getProjectNameAttribute()
    {
        return optional($this->project)->name ?? '';
    }

    public function getStatusNameAttribute()
    {
        return optional($this->status)->name ?? '';
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function status()
    {
        return $this->belongsTo(DocumentStatus::class);
    }

    public function scopeForLead(Builder $query, ? Leads $lead)
    {
        return $query->whereHasMorph('recipientable', Leads::class, function (Builder $query, $type) use ($lead) {
            $column     = 'recipientable_id';
            $queryName  = Str::of($column)->title()->prepend('where')->camel()->__toString();

            $query->{$queryName}($lead->id);
        });
    }

}
