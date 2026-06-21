<?php

namespace App\Http\Controllers\Lender;

use App\Http\Controllers\Controller;
use App\Models\LenderWallet;
use App\Models\ProfitDistribution;
use App\Models\Project;
use Illuminate\View\View;

class LenderController extends Controller
{
    public function dashboard(): View
    {
        $user = auth()->user();

        $wallet = $user->lenderWallet;
        if (!$wallet) {
            $wallet = LenderWallet::create([
                'lender_id' => $user->id,
                'balance' => 0,
                'total_invested' => 0,
                'total_profit' => 0,
            ]);
        }

        $walletBalance = $wallet->balance;
        $totalInvested = $wallet->total_invested;
        $totalProfit = $wallet->total_profit;
        $investmentCount = $user->investments()->count();
        $pendingTopups = $user->topups()->where('status', 'pending')->count();

        $recentInvestments = $user
            ->investments()
            ->with('project')
            ->latest()
            ->take(5)
            ->get();

        $recentProfitDistributions = ProfitDistribution::whereIn('investment_id', $user->investments()->select('id'))
            ->with('investment.project')
            ->latest()
            ->take(5)
            ->get();

        $activeProjects = Project::whereIn('status', ['fundraising', 'in_progress'])
            ->with('vendor')
            ->latest()
            ->take(5)
            ->get();

        return view('lender.dashboard', compact(
            'wallet',
            'walletBalance',
            'totalInvested',
            'totalProfit',
            'investmentCount',
            'pendingTopups',
            'recentInvestments',
            'recentProfitDistributions',
            'activeProjects',
            'user',
        ));
    }
}
