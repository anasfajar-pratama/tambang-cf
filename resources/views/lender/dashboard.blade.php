<x-lender-layout>
    <div class="space-y-6">
        <div>
            <h1 class="text-2xl font-bold text-white">Dashboard Investor</h1>
            <p class="text-gray-400 mt-1">Ringkasan portofolio investasi Anda</p>
        </div>

        <div class="grid sm:grid-cols-3 gap-4">
            <div class="bg-dark-card border border-gray-700 rounded-xl p-6">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-sm text-gray-400">Saldo Tersedia</p>
                    <svg class="w-5 h-5 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
                <p class="text-2xl font-bold text-gold">Rp {{ number_format($walletBalance ?? 0, 0, ',', '.') }}</p>
                <a href="{{ route('lender.wallet.index') }}" class="text-xs text-gray-500 hover:text-gold mt-2 inline-block">Top Up &rarr;</a>
            </div>
            <div class="bg-dark-card border border-gray-700 rounded-xl p-6">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-sm text-gray-400">Total Investasi</p>
                    <svg class="w-5 h-5 text-emerald" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                </div>
                <p class="text-2xl font-bold text-emerald">Rp {{ number_format($totalInvested ?? 0, 0, ',', '.') }}</p>
            </div>
            <div class="bg-dark-card border border-gray-700 rounded-xl p-6">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-sm text-gray-400">Total Pendapatan</p>
                    <svg class="w-5 h-5 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <p class="text-2xl font-bold text-gold">Rp {{ number_format($totalProfit ?? 0, 0, ',', '.') }}</p>
            </div>
        </div>

        <div class="grid lg:grid-cols-2 gap-6">
            <div class="bg-dark-card border border-gray-700 rounded-xl p-6">
                <h2 class="text-lg font-bold text-white mb-4">Investasi Terbaru</h2>
                <div class="space-y-3">
                    @forelse($recentInvestments ?? [] as $investment)
                        <a href="{{ route('lender.investments.show', $investment) }}" class="flex items-center justify-between p-3 bg-dark-primary rounded-lg hover:border-gold/50 border border-transparent transition-all">
                            <div>
                                <p class="text-sm font-medium text-gray-200">{{ $investment->project->title ?? '-' }}</p>
                                <p class="text-xs text-gray-500">{{ $investment->created_at ? $investment->created_at->format('d M Y') : '-' }}</p>
                            </div>
                            <p class="text-sm font-semibold text-emerald">Rp {{ number_format($investment->amount ?? 0, 0, ',', '.') }}</p>
                        </a>
                    @empty
                        <p class="text-sm text-gray-500 text-center py-4">Belum ada investasi</p>
                    @endforelse
                </div>
            </div>

            <div class="bg-dark-card border border-gray-700 rounded-xl p-6">
                <h2 class="text-lg font-bold text-white mb-4">Proyek Aktif untuk Didanai</h2>
                <div class="space-y-3">
                    @forelse($activeProjects ?? [] as $project)
                        <a href="{{ route('projects.show', $project) }}" class="flex items-center justify-between p-3 bg-dark-primary rounded-lg hover:border-gold/50 border border-transparent transition-all">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-200">{{ $project->title }}</p>
                                <div class="flex items-center space-x-2 mt-1">
                                    <div class="w-20 bg-gray-700 rounded-full h-1.5">
                                        <div class="bg-gradient-to-r from-gold to-emerald h-1.5 rounded-full" style="width: {{ $project->target_capital > 0 ? min(($project->collected_capital / $project->target_capital) * 100, 100) : 0 }}%"></div>
                                    </div>
                                    <span class="text-xs text-gray-500">{{ $project->target_capital > 0 ? number_format(min(($project->collected_capital / $project->target_capital) * 100, 100), 0) : 0 }}%</span>
                                </div>
                            </div>
                            <x-project-status-badge :status="$project->status" />
                        </a>
                    @empty
                        <p class="text-sm text-gray-500 text-center py-4">Tidak ada proyek aktif saat ini</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-lender-layout>