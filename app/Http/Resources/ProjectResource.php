<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Project */
class ProjectResource extends JsonResource
{
    /**
     * @param Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'uuid' => $this->uuid,
            'title' => $this->title,
            'description' => $this->description,
            'settings' => json_decode($this->settings),
            'isOwner' => $request->user() ? $request->user()->id === $this->user_id : false,
            'owner' => $this->whenLoaded('owner'),
        ];
    }
}
