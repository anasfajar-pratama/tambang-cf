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
        $totalUsers = User::count();
        $totalAdmins = User::where('role', 'admin')->count();
        $totalVendors = User::where('role', 'vendor')->count();
        $totalLenders = User::where('role', 'lender')->count();
        $totalProjects = Project::count();
        $totalInvestments = Investment::sum('amount');
        $totalTopups = Topup::where('status', 'approved')->sum('amount');
        $pendingTopups = Topup::where('status', 'pending')->count();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalAdmins',
            'totalVendors',
            'totalLenders',
            'totalProjects',
            'totalInvestments',
            'totalTopups',
            'pendingTopups'
        ));
    }
}
