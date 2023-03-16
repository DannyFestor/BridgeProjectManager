<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectResource;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function __invoke(Request $request): Response
    {
        return Inertia::render('Dashboard', [
            'projects' => fn () => ProjectResource::collection(
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
