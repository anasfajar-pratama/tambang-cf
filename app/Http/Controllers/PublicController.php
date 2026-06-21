<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use App\Models\LandingPageContent;
use App\Models\ProfitDistribution;
use App\Models\Project;
use App\Models\User;

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

        $stats = [
            'total_projects' => Project::whereIn('status', ['fundraising', 'in_progress', 'completed'])->count(),
            'total_funding' => Investment::sum('amount') ?? 0,
            'total_investors' => User::where('role', 'lender')->count(),
            'total_profit' => ProfitDistribution::sum('amount') ?? 0,
        ];

        return view('landing.index', compact('sections', 'projects', 'stats'));
    }

    public function projects()
    {
        $query = Project::with('vendor');

        if ($status = request('status')) {
            if ($status === 'active') {
                $query->where('status', 'in_progress');
            } else {
                $query->where('status', $status);
            }
        } else {
            $query->whereIn('status', ['fundraising', 'in_progress']);
        }

        if ($miningType = request('mining_type')) {
            $query->where('mining_type', $miningType);
        }

        $projects = $query->latest()->paginate(12);

        return view('projects.index', compact('projects'));
    }

    public function projectDetail(Project $project)
    {
        $project->load([
            'vendor.user',
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
