<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Address extends Model
{
    use HasFactory;

    protected $fillable = ['address', 'street', 'state', 'city', 'zip', 'contact_id', 'lead_id', 'project_id', 'user_id',];

    public function contact(): HasOne
    {
        return $this->hasOne(Contact::class);
    }

    public function lead(): HasOne
    {
        return $this->hasOne(Leads::class);
    }

    public function project(): HasOne
    {
        return $this->hasOne(Project::class);
    }

    public function user(): HasOne
    {
        return $this->hasOne(Leads::class);
    }
}
