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
                    <div class="flex justify-between"><dt class="text-gray-400">Tipe Investasi</dt><dd class="text-gray-200">{{ $project->investment_type === 'single' ? 'Investor Tunggal' : 'Multi Investor' }}</dd></div>
                    <div class="flex justify-between"><dt class="text-gray-400">Luas Lahan</dt><dd class="text-gray-200">{{ $project->luas_lahan ?? '-' }}</dd></div>
                    <div class="flex justify-between"><dt class="text-gray-400">Izin</dt><dd class="text-gray-200">{{ $project->permit_status ?? '-' }}</dd></div>
                    <div class="flex justify-between"><dt class="text-gray-400">Risiko</dt><dd class="text-gray-200">{{ $project->risk_level ?? '-' }}</dd></div>
                    <div class="flex justify-between"><dt class="text-gray-400">Durasi</dt><dd class="text-gray-200">{{ $project->duration_months ?? '-' }} bulan</dd></div>
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
                    <div class="flex justify-between"><dt class="text-gray-400">Bagi Hasil</dt><dd class="text-gray-200 text-sm">Vendor: {{ $project->vendor_share ?? 0 }}% / Investor: {{ $project->investor_share ?? 0 }}%</dd></div>
                </dl>
            </div>
        </div>

        @if($project->description)
        <div class="bg-dark-card border border-gray-700 rounded-xl p-6">
            <h2 class="text-lg font-bold text-white mb-4">Deskripsi</h2>
            <p class="text-gray-300 leading-relaxed">{{ $project->description }}</p>
        </div>
        @endif

        @if($project->galleries->count() > 0)
        <div class="bg-dark-card border border-gray-700 rounded-xl p-6">
            <h2 class="text-lg font-bold text-white mb-4">Galeri</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                @foreach($project->galleries as $gallery)
                    <div class="aspect-video rounded-lg overflow-hidden bg-dark-primary">
                        <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->caption ?? '' }}" class="w-full h-full object-cover">
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        @if($project->milestones->count() > 0)
        <div class="bg-dark-card border border-gray-700 rounded-xl p-6">
            <h2 class="text-lg font-bold text-white mb-4">Pencapaian</h2>
            <div class="relative">
                <div class="absolute left-4 top-0 bottom-0 w-0.5 bg-gray-700"></div>
                @foreach($project->milestones as $milestone)
                    <div class="relative pl-10 mb-6">
                        <div class="absolute left-2.5 top-1.5 w-3 h-3 rounded-full {{ $milestone->is_completed ? 'bg-emerald' : 'bg-gray-600' }} border-2 border-dark-card"></div>
                        <h4 class="font-semibold text-gray-200">{{ $milestone->phase_name }}</h4>
                        @if($milestone->description)<p class="text-sm text-gray-400">{{ $milestone->description }}</p>@endif
                        @if($milestone->target_date)<p class="text-xs text-gray-500 mt-1">{{ \Carbon\Carbon::parse($milestone->target_date)->format('d M Y') }}</p>@endif
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        @if($project->documents->count() > 0)
        <div class="bg-dark-card border border-gray-700 rounded-xl p-6">
            <h2 class="text-lg font-bold text-white mb-4">Dokumen</h2>
            <div class="space-y-3">
                @foreach($project->documents as $doc)
                    <a href="{{ asset('storage/' . $doc->file) }}" target="_blank" class="flex items-center p-3 bg-dark-primary rounded-lg hover:border-gold/50 border border-transparent transition-all">
                        <svg class="w-8 h-8 text-gold mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-200">{{ $doc->name }}</p>
                            <p class="text-xs text-gray-500">{{ ucfirst($doc->type) }}</p>
                        </div>
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    </a>
                @endforeach
            </div>
        </div>
        @endif

        @if($project->faqs->count() > 0)
        <div class="bg-dark-card border border-gray-700 rounded-xl p-6">
            <h2 class="text-lg font-bold text-white mb-4">FAQ</h2>
            <div class="space-y-3" x-data="{ active: null }">
                @foreach($project->faqs as $index => $faq)
                    <div class="bg-dark-primary rounded-lg overflow-hidden border border-gray-700">
                        <button @click="active = active === {{ $index }} ? null : {{ $index }}" class="w-full flex items-center justify-between p-4 text-left">
                            <span class="font-medium text-gray-200">{{ $faq->question }}</span>
                            <svg class="w-5 h-5 text-gray-400 transition-transform flex-shrink-0 ml-2" :class="active === {{ $index }} ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="active === {{ $index }}" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="border-t border-gray-700">
                            <p class="p-4 text-sm text-gray-400">{{ $faq->answer }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</x-admin-layout>
