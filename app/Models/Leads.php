<?php

namespace App\Models;

use Database\Factories\LeadFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Models\Repository\LeadsRepository;

/**
 * Class Lead.
 *
 * @package namespace App\Models;
 */
class Leads extends Model implements Transformable
{
    use TransformableTrait, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $attributes = [
        'status' => 1,
    ];
    public $timestamps = false;
    protected $fillable = ['user_id', 'token', 'email', 'name', 'last_name', 'request', 'lead_referral_source', 'date_of_initial_contact', 'title', 'company', 'industry', 'phone', 'status', 'rating', 'project_type', 'project_description', 'budget', 'created_by', 'created', 'current_estimate', 'logged_in', 'request', 'password_generated'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contacts()
    {
        return $this->hasOne(Contact::class, 'lead', 'id')->select('id','name','last_name','email');
    }

    public function emails()
    {
        return $this->hasMany(Email::class, 'lead_id', 'id');
    }

    public function getUser() //todo refactor: will delete and replace to user() in all places
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getCreatedby()
    {
        return $this->hasOne(User::class, 'id', 'created_by')->select(['name', 'email']);
    }

    public function getRequest()
    {
        return $this->hasOne(Request::class, 'id', 'request');
    }

    public function estimates(): BelongsTo
    {
        return $this->belongsTo(EstimateRepository::class, 'lead_id', 'id');
    }

    public function estimateTemplate() //todo refactor: will delete and replace to estimates() in all places
    {
        return $this->hasMany(EstimateRepository::class, 'lead_id', 'id');
    }

    public function leadsAttachment()
    {
        return $this->hasMany(LeadsAttachment::class, 'lead_id', 'id');
    }

    public function leadsNote()
    {
        return $this->hasMany(LeadNotes::class, 'lead_id', 'id');
    }

    public function leadActivities()
    {
        return $this->hasMany(LeadActivities::class, 'lead_id', 'id');
    }

    public function documents()
    {
        return $this->morphMany(Document::class, 'recipientable');
    }

    public function scopeUserId(Builder $query, ?User $user)
    {
        return $query->whereUserId(optional($user)->id)->whereNotNull('user_id');
    }

    public function scopeSearch($query, $value){

        $columns = ['email', 'name', 'last_name'];

        foreach($columns as $column){
            $query->where($column, 'LIKE', '%' . $value . '%');
        }
        return $query;
    }

    public function scopeOrder($query, $field, $sortBy)
    {
        $columns = ['email', 'name', 'last_name'];
        $column = $columns[$field];

        $type = ['ASC', 'DESC'];
        $sort = $type[$sortBy];

        return $query->orderBy($column,$sort);
    }

//    public function getContacts(): HasMany
//    {
//        return $this->hasMany(Contact::class, 'lead', 'id');
//    }

    public function activities(): BelongsTo
    {
        return $this->belongsTo(Activities::class, 'lead', 'id');
    }

    public function tasks(): BelongsTo
    {
        return $this->belongsTo(Leads::class, 'id', 'lead');
    }

    public function requests()
    {
        return $this->hasMany(Request::class, 'lead', 'id');
    }

    public function getContacts(): BelongsToMany
    {
        return $this->belongsToMany(Contact::class, 'lead_contact','leads_id','contact_id')->select('name','last_name','email');
    }

    public function getNotes(): BelongsToMany
    {
        return $this->belongsToMany(Notes::class, 'lead_notes','lead_id','note_id');
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class, 'id', 'lead_id');
    }

    public static function getUserLeads()
    {
        return self::whereCreatedBy(auth('api')->user()->id)->with(['getUser', 'getRequest', 'leadsAttachment.attachment'])->paginate(30);
    }

    public static function getAllLeads()
    {
        return self::with(['getUser', 'getRequest', 'leadsAttachment.attachment'])->paginate(30);
    }

    public static function getLeadByIdWithRelations(int $leadId)
    {
        return self::with(['leadsAttachment.attachments', 'leadsNote.notes', 'address', 'getContacts', 'activities', 'estimates', 'tasks', 'requests'])->find($leadId);
    }
    public function getStatusAttribute($id)
    {

        $status = [null, 'New'];

        return $status[$id];
    }

    /** @return LeadFactory */
    protected static function newFactory()
    {
        return LeadFactory::new();
    }

}
