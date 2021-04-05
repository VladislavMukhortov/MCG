<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class QuestionStatus extends Model
{
    use HasFactory;

    public const STATUS_NEW         = 1;
    public const STATUS_IN_PROGRESS = 2;
    public const STATUS_CLOSED      = 3;

    protected $fillable = ['title', 'name'];

    public $timestamps = false;

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public static function getStatusNames()
    {
        return collect([
            self::STATUS_NEW           => Str::snake('new'),
            self::STATUS_IN_PROGRESS   => Str::snake('in progress'),
            self::STATUS_CLOSED        => Str::snake('closed'),
        ]);
    }
}
