<x-lender-layout>
    <div class="max-w-4xl mx-auto space-y-6">
        <div>
            <a href="{{ route('lender.investments.index') }}" class="text-sm text-gray-400 hover:text-gold transition-colors">&larr; Kembali ke Investasi</a>
        </div>

        <div class="grid lg:grid-cols-2 gap-6">
            <div class="bg-dark-card border border-gray-700 rounded-xl p-6">
                <h2 class="text-lg font-bold text-white mb-4">Informasi Investasi</h2>
                <dl class="space-y-3">
                    <div class="flex justify-between">
                        <dt class="text-gray-400">Proyek</dt>
                        <dd class="text-gray-200 font-medium">{{ $investment->project->title ?? '-' }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-400">Jumlah Investasi</dt>
                        <dd class="text-emerald font-semibold text-lg">Rp {{ number_format($investment->amount ?? 0, 0, ',', '.') }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-400">Tanggal Investasi</dt>
                        <dd class="text-gray-200">{{ $investment->created_at ? $investment->created_at->format('d M Y') : '-' }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-400">Status</dt>
                        <dd>
                            @if($investment->status === 'active')
                                <span class="px-2 py-0.5 bg-emerald-900/50 text-emerald text-xs rounded-full border border-emerald-600/50">Aktif</span>
                            @elseif($investment->status === 'completed')
                                <span class="px-2 py-0.5 bg-green-900/50 text-green-400 text-xs rounded-full border border-green-600/50">Selesai</span>
                            @else
                                <span class="px-2 py-0.5 bg-yellow-900/50 text-yellow-400 text-xs rounded-full border border-yellow-600/50">{{ $investment->status }}</span>
                            @endif
                        </dd>
                    </div>
                </dl>
            </div>

            <div class="bg-dark-card border border-gray-700 rounded-xl p-6">
                <h2 class="text-lg font-bold text-white mb-4">Info Proyek</h2>
                <dl class="space-y-3">
                    <div class="flex justify-between">
                        <dt class="text-gray-400">Lokasi</dt>
                        <dd class="text-gray-200">{{ $investment->project->location ?? '-' }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-400">Tipe Tambang</dt>
                        <dd class="text-gray-200">{{ $investment->project->mining_type ?? '-' }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-400">Vendor</dt>
                        <dd class="text-gray-200">{{ $investment->project->vendor->name ?? '-' }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-400">Bagi Hasil Investor</dt>
                        <dd class="text-gold font-semibold">{{ $investment->project->profit_sharing_investor ?? 0 }}%</dd>
                    </div>
                </dl>
                <a href="{{ route('projects.show', $investment->project) }}" class="mt-4 inline-block text-sm text-gold hover:text-gold-light">Lihat Detail Proyek &rarr;</a>
            </div>
        </div>

        <div class="bg-dark-card border border-gray-700 rounded-xl p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-bold text-white">Riwayat Bagi Hasil</h2>
                <p class="text-sm text-gray-400">Total: <span class="text-emerald font-semibold">Rp {{ number_format($investment->total_profit ?? 0, 0, ',', '.') }}</span></p>
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
                        @forelse($investment->profitDistributions ?? [] as $distribution)
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