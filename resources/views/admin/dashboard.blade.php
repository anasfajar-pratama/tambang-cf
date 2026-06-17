<x-admin-layout>
    <div class="space-y-6">
        <div>
            <h1 class="text-2xl font-bold text-white">Dashboard Admin</h1>
            <p class="text-gray-400 mt-1">Ringkasan data platform TambangCrowd</p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4">
            <div class="bg-dark-card border border-gray-700 rounded-xl p-5">
                <p class="text-sm text-gray-400 mb-1">Total Pengguna</p>
                <p class="text-2xl font-bold text-white">{{ $stats['total_users'] ?? 0 }}</p>
            </div>
            <div class="bg-dark-card border border-gray-700 rounded-xl p-5">
                <p class="text-sm text-gray-400 mb-1">Total Vendor</p>
                <p class="text-2xl font-bold text-gold">{{ $stats['total_vendors'] ?? 0 }}</p>
            </div>
            <div class="bg-dark-card border border-gray-700 rounded-xl p-5">
                <p class="text-sm text-gray-400 mb-1">Total Lender</p>
                <p class="text-2xl font-bold text-emerald">{{ $stats['total_lenders'] ?? 0 }}</p>
            </div>
            <div class="bg-dark-card border border-gray-700 rounded-xl p-5">
                <p class="text-sm text-gray-400 mb-1">Total Proyek</p>
                <p class="text-2xl font-bold text-white">{{ $stats['total_projects'] ?? 0 }}</p>
            </div>
            <div class="bg-dark-card border border-gray-700 rounded-xl p-5">
                <p class="text-sm text-gray-400 mb-1">Penggalangan Aktif</p>
                <p class="text-2xl font-bold text-gold">{{ $stats['active_fundraising'] ?? 0 }}</p>
            </div>
            <div class="bg-dark-card border border-gray-700 rounded-xl p-5">
                <p class="text-sm text-gray-400 mb-1">Top Up Pending</p>
                <p class="text-2xl font-bold text-yellow-400">{{ $stats['pending_topups'] ?? 0 }}</p>
            </div>
        </div>

        <div class="grid lg:grid-cols-2 gap-6">
            <div class="bg-dark-card border border-gray-700 rounded-xl p-6">
                <h2 class="text-lg font-bold text-white mb-4">Proyek Terbaru</h2>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="text-gray-400 border-b border-gray-700">
                                <th class="text-left py-2 font-medium">Judul</th>
                                <th class="text-left py-2 font-medium">Vendor</th>
                                <th class="text-left py-2 font-medium">Status</th>
                                <th class="text-right py-2 font-medium">Target</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentProjects ?? [] as $project)
                                <tr class="border-b border-gray-800">
                                    <td class="py-3 text-gray-200">{{ Str::limit($project->title, 30) }}</td>
                                    <td class="py-3 text-gray-400">{{ $project->vendor->name ?? '-' }}</td>
                                    <td class="py-3"><x-project-status-badge :status="$project->status" /></td>
                                    <td class="py-3 text-right text-gray-200">Rp {{ number_format($project->target_capital ?? 0, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="py-6 text-center text-gray-500">Belum ada proyek</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="bg-dark-card border border-gray-700 rounded-xl p-6">
                <h2 class="text-lg font-bold text-white mb-4">Top Up Terbaru</h2>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="text-gray-400 border-b border-gray-700">
                                <th class="text-left py-2 font-medium">Lender</th>
                                <th class="text-right py-2 font-medium">Jumlah</th>
                                <th class="text-left py-2 font-medium">Status</th>
                                <th class="text-left py-2 font-medium">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentTopups ?? [] as $topup)
                                <tr class="border-b border-gray-800">
                                    <td class="py-3 text-gray-200">{{ $topup->user->name ?? '-' }}</td>
                                    <td class="py-3 text-right text-gray-200">Rp {{ number_format($topup->amount ?? 0, 0, ',', '.') }}</td>
                                    <td class="py-3">
                                        @if($topup->status === 'pending')
                                            <span class="px-2 py-0.5 bg-yellow-900/50 text-yellow-400 text-xs rounded-full border border-yellow-600/50">Pending</span>
                                        @elseif($topup->status === 'approved')
                                            <span class="px-2 py-0.5 bg-emerald-900/50 text-emerald text-xs rounded-full border border-emerald-600/50">Disetujui</span>
                                        @else
                                            <span class="px-2 py-0.5 bg-red-900/50 text-red-400 text-xs rounded-full border border-red-600/50">Ditolak</span>
                                        @endif
                                    </td>
                                    <td class="py-3 text-gray-400">{{ $topup->created_at ? $topup->created_at->format('d M Y') : '-' }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="py-6 text-center text-gray-500">Belum ada top up</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>