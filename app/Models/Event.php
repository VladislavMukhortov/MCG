<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends Model
{

    protected $fillable = [
        'created_by',
        'type',
        'description',
        'link',
        'date',
        'time',
    ];

    use HasFactory;

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'event_user','event_id','user_id');
    }

    public static function getUser($usersId)
    {
        return User::where('id', $usersId)->with('events')->select('name', 'id')->first();
    }

    public function getEvent()
    {

    }

}
