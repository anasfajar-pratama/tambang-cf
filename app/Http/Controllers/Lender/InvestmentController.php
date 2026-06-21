<?php

namespace App\Http\Controllers\Lender;

use App\Http\Controllers\Controller;
use App\Models\Investment;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InvestmentController extends Controller
{
    public function index(): View
    {
        $investments = auth()->user()
            ->investments()
            ->with('project')
            ->latest()
            ->paginate(15);

        return view('lender.investments.index', compact('investments'));
    }

    public function show(Investment $investment): View
    {
        if ($investment->lender_id !== auth()->id()) {
            abort(403);
        }

        $investment->load([
            'project.vendor.user',
            'profitDistributions' => fn($q) => $q->latest(),
        ]);

        $project = $investment->project;
        $project->load([
            'vendor.user',
            'investments' => fn($q) => $q->with('lender')->latest(),
        ]);

        $totalCollected = $project->collected_capital;

        return view('lender.investments.show', compact('investment', 'project', 'totalCollected'));
    }

    public function invest(Request $request, Project $project): RedirectResponse
    {
        if (!in_array($project->status, ['fundraising', 'in_progress'])) {
            return redirect()->route('projects.show', $project)
                ->with('error', 'Proyek ini tidak menerima investasi saat ini.');
        }

        $validated = $request->validate([
            'amount' => 'required|numeric|min:' . $project->min_investment,
        ]);

        $currentCollected = $project->collected_capital;
        $remaining = $project->total_capital - $currentCollected;

        if ($validated['amount'] > $remaining) {
            return redirect()->route('projects.show', $project)
                ->with('error', 'Investasi melebihi sisa slot yang tersedia. Sisa slot: Rp ' . number_format($remaining, 0, ',', '.'));
        }

        $wallet = auth()->user()->lenderWallet;

        if (!$wallet || $wallet->balance < $validated['amount']) {
            return redirect()->route('projects.show', $project)
                ->with('error', 'Saldo dompet tidak mencukupi. Silakan lakukan topup terlebih dahulu.');
        }

        if ($project->investment_type === 'single') {
            $existing = Investment::where('project_id', $project->id)->exists();
            if ($existing) {
                return redirect()->route('projects.show', $project)
                    ->with('error', 'Proyek tipe single hanya dapat diinvestasi oleh satu orang.');
            }
        }

        $wallet->decrement('balance', $validated['amount']);
        $wallet->increment('total_invested', $validated['amount']);

        Investment::create([
            'project_id' => $project->id,
            'lender_id' => auth()->id(),
            'amount' => $validated['amount'],
            'invested_at' => now(),
        ]);

        if ($project->fresh()->collected_capital >= $project->total_capital) {
            $project->update(['status' => 'in_progress']);
        }

        return redirect()->route('lender.investments.index')
            ->with('success', 'Investasi berhasil dilakukan.');
    }
}
