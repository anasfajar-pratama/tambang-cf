<x-lender-layout>
    <div class="max-w-5xl mx-auto space-y-6">
        <div>
            <a href="{{ route('lender.investments.index') }}" class="text-sm text-gray-400 hover:text-gold transition-colors">&larr; Kembali ke Investasi</a>
        </div>

        <div class="grid lg:grid-cols-2 gap-6">
            {{-- My Investment Card --}}
            <div class="bg-dark-card border border-gray-700 rounded-xl p-6">
                <h2 class="text-lg font-bold text-white mb-4">Investasi Saya</h2>
                <dl class="space-y-3">
                    <div class="flex justify-between">
                        <dt class="text-gray-400">Proyek</dt>
                        <dd class="text-gray-200 font-medium text-right">{{ $investment->project->title ?? '-' }}</dd>
                    </div>
                    <div class="flex justify-between items-center py-2 border-t border-gray-800">
                        <dt class="text-gray-400">Nominal Investasi</dt>
                        <dd class="text-emerald font-bold text-xl">Rp {{ number_format($investment->amount ?? 0, 0, ',', '.') }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-400">Tanggal Investasi</dt>
                        <dd class="text-gray-200">{{ $investment->invested_at ? \Carbon\Carbon::parse($investment->invested_at)->format('d M Y') : ($investment->created_at ? $investment->created_at->format('d M Y') : '-') }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-400">Status Investasi</dt>
                        <dd>
                            <x-project-status-badge :status="$project->status" />
                        </dd>
                    </div>
                </dl>
            </div>

            {{-- Project Info Card --}}
            <div class="bg-dark-card border border-gray-700 rounded-xl p-6">
                <h2 class="text-lg font-bold text-white mb-4">Info Proyek</h2>
                <dl class="space-y-3">
                    <div class="flex justify-between">
                        <dt class="text-gray-400">Lokasi</dt>
                        <dd class="text-gray-200">{{ $project->location ?? '-' }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-400">Tipe Tambang</dt>
                        <dd class="text-gray-200">{{ $project->mining_type ?? '-' }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-400">Vendor</dt>
                        <dd class="text-gray-200">{{ $project->vendor->company_name ?? $project->vendor->user?->name ?? '-' }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-400">Bagi Hasil Investor</dt>
                        <dd class="text-gold font-semibold">{{ $project->investor_share ?? 0 }}%</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-400">Status Proyek</dt>
                        <dd><x-project-status-badge :status="$project->status" /></dd>
                    </div>
                </dl>

                {{-- Progress Bar --}}
                <div class="mt-4 pt-4 border-t border-gray-700">
                    <div class="flex justify-between text-sm mb-1">
                        <span class="text-gray-400">Terkumpul</span>
                        <span class="text-gray-200 font-medium">{{ $project->total_capital > 0 ? number_format(min(($totalCollected / $project->total_capital) * 100, 100), 1) : 0 }}%</span>
                    </div>
                    <div class="w-full bg-gray-700 rounded-full h-2.5">
                        <div class="bg-gradient-to-r from-gold to-emerald h-2.5 rounded-full" style="width: {{ $project->total_capital > 0 ? min(($totalCollected / $project->total_capital) * 100, 100) : 0 }}%"></div>
                    </div>
                    <div class="flex justify-between text-xs text-gray-500 mt-1">
                        <span>Rp {{ number_format($totalCollected, 0, ',', '.') }}</span>
                        <span>Rp {{ number_format($project->total_capital, 0, ',', '.') }}</span>
                    </div>
                </div>

                <a href="{{ route('projects.show', $project) }}" class="mt-4 inline-block text-sm text-gold hover:text-gold-light">&rarr; Lihat Detail Proyek</a>
            </div>
        </div>

        {{-- Riwayat Investasi di Proyek Ini --}}
        <div class="bg-dark-card border border-gray-700 rounded-xl p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-bold text-white">Riwayat Investasi</h2>
                <p class="text-sm text-gray-400">{{ $project->investments->count() }} investor</p>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-gray-400 border-b border-gray-700 bg-dark-primary/50">
                            <th class="text-left py-3 px-4 font-medium">Investor</th>
                            <th class="text-right py-3 px-4 font-medium">Jumlah</th>
                            <th class="text-right py-3 px-4 font-medium">Kepemilikan</th>
                            <th class="text-center py-3 px-4 font-medium">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($project->investments as $inv)
                            <tr class="border-b border-gray-800">
                                <td class="py-3 px-4">
                                    <div class="flex items-center space-x-2">
                                        <div class="w-7 h-7 rounded-full bg-gradient-to-br from-gold to-emerald flex items-center justify-center text-xs font-bold text-dark-primary">
                                            {{ substr($inv->lender?->name ?? 'U', 0, 1) }}
                                        </div>
                                        <span class="text-gray-200">{{ $inv->lender?->name ?? 'Unknown' }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-4 text-right text-gray-200 font-medium">Rp {{ number_format($inv->amount, 0, ',', '.') }}</td>
                                <td class="py-3 px-4 text-right text-gray-400">
                                    @php $pct = $totalCollected > 0 ? round(($inv->amount / $totalCollected) * 100, 2) : 0; @endphp
                                    {{ number_format($pct, 2) }}%
                                </td>
                                <td class="py-3 px-4 text-center text-gray-400">{{ $inv->invested_at ? \Carbon\Carbon::parse($inv->invested_at)->format('d M Y') : $inv->created_at->format('d M Y') }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="py-8 text-center text-gray-500">Belum ada investor lain</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Riwayat Bagi Hasil --}}
        <div class="bg-dark-card border border-gray-700 rounded-xl p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-bold text-white">Riwayat Bagi Hasil</h2>
                <p class="text-sm text-gray-400">Total: <span class="text-emerald font-semibold">Rp {{ number_format($investment->profitDistributions->sum('amount') ?? 0, 0, ',', '.') }}</span></p>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-gray-400 border-b border-gray-700 bg-dark-primary/50">
                            <th class="text-left py-3 px-4 font-medium">Tanggal</th>
                            <th class="text-right py-3 px-4 font-medium">Jumlah</th>
                            <th class="text-left py-3 px-4 font-medium">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($investment->profitDistributions as $distribution)
                            <tr class="border-b border-gray-800">
                                <td class="py-3 px-4 text-gray-400">{{ $distribution->created_at ? $distribution->created_at->format('d M Y') : '-' }}</td>
                                <td class="py-3 px-4 text-right text-emerald font-semibold">Rp {{ number_format($distribution->amount ?? 0, 0, ',', '.') }}</td>
                                <td class="py-3 px-4 text-gray-400">{{ $distribution->description ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="py-8 text-center text-gray-500">Belum ada distribusi bagi hasil</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-lender-layout>
