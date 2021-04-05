<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstimateFormNextStep extends Model
{
    use HasFactory;

    protected $fillable = [
        'estimate_id',
        'page_number',
        'content',
    ];
}
