<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\ProjectUser */
class ProjectUserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'is_favorite' => $this->is_favorite,
            'is_manager' => $this->is_manager,
            'settings' => json_decode($this->settings),
            'project' => new ProjectResource($this->whenLoaded('project')),
            'user' => new UserResource($this->whenLoaded('user')),
        ];
    }
}
