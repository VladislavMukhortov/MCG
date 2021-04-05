<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CsiLevel extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'level_name',
        'level_description',
        'type',
        'parent_lvl_id',
    ];
}
