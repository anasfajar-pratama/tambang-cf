<x-lender-layout>
    <div class="space-y-6">
        <div>
            <h1 class="text-2xl font-bold text-white">Halo, {{ $user->name }}!</h1>
            <p class="text-gray-400 mt-1">Ringkasan portofolio investasi Anda</p>
        </div>

        <div class="grid sm:grid-cols-4 gap-4">
            <div class="bg-dark-card border border-gray-700 rounded-xl p-6">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-sm text-gray-400">Total Asset</p>
                    <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                </div>
                <p class="text-2xl font-bold text-blue-400">Rp {{ number_format($totalAsset, 0, ',', '.') }}</p>
                <p class="text-xs text-gray-500 mt-2">Total seluruh saldo yang pernah di-topup</p>
            </div>
            <div class="bg-dark-card border border-gray-700 rounded-xl p-6">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-sm text-gray-400">Saldo Tersedia</p>
                    <svg class="w-5 h-5 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
                <p class="text-2xl font-bold text-gold">Rp {{ number_format($walletBalance, 0, ',', '.') }}</p>
                <a href="{{ route('lender.wallet.index') }}" class="text-xs text-gray-500 hover:text-gold mt-2 inline-block">Top Up &rarr;</a>
            </div>
            <div class="bg-dark-card border border-gray-700 rounded-xl p-6">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-sm text-gray-400">Total Investasi</p>
                    <svg class="w-5 h-5 text-emerald" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                </div>
                <p class="text-2xl font-bold text-emerald">Rp {{ number_format($totalInvested, 0, ',', '.') }}</p>
                <p class="text-xs text-gray-500 mt-2">Diinvestasikan di proyek berjalan</p>
            </div>
            <div class="bg-dark-card border border-gray-700 rounded-xl p-6">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-sm text-gray-400">Total Pendapatan</p>
                    <svg class="w-5 h-5 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <p class="text-2xl font-bold text-gold">Rp {{ number_format($totalProfit, 0, ',', '.') }}</p>
                <p class="text-xs text-gray-500 mt-2">Imbal hasil dari proyek</p>
            </div>
        </div>

        <div class="grid lg:grid-cols-2 gap-6">
            <div class="bg-dark-card border border-gray-700 rounded-xl p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-bold text-white">Investasi Terbaru</h2>
                    <a href="{{ route('lender.investments.index') }}" class="text-xs text-gold hover:underline">Lihat Semua</a>
                </div>
                <div class="space-y-3">
                    @forelse($recentInvestments as $investment)
                        <a href="{{ route('lender.investments.show', $investment) }}" class="flex items-center justify-between p-3 bg-dark-primary rounded-lg hover:border-gold/50 border border-transparent transition-all">
                            <div>
                                <p class="text-sm font-medium text-gray-200">{{ $investment->project->title ?? '-' }}</p>
                                <p class="text-xs text-gray-500">{{ $investment->created_at ? $investment->created_at->format('d M Y') : '-' }}</p>
                            </div>
                            <p class="text-sm font-semibold text-emerald">Rp {{ number_format($investment->amount, 0, ',', '.') }}</p>
                        </a>
                    @empty
                        <p class="text-sm text-gray-500 text-center py-4">Belum ada investasi</p>
                    @endforelse
                </div>
            </div>

            <div class="bg-dark-card border border-gray-700 rounded-xl p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-bold text-white">Bagi Hasil Terbaru</h2>
                </div>
                <div class="space-y-3">
                    @forelse($recentProfitDistributions as $distribution)
                        <div class="flex items-center justify-between p-3 bg-dark-primary rounded-lg border border-transparent">
                            <div>
                                <p class="text-sm font-medium text-gray-200">{{ $distribution->investment->project->title ?? '-' }}</p>
                                <p class="text-xs text-gray-500">{{ $distribution->distributed_at ? $distribution->distributed_at->format('d M Y') : '-' }}</p>
                            </div>
                            <p class="text-sm font-semibold text-gold">+Rp {{ number_format($distribution->amount, 0, ',', '.') }}</p>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500 text-center py-4">Belum ada bagi hasil</p>
                    @endforelse
                </div>
            </div>

            <div class="bg-dark-card border border-gray-700 rounded-xl p-6 lg:col-span-2">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-bold text-white">Proyek Aktif untuk Didanai</h2>
                    <a href="{{ route('projects.index') }}" class="text-xs text-gold hover:underline">Lihat Semua</a>
                </div>
                <div class="grid sm:grid-cols-2 gap-3">
                    @forelse($activeProjects as $project)
                        <a href="{{ route('projects.show', $project) }}" class="flex items-center justify-between p-3 bg-dark-primary rounded-lg hover:border-gold/50 border border-transparent transition-all">
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-200 truncate">{{ $project->title }}</p>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="text-xs text-gray-500">{{ $project->mining_type }}</span>
                                    <span class="text-xs text-gray-600">|</span>
                                    <span class="text-xs text-gray-500 truncate">{{ $project->location }}</span>
                                </div>
                                <div class="flex items-center space-x-2 mt-2">
                                    <div class="w-24 bg-gray-700 rounded-full h-1.5">
                                        <div class="bg-gradient-to-r from-gold to-emerald h-1.5 rounded-full" style="width: {{ $project->target_capital > 0 ? min(($project->progress_percentage), 100) : 0 }}%"></div>
                                    </div>
                                    <span class="text-xs text-gray-500">{{ $project->target_capital > 0 ? number_format(min($project->progress_percentage, 100), 0) : 0 }}%</span>
                                </div>
                            </div>
                            <div class="ml-3">
                                <x-project-status-badge :status="$project->status" />
                            </div>
                        </a>
                    @empty
                        <p class="text-sm text-gray-500 text-center py-4 col-span-2">Tidak ada proyek aktif saat ini</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-lender-layout>