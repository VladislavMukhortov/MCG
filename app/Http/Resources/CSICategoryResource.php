<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CSICategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
//            'code'  => $this->code,
//            'description'   => $this->description,
            'level_id'      => $this->level_id,
            'parent'        => $this->parent,
            'full_name'     => $this->full_name,
        ];
    }
}
