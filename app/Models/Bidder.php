<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidder extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id', 'line_item_id', 'subcontractor_id', 'request_last_sent', 'author_id'
    ];

    protected $casts = [
        'request_last_sent' => 'datetime',
    ];

//    protected $dateFormat = 'm/d/y g:i A';

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function subcontractor()
    {
        return $this->belongsTo(SubContractors::class, 'subcontractor_id');
    }

    public function lineItem()
    {
        //return $this->belongsTo(); todo
    }
}
