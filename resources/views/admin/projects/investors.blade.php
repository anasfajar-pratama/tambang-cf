<x-admin-layout>
    <div class="space-y-6">
        <div>
            <a href="{{ route('admin.projects.index') }}" class="text-sm text-gray-400 hover:text-gold transition-colors">&larr; Kembali ke daftar proyek</a>
            <h1 class="text-2xl font-bold text-white mt-1">Pendana: {{ $project->title }}</h1>
            <p class="text-gray-400 mt-1">Daftar lender yang telah berinvestasi di proyek ini</p>
        </div>

        <div class="bg-dark-card border border-gray-700 rounded-xl p-6">
            <div class="grid grid-cols-3 gap-6 mb-6">
                <div>
                    <p class="text-sm text-gray-500">Total Terkumpul</p>
                    <p class="text-xl font-bold text-emerald mt-1">Rp {{ number_format($totalCollected, 0, ',', '.') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Jumlah Pendana</p>
                    <p class="text-xl font-bold text-white mt-1">{{ $investments->count() }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Bagi Hasil Investor</p>
                    <p class="text-xl font-bold text-gold mt-1">{{ $project->investor_share }}%</p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-gray-400 border-b border-gray-700 bg-dark-primary/50">
                            <th class="text-left py-3 px-4 font-medium">Pendana</th>
                            <th class="text-right py-3 px-4 font-medium">Investasi</th>
                            <th class="text-right py-3 px-4 font-medium">Kepemilikan</th>
                            <th class="text-right py-3 px-4 font-medium">Estimasi Bagi Hasil</th>
                            <th class="text-center py-3 px-4 font-medium">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($investments as $inv)
                            <tr class="border-b border-gray-800 hover:bg-dark-primary/30 transition-colors">
                                <td class="py-3 px-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-gold to-emerald flex items-center justify-center text-xs font-bold text-dark-primary">
                                            {{ substr($inv->lender?->name ?? 'U', 0, 1) }}
                                        </div>
                                        <span class="text-gray-200">{{ $inv->lender?->name ?? 'Unknown' }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-4 text-right text-gray-200 font-medium">Rp {{ number_format($inv->amount, 0, ',', '.') }}</td>
                                <td class="py-3 px-4 text-right text-gray-200">{{ number_format($inv->ownership_pct, 2) }}%</td>
                                <td class="py-3 px-4 text-right text-emerald font-medium">{{ number_format($inv->estimated_share_pct, 2) }}%</td>
                                <td class="py-3 px-4 text-center text-gray-400">{{ $inv->created_at->format('d M Y') }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="py-10 text-center text-gray-500">Belum ada pendana untuk proyek ini</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>
