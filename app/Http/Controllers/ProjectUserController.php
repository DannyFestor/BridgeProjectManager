<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectUser\UpdateIsManagerRequest;
use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectUserController extends Controller
{
    public function updateIsManager(UpdateIsManagerRequest $request, Project $project, User $user)
    {
        if(!$request->user()->can('update', $project) || $project->user_id === $user->id) {
            abort(403);
        }

        ProjectUser::query()
            ->where('project_id', '=', $project->id)
            ->where('user_id', '=', $user->id)
            ->update($request->validated());

        return redirect()->back()->with('success', 'Project was updated.');
    }

    public function destroy(Request $request, Project $project, User $user)
    {
        if(!$request->user()->can('update', $project) || $project->user_id === $user->id) {
            abort(403);
        }

        $project->users()->detach($user);

        return redirect()->back()->with('success', 'User was removed from project.');
    }
}
