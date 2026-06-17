<x-vendor-layout>
    <div class="space-y-6">
        <div>
            <h1 class="text-2xl font-bold text-white">Dashboard Vendor</h1>
            <p class="text-gray-400 mt-1">Ringkasan proyek dan pendanaan Anda</p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-dark-card border border-gray-700 rounded-xl p-5">
                <p class="text-sm text-gray-400 mb-1">Total Proyek</p>
                <p class="text-2xl font-bold text-white">{{ $stats['total_projects'] ?? 0 }}</p>
            </div>
            <div class="bg-dark-card border border-gray-700 rounded-xl p-5">
                <p class="text-sm text-gray-400 mb-1">Proyek Aktif</p>
                <p class="text-2xl font-bold text-gold">{{ $stats['active_projects'] ?? 0 }}</p>
            </div>
            <div class="bg-dark-card border border-gray-700 rounded-xl p-5">
                <p class="text-sm text-gray-400 mb-1">Proyek Selesai</p>
                <p class="text-2xl font-bold text-emerald">{{ $stats['completed_projects'] ?? 0 }}</p>
            </div>
            <div class="bg-dark-card border border-gray-700 rounded-xl p-5">
                <p class="text-sm text-gray-400 mb-1">Total Pendanaan</p>
                <p class="text-2xl font-bold text-gold">Rp {{ number_format($stats['total_funding'] ?? 0, 0, ',', '.') }}</p>
            </div>
        </div>

        <div class="bg-dark-card border border-gray-700 rounded-xl p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-bold text-white">Proyek Saya</h2>
                <a href="{{ route('vendor.projects.create') }}" class="px-4 py-2 bg-gradient-to-r from-gold to-gold-light text-dark-primary font-bold rounded-lg hover:from-gold-light hover:to-gold transition-all text-sm">+ Proyek Baru</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-gray-400 border-b border-gray-700">
                            <th class="text-left py-2 font-medium">Judul</th>
                            <th class="text-left py-2 font-medium">Status</th>
                            <th class="text-right py-2 font-medium">Target</th>
                            <th class="text-right py-2 font-medium">Terkumpul</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($projects ?? [] as $project)
                            <tr class="border-b border-gray-800">
                                <td class="py-3 text-gray-200">{{ Str::limit($project->title, 40) }}</td>
                                <td class="py-3"><x-project-status-badge :status="$project->status" /></td>
                                <td class="py-3 text-right text-gray-200">Rp {{ number_format($project->target_capital ?? 0, 0, ',', '.') }}</td>
                                <td class="py-3 text-right text-emerald">Rp {{ number_format($project->collected_capital ?? 0, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="py-6 text-center text-gray-500">Belum ada proyek. <a href="{{ route('vendor.projects.create') }}" class="text-gold hover:underline">Buat proyek pertama</a></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-vendor-layout>