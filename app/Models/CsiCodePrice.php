<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CsiCodePrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'building_materials',
        'decoration_materials',
        'labor',
        'subcontractors',
        'manufacturing',
        'code_id',
    ];

    public function csiPrices()
    {
        return $this->hasMany(CsiCode::class, 'id', 'code_id');
    }
}
