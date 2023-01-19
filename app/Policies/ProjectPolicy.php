<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Query\JoinClause;

class ProjectPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, Project $project): bool
    {
        return $user->projects()->where('uuid', $project->uuid)->exists();
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, Project $project): bool
    {
        return $user
            ->projects()
            ->where('projects.uuid', $project->uuid)
            ->where(fn (Builder $query) => $query
                ->where('projects.user_id', $user->id)
                ->orWhere('project_user.is_manager', TRUE)
            )
            ->exists();
    }

    public function delete(User $user, Project $project): bool
    {
    }

    public function restore(User $user, Project $project): bool
    {
    }

    public function forceDelete(User $user, Project $project): bool
    {
    }
}
