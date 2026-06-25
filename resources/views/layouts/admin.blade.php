<x-app-layout>
    <div x-data="notification">
        <div class="flex min-h-[calc(100vh-4rem)]">
            <aside class="hidden lg:flex lg:flex-col w-64 bg-dark-secondary border-r border-gray-800">
                <div class="flex-1 flex flex-col pt-4 pb-4 overflow-y-auto">
                    <nav class="flex-1 px-3 space-y-1">
                        <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Menu Admin</p>
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.dashboard') ? 'text-gold bg-dark-card border border-gray-700' : 'text-gray-400 hover:text-gold hover:bg-dark-card' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                            Dashboard
                        </a>
                        <a href="{{ route('admin.projects.index') }}" class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.projects.*') ? 'text-gold bg-dark-card border border-gray-700' : 'text-gray-400 hover:text-gold hover:bg-dark-card' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                            Proyek
                        </a>
                        <a href="{{ route('admin.users.index') }}" class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.users.*') ? 'text-gold bg-dark-card border border-gray-700' : 'text-gray-400 hover:text-gold hover:bg-dark-card' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/></svg>
                            Pengguna
                        </a>
                        <a href="{{ route('admin.topups.index') }}" class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.topups.*') ? 'text-gold bg-dark-card border border-gray-700' : 'text-gray-400 hover:text-gold hover:bg-dark-card' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                            Top Up
                        </a>
                        <a href="{{ route('admin.landing-page.index') }}" class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.landing-page.*') ? 'text-gold bg-dark-card border border-gray-700' : 'text-gray-400 hover:text-gold hover:bg-dark-card' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            Landing Page
                        </a>
                        <a href="{{ route('admin.profit-distributions.index') }}" class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.profit-distributions.*') ? 'text-gold bg-dark-card border border-gray-700' : 'text-gray-400 hover:text-gold hover:bg-dark-card' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Bagi Hasil
                        </a>
                    </nav>
                </div>
            </aside>

            <div class="flex-1 flex flex-col">
                <div class="flex-1 p-4 sm:p-6 lg:p-8">
                    {{ $slot }}
                </div>
            </div>
        </div>

        <div x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2" class="fixed bottom-6 right-6 z-50 px-6 py-3.5 rounded-xl shadow-2xl flex items-center space-x-3" :class="type === 'success' ? 'bg-emerald-500 text-white' : 'bg-red-500 text-white'" style="display: none;">
            <template x-if="type === 'success'">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </template>
            <template x-if="type === 'error'">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </template>
            <span x-text="message" class="text-sm font-medium"></span>
        </div>
    </div>

    @php
        $hasFlash = session()->has('success') || session()->has('error');
        $flashMessage = session('success', session('error', ''));
        $flashType = session()->has('success') ? 'success' : (session()->has('error') ? 'error' : 'success');
    @endphp
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('notification', () => ({
                show: @json($hasFlash),
                message: @json($flashMessage),
                type: @json($flashType),
                init() {
                    if (this.show) {
                        setTimeout(() => this.show = false, 4000);
                    }
                }
            }));
        });
    </script>
</x-app-layout>