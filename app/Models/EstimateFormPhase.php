<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EstimateFormPhase extends Model
{
    use HasFactory;

    protected $fillable = [
        'estimate_id',
        'premise_name',
        'phase_name',
        'description',
        'timeline',
    ];

    public function estimateLeadForm(): HasMany
    {
        return $this->hasMany(EstimateLeadForm::class, 'phase_id', 'id');
    }
}
