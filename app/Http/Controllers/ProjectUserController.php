<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectUser\UpdateIsManagerRequest;
use App\Http\Requests\ProjectUser\UpdateOptions;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ProjectUserController extends Controller
{
    public function show(Request $request, Project $project): Response
    {
        $user = $request->user();
        $canUpdate = $user->can('update', $project);
        if (! $canUpdate) {
            abort(403);
        }

        return Inertia::render('ProjectUser/Show', [
            'project' => ProjectResource::make($project),
            'users' => $project->users()
                ->select([
                    'users.id',
                    'users.uuid',
                    'users.email',
                    'users.user_name',
                    'users.name',
                    'project_user.is_manager',
                ])
                ->get()
                ->map(fn (User $user) => [
                    'uuid' => $user->uuid,
                    'email' => $user->email,
                    'name' => $user->name,
                    'user_name' => $user->user_name,
                    'is_manager' => (bool) $user->is_manager,
                    'is_owner' => $user->id === $project->user_id,
                ])
                ->toArray(),
            'can_update' => $canUpdate,
        ]);
    }

    public function edit(Request $request, Project $project, User $user): Response
    {
        if ($user->uuid !== $request->user()->uuid) {
            abort(403);
        }
        $canUpdate = $user->can('update', $project);
        $projectUser = ProjectUser::query()
            ->select('settings')
            ->where('user_id', $user->id)
            ->where('project_id', $project->id)
            ->first();
        $project->settings = $projectUser->settings;

        return Inertia::render('ProjectUser/Edit', [
            'project' => ProjectResource::make($project),
            'can_update' => $canUpdate,
        ]);
    }

    public function update(UpdateOptions $request, Project $project, User $user): RedirectResponse
    {
        if ($request->user()->uuid !== $user->uuid) {
            abort(403);
        }
        ProjectUser::query()
            ->where('project_id', '=', $project->id)
            ->where('user_id', '=', $user->id)
            ->update($request->validated());

        return redirect()->back()->with('success', 'Project was updated.');
    }

    public function updateIsManager(UpdateIsManagerRequest $request, Project $project, User $user): RedirectResponse
    {
        if (! $request->user()->can('update', $project) || $project->user_id === $user->id) {
            abort(403);
        }

        ProjectUser::query()
            ->where('project_id', '=', $project->id)
            ->where('user_id', '=', $user->id)
            ->update($request->validated());

        return redirect()->back()->with('success', 'Project was updated.');
    }

    public function leave(Request $request, Project $project, User $user): RedirectResponse
    {
        if ($request->user()->id !== $user->id && $project->user_id !== $user->id) {
            abort(403);
        }

        $project->users()->detach($user);

        return redirect()->route('dashboard')->with('success', 'Left Board');
    }

    public function destroy(Request $request, Project $project, User $user): RedirectResponse
    {
        if (! $request->user()->can('update', $project) || $project->user_id === $user->id) {
            abort(403);
        }

        $project->users()->detach($user);

        return redirect()->back()->with('success', 'User was removed from project.');
    }
}
