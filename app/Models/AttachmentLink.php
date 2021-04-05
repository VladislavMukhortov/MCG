<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttachmentLink extends Model
{

    protected $table = 'attachment_link';

    public $timestamps = false;

    protected $fillable = ['request_id', 'user_id', 'link'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
