<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Task.
 *
 * @package namespace App\Models;
 */
class Task extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $attributes = [
        'status' => 1,
    ];
    
    protected $fillable = ['name','description','parent_task','status','due_date','created_by','subcontractor','project','lead','assigned_rep','display_name','created_at'];

    protected $appends = ['parent_task_name', 'created_by_name', 'assigned_representative_name', 'status_name'];

    public function getStatusNameAttribute() //todo legacy
    {
        switch ((int)$this->status) {
            case 1:
                return 'New';
                break;
            case 2:
                return 'In Progress';
                break;
            case 3:
                return 'Closed';
                break;
            default:
                return Str::title($this->status);
        }
    }
    
    public function getParentTaskNameAttribute()
    {
        return optional($this->parentName)->name;
    }

    public function getCreatedByNameAttribute()
    {
        return optional($this->getcreatedby)->name;
    }

    public function getAssignedRepresentativeNameAttribute()
    {
        return optional($this->assignedRepresentative)->name;
    }

    public function parentName()
    {
        return $this->hasOne(__CLASS__, 'id', 'parent_task');
    }

    public function getcreatedby()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function tasksNote(){
        return $this->hasMany(TaskNotes::class, 'task_id', 'id');
    }

    public function leadName(){
        return $this->hasone(Leads::class, 'id', 'lead');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'assigned_rep');
    }

    public function assignedRepresentative()
    {
        return $this->belongsTo(User::class, 'assigned_rep');
    }

    public function taskProject()
    {
        return $this->belongsTo(Project::class, 'project');
    }

    public function leads(): HasMany
    {
        return $this->hasMany(Leads::class, 'id', 'lead');
    }

    public function subcontractors(): HasMany
    {
        return $this->hasMany(SubContractors::class, 'id', 'subcontractor');
    }
}
