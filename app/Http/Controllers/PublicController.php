<?php

namespace App\Http\Controllers;

use App\Models\LandingPageContent;
use App\Models\Project;

class PublicController extends Controller
{
    public function index()
    {
        $sections = LandingPageContent::where('is_active', true)->get();
        $projects = Project::whereIn('status', ['fundraising', 'in_progress'])
            ->with('vendor')
            ->latest()
            ->take(6)
            ->get();

        return view('landing.index', compact('sections', 'projects'));
    }

    public function projects()
    {
        $projects = Project::whereIn('status', ['fundraising', 'in_progress'])
            ->with('vendor')
            ->latest()
            ->paginate(12);

        return view('projects.index', compact('projects'));
    }

    public function projectDetail(Project $project)
    {
        $project->load([
            'vendor',
            'galleries',
            'milestones' => fn($q) => $q->orderBy('order'),
            'documents',
            'faqs' => fn($q) => $q->orderBy('order'),
            'investments',
        ]);

        $totalInvested = $project->investments->sum('amount');

        return view('projects.show', compact('project', 'totalInvested'));
    }
}
