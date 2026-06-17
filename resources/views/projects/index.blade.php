<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-white">Jelajahi Proyek</h1>
                <p class="text-gray-400 mt-1">Temukan proyek pertambangan yang sesuai dengan Anda</p>
            </div>
            <div class="mt-4 sm:mt-0 flex items-center space-x-3">
                <select class="bg-dark-card border border-gray-700 text-gray-300 rounded-lg px-4 py-2 text-sm focus:border-gold focus:ring-gold/20" onchange="window.location.href = this.value">
                    <option value="{{ route('projects.index') }}" {{ !request('status') ? 'selected' : '' }}>Semua Status</option>
                    <option value="{{ route('projects.index', ['status' => 'fundraising']) }}" {{ request('status') === 'fundraising' ? 'selected' : '' }}>Penggalangan Dana</option>
                    <option value="{{ route('projects.index', ['status' => 'active']) }}" {{ request('status') === 'active' ? 'selected' : '' }}>Berjalan</option>
                    <option value="{{ route('projects.index', ['status' => 'completed']) }}" {{ request('status') === 'completed' ? 'selected' : '' }}>Selesai</option>
                </select>
                <select class="bg-dark-card border border-gray-700 text-gray-300 rounded-lg px-4 py-2 text-sm focus:border-gold focus:ring-gold/20" onchange="window.location.href = this.value">
                    <option value="{{ route('projects.index') }}" {{ !request('mining_type') ? 'selected' : '' }}>Semua Tipe</option>
                    <option value="{{ route('projects.index', ['mining_type' => 'Batubara']) }}" {{ request('mining_type') === 'Batubara' ? 'selected' : '' }}>Batubara</option>
                    <option value="{{ route('projects.index', ['mining_type' => 'Emas']) }}" {{ request('mining_type') === 'Emas' ? 'selected' : '' }}>Emas</option>
                    <option value="{{ route('projects.index', ['mining_type' => 'Nikel']) }}" {{ request('mining_type') === 'Nikel' ? 'selected' : '' }}>Nikel</option>
                    <option value="{{ route('projects.index', ['mining_type' => 'Tembaga']) }}" {{ request('mining_type') === 'Tembaga' ? 'selected' : '' }}>Tembaga</option>
                </select>
            </div>
        </div>

        @if($projects->count() > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($projects as $project)
                    <x-project-card :project="$project" />
                @endforeach
            </div>
            <div class="mt-8">
                {{ $projects->links() }}
            </div>
        @else
            <div class="text-center py-20">
                <svg class="w-16 h-16 mx-auto text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                <h3 class="text-xl font-semibold text-gray-300 mb-2">Belum Ada Proyek</h3>
                <p class="text-gray-500">Belum ada proyek yang tersedia saat ini.</p>
            </div>
        @endif
    </div>
</x-app-layout>