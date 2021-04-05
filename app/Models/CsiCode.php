<?php

namespace App\Models;

use App\Http\Controllers\EstimateTemplateController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CsiCode extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'code_name',
        'type',
        'level_1_id',
        'level_2_id',
        'level_3_id',
        'level_4_id',
        'building_materials',
        'decoration_materials',
        'labor',
        'subcontractors',
        'manufacturing',
        'created_at',
        'updated_at',
    ];

    public function estimate()
    {
        return $this->belongsToMany(EstimateRepository::class, 'estimate_line_items', 'estimate_id', 'csi_code');
    }

    public function estimateTemplate()
    {
        return $this->belongsToMany(EstimateTemplateRepository::class, 'estimate_template_line_items', 'csi_code', 'estimate_template_id');
    }

    public function csiPrices()
    {
        return $this->belongsTo(CsiCodePrice::class, 'code_id', 'id');
    }

    public function estimateCodePrices()
    {
        return $this->belongsToMany(EstimateRepository::class, 'code_estimate_prices', 'estimate_id', 'code_id');
    }
}
