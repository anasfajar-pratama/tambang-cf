<x-admin-layout>
    <div class="space-y-6">
        <div>
            <h1 class="text-2xl font-bold text-white">Bagi Hasil</h1>
            <p class="text-gray-400 mt-1">Distribusi keuntungan kepada investor</p>
        </div>

        {{-- Distribute Profit Form --}}
        <div class="bg-dark-card border border-gray-700 rounded-xl p-6" x-data="{ showForm: false }">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-bold text-white">Distribusi Bagi Hasil Baru</h2>
                <button @click="showForm = !showForm" class="px-4 py-2 bg-gradient-to-r from-gold to-gold-light text-dark-primary font-bold rounded-lg hover:from-gold-light hover:to-gold transition-all text-sm">
                    <span x-show="!showForm">+ Buat Distribusi</span>
                    <span x-show="showForm">Batal</span>
                </button>
            </div>
            <form x-show="showForm" method="POST" action="{{ route('admin.profit-distributions.store') }}" class="space-y-4 border-t border-gray-700 pt-4">
                @csrf
                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label for="project_id" class="block text-sm font-medium text-gray-300 mb-1">Proyek</label>
                        <select id="project_id" name="project_id" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-4 py-2.5 focus:border-gold focus:ring-gold/20" required>
                            <option value="">Pilih Proyek</option>
                            @foreach($completedProjects ?? [] as $project)
                                <option value="{{ $project->id }}">{{ $project->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="total_profit" class="block text-sm font-medium text-gray-300 mb-1">Total Keuntungan (Rp)</label>
                        <input type="number" id="total_profit" name="total_profit" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-4 py-2.5 focus:border-gold focus:ring-gold/20" required>
                    </div>
                </div>
                <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-gold to-gold-light text-dark-primary font-bold rounded-lg hover:from-gold-light hover:to-gold transition-all">Distribusikan</button>
            </form>
        </div>

        {{-- Distribution History --}}
        <div class="bg-dark-card border border-gray-700 rounded-xl p-6">
            <h2 class="text-lg font-bold text-white mb-4">Riwayat Distribusi</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-gray-400 border-b border-gray-700 bg-dark-primary/50">
                            <th class="text-left py-3 px-4 font-medium">Proyek</th>
                            <th class="text-right py-3 px-4 font-medium">Total Keuntungan</th>
                            <th class="text-left py-3 px-4 font-medium">Tanggal</th>
                            <th class="text-center py-3 px-4 font-medium">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($distributions ?? [] as $distribution)
                            <tr class="border-b border-gray-800 hover:bg-dark-primary/30 transition-colors">
                                <td class="py-3 px-4 text-gray-200">{{ $distribution->project->title ?? '-' }}</td>
                                <td class="py-3 px-4 text-right text-emerald font-semibold">Rp {{ number_format($distribution->total_profit ?? 0, 0, ',', '.') }}</td>
                                <td class="py-3 px-4 text-gray-400">{{ $distribution->created_at ? $distribution->created_at->format('d M Y') : '-' }}</td>
                                <td class="py-3 px-4 text-center">
                                    <button @click="alert('Detail distribusi')" class="text-gold hover:text-gold-light text-xs">Lihat Detail</button>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="py-10 text-center text-gray-500">Belum ada distribusi bagi hasil</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>