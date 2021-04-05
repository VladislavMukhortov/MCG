<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class QuestionType extends Model
{
    use HasFactory;

    public const TYPE_INTERNAL = 1;
    public const TYPE_EXTERNAL = 2;

    protected $fillable = ['title', 'name'];

    public $timestamps  = false;

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public static function getTypeNames()
    {
        return collect([
            self::TYPE_INTERNAL => Str::snake('internal'),
            self::TYPE_EXTERNAL => Str::snake('external'),
        ]);
    }
}
