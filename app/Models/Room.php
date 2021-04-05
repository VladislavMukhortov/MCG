<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public $timestamps = false;

    protected $fillable = ['request_id','stage_room','ceiling','walls','wall_partition','floor','baseboard','crown_molding','interior_door','closest_door','closest_organization','window','light_fixture','room_size','room_info','room_inspiration_external','recessed_light','wall_fixture','ceiling_fixture','bathroom_current','bathroom_replace'];

    public function Request()
    {
        return $this->belongsTo(Room::class, 'request_id');
    }

}
