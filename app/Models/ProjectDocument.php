<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProjectDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'created_by',
        'subcontractor',
        'lead',
        'status',
        'date_sent',
    ];

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'id', 'project_id');
    }
}
