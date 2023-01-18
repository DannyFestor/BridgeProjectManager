<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Dashboard', [
            'projects' => fn () => Project::select(['uuid', 'title'])->get(),
        ]);
    }
}
