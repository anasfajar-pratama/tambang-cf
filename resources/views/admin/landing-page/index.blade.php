<x-admin-layout>
    <div class="space-y-6">
        <div>
            <h1 class="text-2xl font-bold text-white">Kelola Landing Page</h1>
            <p class="text-gray-400 mt-1">Atur konten halaman utama website</p>
        </div>

        <div class="space-y-6">
            {{-- Hero Section --}}
            <div class="bg-dark-card border border-gray-700 rounded-xl p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-bold text-white">Hero Section</h2>
                    <span class="px-2 py-0.5 bg-gold/20 text-gold text-xs rounded-full border border-gold/30">Aktif</span>
                </div>
                <form method="POST" action="{{ route('admin.landing-page.update', 'hero') }}" class="space-y-4">
                    @csrf @method('PUT')
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Judul Utama</label>
                        <input type="text" name="hero_title" value="{{ old('hero_title', $hero_title ?? 'Investasi Tambang, Raih Keuntungan Bersama Kami') }}" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-4 py-2.5 focus:border-gold focus:ring-gold/20">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Subjudul</label>
                        <textarea name="hero_subtitle" rows="3" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-4 py-2.5 focus:border-gold focus:ring-gold/20">{{ old('hero_subtitle', $hero_subtitle ?? 'Bergabunglah dengan ribuan investor cerdas yang telah merasakan manfaat investasi sektor pertambangan yang transparan, aman, dan menguntungkan.') }}</textarea>
                    </div>
                    <button type="submit" class="px-4 py-2 bg-gradient-to-r from-gold to-gold-light text-dark-primary font-bold rounded-lg hover:from-gold-light hover:to-gold transition-all text-sm">Simpan</button>
                </form>
            </div>

            {{-- Stats Section --}}
            <div class="bg-dark-card border border-gray-700 rounded-xl p-6">
                <h2 class="text-lg font-bold text-white mb-4">Statistik</h2>
                <form method="POST" action="{{ route('admin.landing-page.update', 'stats') }}" class="grid sm:grid-cols-2 gap-4">
                    @csrf @method('PUT')
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Total Proyek</label>
                        <input type="number" name="total_projects" value="{{ old('total_projects', $total_projects ?? 0) }}" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-4 py-2.5 focus:border-gold focus:ring-gold/20">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Total Dana Terkumpul (Rp)</label>
                        <input type="number" name="total_funding" value="{{ old('total_funding', $total_funding ?? 0) }}" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-4 py-2.5 focus:border-gold focus:ring-gold/20">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Total Investor</label>
                        <input type="number" name="total_investors" value="{{ old('total_investors', $total_investors ?? 0) }}" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-4 py-2.5 focus:border-gold focus:ring-gold/20">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Total Bagi Hasil (Rp)</label>
                        <input type="number" name="total_profit" value="{{ old('total_profit', $total_profit ?? 0) }}" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-4 py-2.5 focus:border-gold focus:ring-gold/20">
                    </div>
                    <div class="sm:col-span-2">
                        <button type="submit" class="px-4 py-2 bg-gradient-to-r from-gold to-gold-light text-dark-primary font-bold rounded-lg hover:from-gold-light hover:to-gold transition-all text-sm">Simpan Statistik</button>
                    </div>
                </form>
            </div>

            {{-- About Section --}}
            <div class="bg-dark-card border border-gray-700 rounded-xl p-6">
                <h2 class="text-lg font-bold text-white mb-4">Tentang Kami</h2>
                <form method="POST" action="{{ route('admin.landing-page.update', 'about') }}" class="space-y-4">
                    @csrf @method('PUT')
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Judul</label>
                        <input type="text" name="about_title" value="{{ old('about_title', $about_title ?? 'Mitra Terpercaya dalam Investasi Tambang') }}" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-4 py-2.5 focus:border-gold focus:ring-gold/20">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Deskripsi</label>
                        <textarea name="about_description" rows="5" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-4 py-2.5 focus:border-gold focus:ring-gold/20">{{ old('about_description', $about_description ?? '') }}</textarea>
                    </div>
                    <button type="submit" class="px-4 py-2 bg-gradient-to-r from-gold to-gold-light text-dark-primary font-bold rounded-lg hover:from-gold-light hover:to-gold transition-all text-sm">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>