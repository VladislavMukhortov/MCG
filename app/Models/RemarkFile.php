<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class RemarkFile extends Model
{
    use HasFactory;

    protected $fillable = ['question_id', 'file_path', 'description', 'user_id'];

    public function getFileUrlAttribute()
    {
        return (bool)$this->file_path
            ? Storage::url($this->file_path)
            : null;
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
