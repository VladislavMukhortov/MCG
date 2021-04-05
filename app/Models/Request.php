<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use App\Models\Account;
use App\Models\Contact;


/**
 * Class Request.
 *
 * @package namespace App\Models;
 */
class Request extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $attributes = ['status' => 1,];

    public $timestamps = false;
    protected $fillable = ['lead', 'created_by', 'status', 'created', 'request_information', 'floor_plan_attachments', 'existing_condition_attachments', 'concept_photo_attachments', 'floor_plan_uploaded', 'existing_condition_uploaded', 'concept_photo_uploaded', 'attachment_link_sent', 'type', 'stage', 'startdate'];

    public function account ()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function contacts ()
    {
        return $this->hasOne(Contact::class, 'id', 'lead')->select('id','name','last_name','email');
    }

    public function emails()
    {
        return $this->hasMany(Email::class, 'request_id', 'id');
    }

    public function user ()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function leads ()
    {
        return $this->hasOne(Leads::class, 'id', 'lead');
    }

    public function requestAttachments ()
    {
        return $this->hasMany(RequestAttachment::class, 'request_id', 'id');
    }

    public function requestsNote ()
    {
        return $this->hasMany(RequestNotes::class, 'request_id', 'id');
    }

    public function requestActivities ()
    {
        return $this->hasMany(RequestActivities::class, 'request_id', 'id');
    }

    public function Room ()
    {
        return $this->hasMany(Room::class, 'request_id', 'id');
    }

    public function getLeads(): HasMany
    {
        return $this->hasMany(Leads::class, 'id', 'lead');
    }

}
