<x-admin-layout>
    <div class="space-y-6">
        <div>
            <h1 class="text-2xl font-bold text-white">Kelola Top Up</h1>
            <p class="text-gray-400 mt-1">Kelola permintaan top up dari lender</p>
        </div>

        <div class="bg-dark-card border border-gray-700 rounded-xl overflow-hidden">
            <div class="p-4 border-b border-gray-700 flex gap-3">
                <a href="{{ route('admin.topups.index') }}" class="px-3 py-1.5 rounded-lg text-sm {{ !request('status') ? 'bg-gold/20 text-gold border border-gold/30' : 'text-gray-400 border border-gray-700 hover:border-gold/50' }}">Semua</a>
                <a href="{{ route('admin.topups.index', ['status' => 'pending']) }}" class="px-3 py-1.5 rounded-lg text-sm {{ request('status') === 'pending' ? 'bg-yellow-900/50 text-yellow-400 border border-yellow-600/50' : 'text-gray-400 border border-gray-700 hover:border-gold/50' }}">Pending</a>
                <a href="{{ route('admin.topups.index', ['status' => 'approved']) }}" class="px-3 py-1.5 rounded-lg text-sm {{ request('status') === 'approved' ? 'bg-emerald-900/50 text-emerald border border-emerald-600/50' : 'text-gray-400 border border-gray-700 hover:border-gold/50' }}">Disetujui</a>
                <a href="{{ route('admin.topups.index', ['status' => 'rejected']) }}" class="px-3 py-1.5 rounded-lg text-sm {{ request('status') === 'rejected' ? 'bg-red-900/50 text-red-400 border border-red-600/50' : 'text-gray-400 border border-gray-700 hover:border-gold/50' }}">Ditolak</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-gray-400 border-b border-gray-700 bg-dark-primary/50">
                            <th class="text-left py-3 px-4 font-medium">Lender</th>
                            <th class="text-right py-3 px-4 font-medium">Jumlah</th>
                            <th class="text-left py-3 px-4 font-medium">Status</th>
                            <th class="text-left py-3 px-4 font-medium">Tanggal</th>
                            <th class="text-center py-3 px-4 font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($topups as $topup)
                            <tr class="border-b border-gray-800 hover:bg-dark-primary/30 transition-colors">
                                <td class="py-3 px-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-gold to-emerald flex items-center justify-center text-xs font-bold text-white">{{ substr($topup->user->name ?? '?', 0, 1) }}</div>
                                        <span class="text-gray-200">{{ $topup->user->name ?? '-' }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-4 text-right text-gray-200 font-semibold">Rp {{ number_format($topup->amount ?? 0, 0, ',', '.') }}</td>
                                <td class="py-3 px-4">
                                    @if($topup->status === 'pending')
                                        <span class="px-2 py-0.5 bg-yellow-900/50 text-yellow-400 text-xs rounded-full border border-yellow-600/50">Pending</span>
                                    @elseif($topup->status === 'approved')
                                        <span class="px-2 py-0.5 bg-emerald-900/50 text-emerald text-xs rounded-full border border-emerald-600/50">Disetujui</span>
                                    @else
                                        <span class="px-2 py-0.5 bg-red-900/50 text-red-400 text-xs rounded-full border border-red-600/50">Ditolak</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-gray-400">{{ $topup->created_at ? $topup->created_at->format('d M Y H:i') : '-' }}</td>
                                <td class="py-3 px-4">
                                    @if($topup->status === 'pending')
                                        <div class="flex items-center justify-center space-x-2">
                                            <form method="POST" action="{{ route('admin.topups.approve', $topup) }}" class="inline">
                                                @csrf
                                                <button type="submit" class="px-3 py-1 bg-emerald-900/50 text-emerald text-xs rounded-lg border border-emerald-600/50 hover:bg-emerald-900/70 transition-all">Setujui</button>
                                            </form>
                                            <form method="POST" action="{{ route('admin.topups.reject', $topup) }}" class="inline">
                                                @csrf
                                                <button type="submit" class="px-3 py-1 bg-red-900/50 text-red-400 text-xs rounded-lg border border-red-600/50 hover:bg-red-900/70 transition-all">Tolak</button>
                                            </form>
                                        </div>
                                    @else
                                        <span class="text-gray-500 text-xs">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="py-10 text-center text-gray-500">Belum ada top up</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if(isset($topups) && $topups->hasPages())
                <div class="p-4 border-t border-gray-700">{{ $topups->links() }}</div>
            @endif
        </div>
    </div>
</x-admin-layout>