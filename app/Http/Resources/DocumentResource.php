<?php

namespace App\Http\Resources;

use App\Models\Document;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

/**
 * Class DocumentResource
 * @package App\Http\Resources
 * @mixin Document
 */
class DocumentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'is_received'           => $this->recipient_id === Auth::id(),
            'is_sent'               => $this->sender_id === Auth::id(),
            'recipientable_type'    => $this->recipientable_type,
            'recipientable_id'      => $this->recipientable_id,
            'recipient_id'          => $this->recipient_id,
            'status_name'           => $this->status_name,
            'sender_name'           => $this->sender_name,
            'status_id'             => $this->status_id,
            'sender_id'             => $this->sender_id,
            'sent_at'               => $this->sent_at,
            'name'                  => $this->name,
            'url'                   => $this->url,
            'id'                    => $this->id,
        ];
    }
}
