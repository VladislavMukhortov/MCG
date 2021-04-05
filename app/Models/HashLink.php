<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HashLink extends Model
{

    protected $fillable = ['lead_id', 'user_id', 'link'];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function lead()
    {
        return $this->belongsTo(Leads::class, 'id', 'lead_id');
    }
}
