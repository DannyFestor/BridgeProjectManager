<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\UpdateRequest;
use App\Http\Requests\ProjectUser\UpdateOrderRequest;
use App\Models\Project;
use App\Models\ProjectUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;

class UpdateOrderController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Project       $project
     *
     * @return RedirectResponse
     */
    public function __invoke(UpdateOrderRequest $request, Project $project): RedirectResponse
    {
        $user = $request->user();
        $canUpdate = ProjectUser::query()
            ->where('user_id', $user->id)
            ->where('project_id', $project->id)
            ->exists();
        if (!$canUpdate) {
            abort(404);
        }

        ProjectUser::query()
            ->where('user_id', $user->id)
            ->where('project_id', $project->id)
            ->update(['order' => $request->get('new')]);

        ProjectUser::query()
            ->where('user_id', $user->id)
            ->where('project_id', '!=', $project->id)
            ->when(
                $request->get('old') < $request->get('new'),
                fn(Builder $query) => $query
                    ->where('order', '>=', $request->get('old'))
                    ->where('order', '<=', $request->get('new'))
                    ->decrement('order'),
                fn(Builder $query) => $query
                    ->where('order', '>=', $request->get('new'))
                    ->where('order', '<=', $request->get('old'))
                    ->increment('order'),
            );

        return redirect()->back()->with('success', 'Project was updated.');
    }
}
