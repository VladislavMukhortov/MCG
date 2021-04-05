<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{

    protected $fillable = ['lead_id','title','status','deleted'];

    public function estimates()
    {
        return $this->hasMany(EstimateRepository::class, 'job_id', 'id');
    }
}
