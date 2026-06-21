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

        $totalAsset = $user->topups()->where('status', 'approved')->sum('amount') ?? 0;
        $walletBalance = $wallet->balance;
        $totalInvested = $user->investments()
            ->whereHas('project', fn($q) => $q->whereIn('status', ['fundraising', 'in_progress']))
            ->sum('amount') ?? 0;
        $totalProfit = ProfitDistribution::whereIn('investment_id', $user->investments()->select('id'))
            ->sum('amount') ?? 0;

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
            'totalAsset',
            'totalInvested',
            'totalProfit',
            'recentInvestments',
            'recentProfitDistributions',
            'activeProjects',
            'user',
        ));
    }
}
