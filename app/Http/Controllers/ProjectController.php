<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project\StoreRequest;
use App\Http\Requests\Project\UpdateRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ProjectController extends Controller
{
    public function index(): RedirectResponse
    {
        return redirect()->route('dashboard');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $project = Project::create([
            'user_id' => $request->user()->id,
            'title' => $request->title,
            'description' => $request->description,
            'settings' => $request->settings,
        ]);

        return redirect()->route('projects.show', $project)->with('success', 'Project was created.');
    }

    public function create(): Response
    {
        return Inertia::render('Project/Create');
    }

    public function show(Request $request, Project $project): Response
    {
        $user = $request->user();
        if (! $user->can('view', $project)) {
            abort(404);
        }

        $project->load('owner');

        return Inertia::render('Project/Show', [
            'project' => ProjectResource::make($project),
            'can_update' => $user->can('update', $project),
        ]);
    }

    public function edit(Request $request, Project $project): Response
    {
        $user = $request->user();
        $canUpdate = $user->can('update', $project);
        if (! $canUpdate) {
            abort(404);
        }

        return Inertia::render('Project/Edit', [
            'project' => ProjectResource::make($project),
            'can_update' => $canUpdate,
        ]);
    }

    public function update(UpdateRequest $request, Project $project): RedirectResponse
    {
        $user = $request->user();
        if (! $user->can('update', $project)) {
            abort(403);
        }

        $project->fill($request->validated());
        $project->save();

        return redirect()->route('projects.show', $project)->with('success', 'Project was updated.');
    }

    public function destroy(Request $request, Project $project): RedirectResponse
    {
        $user = $request->user();
        if (! $user->can('delete', $project)) {
            abort(403);
        }
        $project->delete();

        return redirect()->route('dashboard')->with('success', 'Project was deleted.');
    }
}
