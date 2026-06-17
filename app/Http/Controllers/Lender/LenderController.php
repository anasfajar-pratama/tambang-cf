<?php

namespace App\Http\Controllers\Lender;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class LenderController extends Controller
{
    public function dashboard(): View
    {
        $wallet = auth()->user()->lenderWallet;
        $recentInvestments = auth()->user()
            ->investments()
            ->with('project')
            ->latest()
            ->take(5)
            ->get();

        return view('lender.dashboard', compact('wallet', 'recentInvestments'));
    }
}
