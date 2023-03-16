<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Builder;

class ProjectPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Project $project): bool
    {
        return $user->projects()->where('uuid', $project->uuid)->exists();
    }

    public function update(User $user, Project $project): bool
    {
        return $user
            ->projects()
            ->where('projects.uuid', $project->uuid)
            ->where(fn (Builder $query) => $query
                ->where('projects.user_id', $user->id)
                ->orWhere('project_user.is_manager', true)
            )
            ->exists();
    }

    public function delete(User $user, Project $project): bool
    {
        return $project->user_id === $user->id;
    }
}
