<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\View\View;

class VendorController extends Controller
{
    public function dashboard(): View
    {
        $vendor = auth()->user()->vendor;

        if (!$vendor) {
            return view('vendor.dashboard')->with('error', 'Profil vendor belum lengkap.');
        }

        $totalProjects = $vendor->projects()->count();
        $activeProjects = $vendor->projects()->whereIn('status', ['fundraising', 'in_progress'])->count();
        $completedProjects = $vendor->projects()->where('status', 'completed')->count();
        $pendingProjects = $vendor->projects()->where('status', 'pending')->count();
        $draftProjects = $vendor->projects()->where('status', 'draft')->count();
        $totalCapital = $vendor->projects()->sum('total_capital');
        $recentProjects = $vendor->projects()->with('investments')->latest()->take(5)->get();

        return view('vendor.dashboard', compact(
            'totalProjects',
            'activeProjects',
            'completedProjects',
            'pendingProjects',
            'draftProjects',
            'totalCapital',
            'recentProjects'
        ));
    }
}
