<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstimateWalkthroughForm extends Model
{
    protected $fillable = ['first_name', 'last_name', 'email', 'details', 'address', 'phone', 'meeting_timestamp'];

    public function estimate()
    {
        return $this->belongsTo(EstimateRepository::class, 'estimate_id');
    }

}
