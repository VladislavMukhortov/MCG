<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstimateForm extends Model
{
    protected $fillable = ['first_name', 'last_name', 'design_pros', 'design_cons', 'design_question', 'work_add', 'work_remove', 'work_change', 'work_question'];

    public function estimate()
    {
        return $this->belongsTo(EstimateRepository::class, 'estimate_id');
    }

}
