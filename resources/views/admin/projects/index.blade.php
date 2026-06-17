<x-admin-layout>
    <div class="space-y-6">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
            <div>
                <h1 class="text-2xl font-bold text-white">Kelola Proyek</h1>
                <p class="text-gray-400 mt-1">Daftar semua proyek pertambangan</p>
            </div>
            <a href="{{ route('admin.projects.create') }}" class="mt-4 sm:mt-0 px-4 py-2 bg-gradient-to-r from-gold to-gold-light text-dark-primary font-bold rounded-lg hover:from-gold-light hover:to-gold transition-all">+ Tambah Proyek</a>
        </div>

        <div class="bg-dark-card border border-gray-700 rounded-xl overflow-hidden">
            <div class="p-4 border-b border-gray-700">
                <form class="flex flex-col sm:flex-row gap-3">
                    <input type="text" name="search" placeholder="Cari proyek..." value="{{ request('search') }}" class="flex-1 bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-4 py-2 text-sm focus:border-gold focus:ring-gold/20">
                    <select name="status" class="bg-dark-primary border border-gray-700 text-gray-300 rounded-lg px-4 py-2 text-sm focus:border-gold focus:ring-gold/20">
                        <option value="">Semua Status</option>
                        <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Menunggu</option>
                        <option value="fundraising" {{ request('status') === 'fundraising' ? 'selected' : '' }}>Penggalangan Dana</option>
                        <option value="funded" {{ request('status') === 'funded' ? 'selected' : '' }}>Terdanai</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Berjalan</option>
                        <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Selesai</option>
                        <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                    <button type="submit" class="px-4 py-2 bg-dark-primary border border-gray-700 text-gray-300 rounded-lg hover:border-gold transition-all text-sm">Filter</button>
                </form>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-gray-400 border-b border-gray-700 bg-dark-primary/50">
                            <th class="text-left py-3 px-4 font-medium">Judul</th>
                            <th class="text-left py-3 px-4 font-medium">Vendor</th>
                            <th class="text-left py-3 px-4 font-medium">Status</th>
                            <th class="text-right py-3 px-4 font-medium">Target</th>
                            <th class="text-right py-3 px-4 font-medium">Terkumpul</th>
                            <th class="text-center py-3 px-4 font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($projects as $project)
                            <tr class="border-b border-gray-800 hover:bg-dark-primary/30 transition-colors">
                                <td class="py-3 px-4 text-gray-200 font-medium">{{ $project->title }}</td>
                                <td class="py-3 px-4 text-gray-400">{{ $project->vendor->name ?? '-' }}</td>
                                <td class="py-3 px-4"><x-project-status-badge :status="$project->status" /></td>
                                <td class="py-3 px-4 text-right text-gray-200">Rp {{ number_format($project->target_capital ?? 0, 0, ',', '.') }}</td>
                                <td class="py-3 px-4 text-right text-emerald">Rp {{ number_format($project->collected_capital ?? 0, 0, ',', '.') }}</td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="{{ route('admin.projects.show', $project) }}" class="p-1.5 text-gray-400 hover:text-gold transition-colors" title="Lihat">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        </a>
                                        <a href="{{ route('admin.projects.edit', $project) }}" class="p-1.5 text-gray-400 hover:text-gold transition-colors" title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        </a>
                                        <form method="POST" action="{{ route('admin.projects.destroy', $project) }}" onsubmit="return confirm('Hapus proyek ini?')" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="p-1.5 text-gray-400 hover:text-red-400 transition-colors" title="Hapus">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="py-10 text-center text-gray-500">Belum ada proyek</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if(isset($projects) && $projects->hasPages())
                <div class="p-4 border-t border-gray-700">
                    {{ $projects->links() }}
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>