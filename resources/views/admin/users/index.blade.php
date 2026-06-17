<x-admin-layout>
    <div class="space-y-6">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
            <div>
                <h1 class="text-2xl font-bold text-white">Kelola Pengguna</h1>
                <p class="text-gray-400 mt-1">Daftar semua pengguna platform</p>
            </div>
            <a href="{{ route('admin.users.create') }}" class="mt-4 sm:mt-0 px-4 py-2 bg-gradient-to-r from-gold to-gold-light text-dark-primary font-bold rounded-lg hover:from-gold-light hover:to-gold transition-all">+ Tambah Pengguna</a>
        </div>

        <div class="bg-dark-card border border-gray-700 rounded-xl overflow-hidden">
            <div class="p-4 border-b border-gray-700">
                <form class="flex flex-col sm:flex-row gap-3">
                    <input type="text" name="search" placeholder="Cari nama atau email..." value="{{ request('search') }}" class="flex-1 bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-4 py-2 text-sm focus:border-gold focus:ring-gold/20">
                    <select name="role" class="bg-dark-primary border border-gray-700 text-gray-300 rounded-lg px-4 py-2 text-sm focus:border-gold focus:ring-gold/20">
                        <option value="">Semua Role</option>
                        <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="vendor" {{ request('role') === 'vendor' ? 'selected' : '' }}>Vendor</option>
                        <option value="lender" {{ request('role') === 'lender' ? 'selected' : '' }}>Lender</option>
                    </select>
                    <button type="submit" class="px-4 py-2 bg-dark-primary border border-gray-700 text-gray-300 rounded-lg hover:border-gold transition-all text-sm">Filter</button>
                </form>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-gray-400 border-b border-gray-700 bg-dark-primary/50">
                            <th class="text-left py-3 px-4 font-medium">Nama</th>
                            <th class="text-left py-3 px-4 font-medium">Email</th>
                            <th class="text-left py-3 px-4 font-medium">Role</th>
                            <th class="text-left py-3 px-4 font-medium">Status</th>
                            <th class="text-center py-3 px-4 font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr class="border-b border-gray-800 hover:bg-dark-primary/30 transition-colors">
                                <td class="py-3 px-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-gold to-emerald flex items-center justify-center text-xs font-bold text-white">{{ substr($user->name, 0, 1) }}</div>
                                        <span class="text-gray-200 font-medium">{{ $user->name }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-4 text-gray-400">{{ $user->email }}</td>
                                <td class="py-3 px-4">
                                    @if($user->role === 'admin')
                                        <span class="px-2 py-0.5 bg-gold/20 text-gold text-xs rounded-full border border-gold/30">Admin</span>
                                    @elseif($user->role === 'vendor')
                                        <span class="px-2 py-0.5 bg-blue-900/50 text-blue-400 text-xs rounded-full border border-blue-600/50">Vendor</span>
                                    @else
                                        <span class="px-2 py-0.5 bg-emerald-900/50 text-emerald text-xs rounded-full border border-emerald-600/50">Lender</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4">
                                    @if($user->is_active ?? true)
                                        <span class="text-emerald text-xs flex items-center"><svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="10"/></svg>Aktif</span>
                                    @else
                                        <span class="text-red-400 text-xs flex items-center"><svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="10"/></svg>Nonaktif</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="{{ route('admin.users.edit', $user) }}" class="p-1.5 text-gray-400 hover:text-gold transition-colors" title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        </a>
                                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Hapus pengguna ini?')" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="p-1.5 text-gray-400 hover:text-red-400 transition-colors" title="Hapus">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="py-10 text-center text-gray-500">Belum ada pengguna</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if(isset($users) && $users->hasPages())
                <div class="p-4 border-t border-gray-700">{{ $users->links() }}</div>
            @endif
        </div>
    </div>
</x-admin-layout>