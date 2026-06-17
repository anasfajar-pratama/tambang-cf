<x-lender-layout>
    <div class="space-y-6">
        <div>
            <h1 class="text-2xl font-bold text-white">Investasi Saya</h1>
            <p class="text-gray-400 mt-1">Daftar semua investasi yang telah Anda lakukan</p>
        </div>

        <div class="bg-dark-card border border-gray-700 rounded-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-gray-400 border-b border-gray-700 bg-dark-primary/50">
                            <th class="text-left py-3 px-4 font-medium">Proyek</th>
                            <th class="text-right py-3 px-4 font-medium">Jumlah</th>
                            <th class="text-left py-3 px-4 font-medium">Tanggal</th>
                            <th class="text-left py-3 px-4 font-medium">Status</th>
                            <th class="text-right py-3 px-4 font-medium">Keuntungan</th>
                            <th class="text-center py-3 px-4 font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($investments as $investment)
                            <tr class="border-b border-gray-800 hover:bg-dark-primary/30 transition-colors">
                                <td class="py-3 px-4 text-gray-200 font-medium">{{ $investment->project->title ?? '-' }}</td>
                                <td class="py-3 px-4 text-right text-gray-200">Rp {{ number_format($investment->amount ?? 0, 0, ',', '.') }}</td>
                                <td class="py-3 px-4 text-gray-400">{{ $investment->created_at ? $investment->created_at->format('d M Y') : '-' }}</td>
                                <td class="py-3 px-4">
                                    @if($investment->status === 'active')
                                        <span class="px-2 py-0.5 bg-emerald-900/50 text-emerald text-xs rounded-full border border-emerald-600/50">Aktif</span>
                                    @elseif($investment->status === 'completed')
                                        <span class="px-2 py-0.5 bg-green-900/50 text-green-400 text-xs rounded-full border border-green-600/50">Selesai</span>
                                    @else
                                        <span class="px-2 py-0.5 bg-yellow-900/50 text-yellow-400 text-xs rounded-full border border-yellow-600/50">{{ $investment->status }}</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-right text-emerald font-semibold">Rp {{ number_format($investment->total_profit ?? 0, 0, ',', '.') }}</td>
                                <td class="py-3 px-4 text-center">
                                    <a href="{{ route('lender.investments.show', $investment) }}" class="text-gold hover:text-gold-light text-xs font-medium">Detail</a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="py-10 text-center text-gray-500">
                                Belum ada investasi. <a href="{{ route('projects.index') }}" class="text-gold hover:underline">Jelajahi proyek</a>
                            </td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if(isset($investments) && $investments->hasPages())
                <div class="p-4 border-t border-gray-700">{{ $investments->links() }}</div>
            @endif
        </div>
    </div>
</x-lender-layout>