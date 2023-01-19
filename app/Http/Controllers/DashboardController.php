<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Dashboard', [
            // TODO: Filter by Access
            'projects' => fn() => ProjectResource::collection(
                Project::select([
                    'uuid',
                    'title',
                    'description',
                    'settings',
                    'user_id',
                ])->get()
            ),
        ]);
    }
}
