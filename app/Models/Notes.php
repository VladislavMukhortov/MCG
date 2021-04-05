<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Notes.
 *
 * @package namespace App\Models;
 */
class Notes extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['notes','created_by','contact','task','general_contractor','subcontractor','project','lead','estimate','request','ticket','line_item','created_at'];

    public function getLeads()
    {
        return $this->belongsToMany(Leads::class, 'lead_notes','note_id','lead_id');
    }

    public function getCreatedby()
    {
        return $this->belongsTo(User::class, 'created_by')->select('id', 'name', 'email');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project');
    }

    public function generalContractor()
    {
        return $this->belongsTo(GeneralContractors::class, 'general_contractor');
    }

    public static function getContactNoteList(int $contactId)
    {
        return self::where('contact', $contactId)->get();
    }

}
