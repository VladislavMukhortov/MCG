<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EstimateFormPremise extends Model
{
    use HasFactory;

    protected $table = 'estimate_form_premises';
    protected $fillable = [
        'estimate_id',
        'description',
    ];

    public function estimateLeadForm(): HasMany
    {
        return $this->hasMany(EstimateLeadForm::class, 'premise_id', 'id');
    }
}
