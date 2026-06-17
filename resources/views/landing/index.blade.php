<x-guest-layout>
    {{-- Hero --}}
    <section class="relative min-h-screen flex items-center overflow-hidden bg-dark-primary">
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-gradient-to-br from-dark-primary via-dark-secondary to-dark-primary opacity-90"></div>
            <div class="absolute top-20 left-10 w-72 h-72 bg-gold/5 rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 bg-emerald/5 rounded-full blur-3xl"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-gold/3 rounded-full blur-3xl"></div>
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="text-center max-w-4xl mx-auto">
                <div x-data="{ show: true }" x-init="setTimeout(() => show = true, 200)" x-show="show" x-transition:enter="transition ease-out duration-1000">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gold/10 text-gold border border-gold/30 mb-6">
                        Platform Crowdfunding Tambang Terpercaya
                    </span>
                </div>
                <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-extrabold text-white leading-tight mb-6">
                    Investasi Tambang,
                    <span class="bg-gradient-to-r from-gold to-gold-light bg-clip-text text-transparent">Raih Keuntungan</span>
                    Bersama Kami
                </h1>
                <p class="text-lg sm:text-xl text-gray-400 max-w-2xl mx-auto mb-10">
                    Bergabunglah dengan ribuan investor cerdas yang telah merasakan manfaat investasi sektor pertambangan yang transparan, aman, dan menguntungkan.
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="{{ route('register') }}" class="px-8 py-4 bg-gradient-to-r from-gold to-gold-light text-dark-primary text-lg font-bold rounded-xl hover:from-gold-light hover:to-gold transition-all shadow-lg shadow-gold/25">
                        Mulai Investasi
                    </a>
                    <a href="{{ route('projects.index') }}" class="px-8 py-4 border border-gray-600 text-gray-300 text-lg font-semibold rounded-xl hover:border-gold hover:text-gold transition-all">
                        Lihat Proyek
                    </a>
                </div>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-dark-primary to-transparent"></div>
    </section>

    {{-- Stats --}}
    <section class="relative -mt-20 z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div x-data="{ count: 0, target: {{ $stats['total_projects'] ?? 0 }} }" x-init="() => { const interval = setInterval(() => { if (count < target) count++; else clearInterval(interval); }, 10); }" class="bg-dark-card border border-gray-700 rounded-xl p-6 text-center hover:border-gold/50 transition-all">
                <div class="text-3xl font-bold text-gold mb-1"><span x-text="count"></span>+</div>
                <div class="text-sm text-gray-400">Total Proyek</div>
            </div>
            <div x-data="{ count: 0, target: {{ $stats['total_funding'] ?? 0 }} }" x-init="() => { const interval = setInterval(() => { if (count < target) count += 10000000; else clearInterval(interval); }, 5); }" class="bg-dark-card border border-gray-700 rounded-xl p-6 text-center hover:border-gold/50 transition-all">
                <div class="text-3xl font-bold text-emerald mb-1">Rp <span x-text="count.toLocaleString('id-ID')"></span>+</div>
                <div class="text-sm text-gray-400">Total Dana Terkumpul</div>
            </div>
            <div x-data="{ count: 0, target: {{ $stats['total_investors'] ?? 0 }} }" x-init="() => { const interval = setInterval(() => { if (count < target) count++; else clearInterval(interval); }, 10); }" class="bg-dark-card border border-gray-700 rounded-xl p-6 text-center hover:border-gold/50 transition-all">
                <div class="text-3xl font-bold text-gold mb-1"><span x-text="count"></span>+</div>
                <div class="text-sm text-gray-400">Total Investor</div>
            </div>
            <div x-data="{ count: 0, target: {{ $stats['total_profit'] ?? 0 }} }" x-init="() => { const interval = setInterval(() => { if (count < target) count += 5000000; else clearInterval(interval); }, 5); }" class="bg-dark-card border border-gray-700 rounded-xl p-6 text-center hover:border-gold/50 transition-all">
                <div class="text-3xl font-bold text-emerald mb-1">Rp <span x-text="count.toLocaleString('id-ID')"></span>+</div>
                <div class="text-sm text-gray-400">Total Bagi Hasil</div>
            </div>
        </div>
    </section>

    {{-- How It Works --}}
    <section class="py-20 bg-dark-secondary">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">Bagaimana Cara Kerjanya?</h2>
                <p class="text-gray-400 max-w-2xl mx-auto">Tiga langkah mudah untuk memulai investasi tambang Anda</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center group">
                    <div class="w-20 h-20 mx-auto bg-gradient-to-br from-gold/20 to-gold-light/10 border border-gold/30 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-10 h-10 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                    </div>
                    <div class="relative">
                        <span class="absolute -top-8 left-1/2 -translate-x-1/2 text-6xl font-bold text-gold/10">01</span>
                        <h3 class="text-xl font-bold text-white mb-2">Daftar & Top Up</h3>
                        <p class="text-gray-400">Buat akun Anda dalam hitungan menit dan lakukan deposit saldo untuk mulai berinvestasi.</p>
                    </div>
                </div>
                <div class="text-center group">
                    <div class="w-20 h-20 mx-auto bg-gradient-to-br from-emerald/20 to-emerald-light/10 border border-emerald/30 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-10 h-10 text-emerald" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    </div>
                    <div class="relative">
                        <span class="absolute -top-8 left-1/2 -translate-x-1/2 text-6xl font-bold text-emerald/10">02</span>
                        <h3 class="text-xl font-bold text-white mb-2">Pilih Proyek</h3>
                        <p class="text-gray-400">Jelajahi proyek tambang yang tersedia dan pilih yang paling sesuai dengan tujuan investasi Anda.</p>
                    </div>
                </div>
                <div class="text-center group">
                    <div class="w-20 h-20 mx-auto bg-gradient-to-br from-gold/20 to-emerald/10 border border-gold/30 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-10 h-10 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div class="relative">
                        <span class="absolute -top-8 left-1/2 -translate-x-1/2 text-6xl font-bold text-gold/10">03</span>
                        <h3 class="text-xl font-bold text-white mb-2">Dapatkan Bagi Hasil</h3>
                        <p class="text-gray-400">Nikmati keuntungan dari bagi hasil secara rutin sesuai dengan kesepakatan yang telah ditentukan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Active Projects --}}
    @if(isset($activeProjects) && $activeProjects->count() > 0)
    <section class="py-20 bg-dark-primary">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row justify-between items-center mb-12">
                <div>
                    <h2 class="text-3xl sm:text-4xl font-bold text-white mb-2">Proyek Aktif</h2>
                    <p class="text-gray-400">Proyek pertambangan yang sedang berjalan</p>
                </div>
                <a href="{{ route('projects.index') }}" class="mt-4 sm:mt-0 px-6 py-3 border border-gold/50 text-gold rounded-lg hover:bg-gold/10 transition-all">Lihat Semua</a>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($activeProjects as $project)
                    <x-project-card :project="$project" />
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- About --}}
    <section class="py-20 bg-dark-secondary">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div>
                    <span class="text-gold font-semibold text-sm uppercase tracking-wider">Tentang Kami</span>
                    <h2 class="text-3xl sm:text-4xl font-bold text-white mt-2 mb-6">Mitra Terpercaya dalam Investasi Tambang</h2>
                    <p class="text-gray-400 mb-6">TambangCrowd adalah platform crowdfunding pertama di Indonesia yang fokus pada sektor pertambangan. Kami menghubungkan para pemilik proyek tambang dengan investor yang ingin mendapatkan keuntungan dari bagi hasil yang menarik.</p>
                    <p class="text-gray-400 mb-6">Dengan pengalaman tim yang solid di bidang pertambangan dan teknologi finansial, kami berkomitmen untuk memberikan platform yang transparan, aman, dan menguntungkan bagi semua pihak.</p>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-dark-card border border-gray-700 rounded-lg p-4">
                            <div class="text-2xl font-bold text-gold">2019+</div>
                            <div class="text-sm text-gray-400">Berdiri Sejak</div>
                        </div>
                        <div class="bg-dark-card border border-gray-700 rounded-lg p-4">
                            <div class="text-2xl font-bold text-emerald">100%</div>
                            <div class="text-sm text-gray-400">Transparan</div>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <div class="aspect-square rounded-2xl bg-gradient-to-br from-dark-card to-gray-800 border border-gray-700 flex items-center justify-center">
                        <div class="text-center p-8">
                            <svg class="w-24 h-24 mx-auto text-gold/50 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                            <p class="text-gray-400 italic">"Investasi Tambang, Raih Keuntungan Bersama Kami"</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Why Us --}}
    <section class="py-20 bg-dark-primary">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">Mengapa Memilih Kami?</h2>
                <p class="text-gray-400 max-w-2xl mx-auto">Kelebihan yang membuat kami berbeda dari platform investasi lainnya</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-dark-card border border-gray-700 rounded-xl p-8 hover:border-gold/50 transition-all group">
                    <div class="w-14 h-14 bg-gradient-to-br from-gold/20 to-gold-light/10 border border-gold/30 rounded-xl flex items-center justify-center mb-5 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Legalitas Terjamin</h3>
                    <p class="text-gray-400">Setiap proyek telah melewati proses verifikasi ketat dan memiliki izin usaha yang lengkap dan terdaftar secara hukum.</p>
                </div>
                <div class="bg-dark-card border border-gray-700 rounded-xl p-8 hover:border-gold/50 transition-all group">
                    <div class="w-14 h-14 bg-gradient-to-br from-emerald/20 to-emerald-light/10 border border-emerald/30 rounded-xl flex items-center justify-center mb-5 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-emerald" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Transparan</h3>
                    <p class="text-gray-400">Pantau perkembangan proyek secara real-time. Semua laporan keuangan dan operasional dapat diakses dengan mudah.</p>
                </div>
                <div class="bg-dark-card border border-gray-700 rounded-xl p-8 hover:border-gold/50 transition-all group">
                    <div class="w-14 h-14 bg-gradient-to-br from-gold/20 to-emerald/10 border border-gold/30 rounded-xl flex items-center justify-center mb-5 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Bagi Hasil Menarik</h3>
                    <p class="text-gray-400">Nikmati bagi hasil kompetitif yang dibagikan secara rutin. Potensi keuntungan yang lebih tinggi dibandingkan instrumen investasi lain.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Contact CTA --}}
    <section class="py-20 bg-dark-secondary">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gradient-to-r from-dark-card via-dark-card to-dark-secondary border border-gray-700 rounded-2xl p-8 sm:p-12">
                <div class="grid lg:grid-cols-2 gap-8 items-center">
                    <div>
                        <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">Siap Memulai Investasi?</h2>
                        <p class="text-gray-400 mb-6">Bergabunglah dengan ribuan investor lainnya dan raih keuntungan dari sektor pertambangan Indonesia.</p>
                        <div class="space-y-3 mb-8">
                            <div class="flex items-center text-gray-400">
                                <svg class="w-5 h-5 text-gold mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                <span>info@tambangcrowd.com</span>
                            </div>
                            <div class="flex items-center text-gray-400">
                                <svg class="w-5 h-5 text-gold mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <span>Jakarta, Indonesia</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col space-y-4">
                        <a href="{{ route('register') }}" class="px-8 py-4 bg-gradient-to-r from-gold to-gold-light text-dark-primary text-lg font-bold rounded-xl hover:from-gold-light hover:to-gold transition-all text-center shadow-lg shadow-gold/25">Daftar Sekarang</a>
                        <a href="mailto:info@tambangcrowd.com" class="px-8 py-4 border border-gray-600 text-gray-300 text-lg font-semibold rounded-xl hover:border-gold hover:text-gold transition-all text-center">Hubungi Kami</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>