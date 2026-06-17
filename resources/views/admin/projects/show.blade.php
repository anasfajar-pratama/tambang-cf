<x-admin-layout>
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <a href="{{ route('admin.projects.index') }}" class="text-sm text-gray-400 hover:text-gold transition-colors">&larr; Kembali</a>
                <h1 class="text-2xl font-bold text-white mt-1">{{ $project->title }}</h1>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('admin.projects.edit', $project) }}" class="px-4 py-2 bg-dark-card border border-gray-700 text-gray-300 rounded-lg hover:border-gold hover:text-gold transition-all text-sm">Edit</a>
                <form method="POST" action="{{ route('admin.projects.destroy', $project) }}" onsubmit="return confirm('Hapus proyek ini?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-900/50 border border-red-700 text-red-400 rounded-lg hover:bg-red-900/70 transition-all text-sm">Hapus</button>
                </form>
            </div>
        </div>

        <div class="grid lg:grid-cols-2 gap-6">
            <div class="bg-dark-card border border-gray-700 rounded-xl p-6">
                <h2 class="text-lg font-bold text-white mb-4">Informasi Proyek</h2>
                <dl class="space-y-3">
                    <div class="flex justify-between"><dt class="text-gray-400">Status</dt><dd><x-project-status-badge :status="$project->status" /></dd></div>
                    <div class="flex justify-between"><dt class="text-gray-400">Vendor</dt><dd class="text-gray-200">{{ $project->vendor->name ?? '-' }}</dd></div>
                    <div class="flex justify-between"><dt class="text-gray-400">Lokasi</dt><dd class="text-gray-200">{{ $project->location ?? '-' }}</dd></div>
                    <div class="flex justify-between"><dt class="text-gray-400">Tipe Tambang</dt><dd class="text-gray-200">{{ $project->mining_type ?? '-' }}</dd></div>
                    <div class="flex justify-between"><dt class="text-gray-400">Tipe Investasi</dt><dd class="text-gray-200">{{ $project->investment_type === 'equity' ? 'Ekuitas' : 'Pendanaan' }}</dd></div>
                    <div class="flex justify-between"><dt class="text-gray-400">Luas Lahan</dt><dd class="text-gray-200">{{ $project->land_area ?? '-' }}</dd></div>
                    <div class="flex justify-between"><dt class="text-gray-400">Izin</dt><dd class="text-gray-200">{{ $project->permit_status ?? '-' }}</dd></div>
                    <div class="flex justify-between"><dt class="text-gray-400">Risiko</dt><dd class="text-gray-200">{{ $project->risk_level ?? '-' }}</dd></div>
                    <div class="flex justify-between"><dt class="text-gray-400">Durasi</dt><dd class="text-gray-200">{{ $project->duration ?? '-' }}</dd></div>
                </dl>
            </div>
            <div class="bg-dark-card border border-gray-700 rounded-xl p-6">
                <h2 class="text-lg font-bold text-white mb-4">Keuangan</h2>
                <dl class="space-y-3">
                    <div class="flex justify-between"><dt class="text-gray-400">Target Pendanaan</dt><dd class="text-gray-200 font-semibold">Rp {{ number_format($project->target_capital ?? 0, 0, ',', '.') }}</dd></div>
                    <div class="flex justify-between"><dt class="text-gray-400">Terkumpul</dt><dd class="text-emerald font-semibold">Rp {{ number_format($project->collected_capital ?? 0, 0, ',', '.') }}</dd></div>
                    <div class="flex justify-between"><dt class="text-gray-400">Min. Investasi</dt><dd class="text-gray-200">Rp {{ number_format($project->min_investment ?? 0, 0, ',', '.') }}</dd></div>
                    <div class="flex justify-between"><dt class="text-gray-400">Progress</dt>
                        <dd class="text-gray-200">
                            <div class="flex items-center space-x-2">
                                <div class="w-24 bg-gray-700 rounded-full h-2"><div class="bg-gradient-to-r from-gold to-emerald h-2 rounded-full" style="width: {{ $project->target_capital > 0 ? min(($project->collected_capital / $project->target_capital) * 100, 100) : 0 }}%"></div></div>
                                <span class="text-xs">{{ $project->target_capital > 0 ? number_format(min(($project->collected_capital / $project->target_capital) * 100, 100), 1) : 0 }}%</span>
                            </div>
                        </dd>
                    </div>
                    <div class="flex justify-between"><dt class="text-gray-400">Bagi Hasil</dt><dd class="text-gray-200 text-sm">V:{{ $project->profit_sharing_vendor ?? 0 }}% / I:{{ $project->profit_sharing_investor ?? 0 }}% / P:{{ $project->profit_sharing_platform ?? 0 }}%</dd></div>
                </dl>
            </div>
        </div>

        @if($project->description)
        <div class="bg-dark-card border border-gray-700 rounded-xl p-6">
            <h2 class="text-lg font-bold text-white mb-4">Deskripsi</h2>
            <p class="text-gray-300 leading-relaxed">{{ $project->description }}</p>
        </div>
        @endif
    </div>
</x-admin-layout>