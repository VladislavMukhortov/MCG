<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;

    const STATUS_REJECTED = 0;
    const STATUS_APPROVED = 1;

    protected $fillable = [
        'project_id', 'bidder_id', 'subcontractor_id', 'line_item_id', 'amount', 'signature', 'status', 'attachment'
    ];

//    protected $dateFormat = 'm/d/y g:i A';

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function bidder()
    {
        return $this->belongsTo(Bidder::class);
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
