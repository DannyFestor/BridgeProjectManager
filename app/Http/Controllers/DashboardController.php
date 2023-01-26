<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectResource;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        return Inertia::render('Dashboard', [
            'projects' => fn() => ProjectResource::collection(
                $request
                    ->user()
                    ->projects()
                    ->select([
                        'projects.uuid',
                        'projects.title',
                        'projects.description',
                        'projects.settings',
                        'projects.user_id',
                    ])
                    ->orderBy('project_user.order', 'ASC')
                    ->get()
            ),
        ]);
    }
}
