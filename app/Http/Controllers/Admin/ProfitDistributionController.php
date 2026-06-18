<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Investment;
use App\Models\ProfitDistribution;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfitDistributionController extends Controller
{
    public function index(): View
    {
        $completedProjects = Project::where('status', 'completed')
            ->with('profitDistributions.investment')
            ->latest()
            ->get();

        $distributions = ProfitDistribution::with('project', 'investment.lender')
            ->latest()
            ->paginate(15);

        return view('admin.profit-distributions.index', compact('completedProjects', 'distributions'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'total_profit' => 'required|numeric|min:1',
        ]);

        $project = Project::findOrFail($validated['project_id']);

        if ($project->status !== 'completed') {
            return redirect()->route('admin.profit-distributions.index')
                ->with('error', 'Proyek harus berstatus completed.');
        }

        $totalInvested = $project->investments()->sum('amount');

        if ($totalInvested <= 0) {
            return redirect()->route('admin.profit-distributions.index')
                ->with('error', 'Tidak ada investasi pada proyek ini.');
        }

        $investments = $project->investments;

        foreach ($investments as $investment) {
            $ratio = $investment->amount / $totalInvested;
            $profitAmount = $validated['total_profit'] * $ratio;

            $wallet = $investment->lender->lenderWallet;
            if ($wallet) {
                $wallet->increment('balance', $profitAmount);
                $wallet->increment('total_profit', $profitAmount);
            }

            ProfitDistribution::create([
                'project_id' => $project->id,
                'investment_id' => $investment->id,
                'amount' => $profitAmount,
                'type' => 'profit',
                'distributed_at' => now(),
            ]);
        }

        return redirect()->route('admin.profit-distributions.index')
            ->with('success', 'Keuntungan berhasil didistribusikan.');
    }
}
