<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadContact extends Model
{
    use HasFactory;

    protected $table = 'lead_contact';

    protected $fillable = [
        'leads_id',
        'contact_id'
    ];

}
