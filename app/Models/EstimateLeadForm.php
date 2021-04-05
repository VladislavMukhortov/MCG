<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class EstimateLeadForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'estimate_id',
        'file',
        'premise_id',
        'phase_id',
        'page_number',
    ];

    public function premise(): BelongsTo
    {
        return $this->belongsTo(EstimateFormPremise::class, 'id', 'premise_id');
    }

    public function phase(): BelongsTo
    {
        return $this->belongsTo(EstimateFormPhase::class, 'id', 'phase_id');
    }
}
