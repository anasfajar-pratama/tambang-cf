<?php

namespace Database\Seeders;

use App\Models\Investment;
use App\Models\ProfitDistribution;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class InvestmentSimulationSeeder extends Seeder
{
    public function run(): void
    {
        $lenders = [3, 4];

        // Set 3 projects as completed
        $completedProjects = Project::whereIn('id', [3, 5, 6])->get();

        foreach ($completedProjects as $project) {
            $project->update([
                'status' => 'completed',
                'started_at' => Carbon::now()->subMonths($project->duration_months),
                'ended_at' => Carbon::now(),
            ]);

            $totalCapital = $project->total_capital;

            foreach ($lenders as $lenderId) {
                $amount = ($lenderId === 3) ? $totalCapital * 0.6 : $totalCapital * 0.4;

                Investment::create([
                    'project_id' => $project->id,
                    'lender_id' => $lenderId,
                    'amount' => $amount,
                    'invested_at' => Carbon::now()->subMonths($project->duration_months),
                ]);
            }

            // Create profit distribution (10% profit)
            $investments = $project->investments;
            $totalInvested = $investments->sum('amount');
            $profitAmount = $totalInvested * 0.10;

            foreach ($investments as $investment) {
                $ratio = $investment->amount / $totalInvested;
                $share = $profitAmount * $ratio;

                $investment->lender->lenderWallet?->increment('balance', $share);
                $investment->lender->lenderWallet?->increment('total_profit', $share);

                ProfitDistribution::create([
                    'project_id' => $project->id,
                    'investment_id' => $investment->id,
                    'amount' => $share,
                    'type' => 'profit',
                    'distributed_at' => Carbon::now(),
                ]);
            }
        }
    }
}
