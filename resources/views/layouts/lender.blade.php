<x-app-layout>
    <div class="flex min-h-[calc(100vh-4rem)]">
        <aside class="hidden lg:flex lg:flex-col w-64 bg-dark-secondary border-r border-gray-800">
            <div class="flex-1 flex flex-col pt-4 pb-4 overflow-y-auto">
                <nav class="flex-1 px-3 space-y-1">
                    <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Menu Investor</p>
                    <a href="{{ route('lender.dashboard') }}" class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('lender.dashboard') ? 'text-gold bg-dark-card border border-gray-700' : 'text-gray-400 hover:text-gold hover:bg-dark-card' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        Dashboard
                    </a>
                    <a href="{{ route('lender.wallet.index') }}" class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('lender.wallet.*') ? 'text-gold bg-dark-card border border-gray-700' : 'text-gray-400 hover:text-gold hover:bg-dark-card' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        Dompet
                    </a>
                    <a href="{{ route('lender.investments.index') }}" class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('lender.investments.*') ? 'text-gold bg-dark-card border border-gray-700' : 'text-gray-400 hover:text-gold hover:bg-dark-card' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                        Investasi Saya
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
</x-app-layout>