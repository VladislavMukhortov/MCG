<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $fillable = ['user_id', 'title', 'body', 'email', 'lead_id', 'request_id', 'estimate_id'];

    use HasFactory;
}
