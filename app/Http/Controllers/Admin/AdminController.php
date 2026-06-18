<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Investment;
use App\Models\Project;
use App\Models\Topup;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_vendors' => User::where('role', 'vendor')->count(),
            'total_lenders' => User::where('role', 'lender')->count(),
            'total_projects' => Project::count(),
            'active_fundraising' => Project::where('status', 'fundraising')->count(),
            'pending_topups' => Topup::where('status', 'pending')->count(),
        ];

        $recentProjects = Project::with('vendor')->latest()->take(5)->get();
        $recentTopups = Topup::with('lender', 'admin')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentProjects', 'recentTopups'));
    }
}
