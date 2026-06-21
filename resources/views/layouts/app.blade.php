<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Mining Crowdfunding</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>[x-cloak] { display: none !important; }</style>
    </head>
    <body class="font-sans antialiased bg-dark-primary text-gray-100">
        <div class="min-h-screen">
            <nav x-data="{ open: false, mobileOpen: false }" class="bg-dark-secondary border-b border-gray-800">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center">
                            <a href="{{ url('/') }}" class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-gradient-to-br from-gold to-gold-light rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-dark-primary" fill="currentColor" viewBox="0 0 20 20"><path d="M10 0C4.48 0 0 4.48 0 10s4.48 10 10 10 10-4.48 10-10S15.52 0 10 0zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm1-13H9v6h2V5zm0 8H9v2h2v-2z"/></svg>
                                </div>
                                <span class="text-xl font-bold text-gold">TambangCrowd</span>
                            </a>
                        </div>

                        <div class="flex-1 flex items-center justify-end md:gap-6">
                            <a href="{{ url('/') }}" class="text-sm font-medium text-gray-300 hover:text-gold transition-colors">Beranda</a>
                            <a href="{{ route('projects.index') }}" class="text-sm font-medium text-gray-300 hover:text-gold transition-colors">Proyek</a>
                            @auth
                                @if(Auth::user()->role === 'admin')
                                    <a href="{{ route('admin.dashboard') }}" class="text-sm font-medium text-gray-300 hover:text-gold transition-colors">Admin</a>
                                @elseif(Auth::user()->role === 'vendor')
                                    <a href="{{ route('vendor.dashboard') }}" class="text-sm font-medium text-gray-300 hover:text-gold transition-colors">Vendor</a>
                                @elseif(Auth::user()->role === 'lender')
                                    <a href="{{ route('lender.dashboard') }}" class="text-sm font-medium text-gray-300 hover:text-gold transition-colors">Dashboard</a>
                                @endif
                            @endauth
                            <span class="w-8"></span>
                            <div class="hidden md:flex items-center space-x-4">
                            @auth
                                <x-dropdown align="right" width="48" contentClasses="py-1 bg-dark-card border border-gray-700">
                                    <x-slot name="trigger">
                                        <button class="flex items-center space-x-2 px-3 py-2 rounded-lg bg-dark-card border border-gray-700 hover:border-gold transition-colors">
                                            <div class="w-7 h-7 rounded-full bg-gradient-to-br from-gold to-emerald flex items-center justify-center text-xs font-bold text-white">
                                                {{ substr(Auth::user()->name, 0, 1) }}
                                            </div>
                                            <span class="text-sm text-gray-300">{{ Auth::user()->name }}</span>
                                            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                                        </button>
                                    </x-slot>
                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('profile.edit')" class="text-gray-300 hover:text-gold hover:bg-gray-700">Profil</x-dropdown-link>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-gray-300 hover:text-red-400 hover:bg-gray-700">Keluar</x-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                            @else
                                <a href="{{ route('login') }}" class="text-sm font-medium text-gray-300 hover:text-gold transition-colors">Masuk</a>
                                <a href="{{ route('register') }}" class="px-4 py-2 bg-gradient-to-r from-gold to-gold-light text-dark-primary text-sm font-bold rounded-lg hover:from-gold-light hover:to-gold transition-all">Daftar</a>
                            @endauth
                        </div>

                        <div class="md:hidden flex items-center">
                            <button @click="mobileOpen = !mobileOpen" class="p-2 rounded-lg text-gray-400 hover:text-gold hover:bg-gray-800 transition-colors">
                                <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{'hidden': mobileOpen, 'inline-flex': !mobileOpen}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{'hidden': !mobileOpen, 'inline-flex': mobileOpen}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div :class="{'block': mobileOpen, 'hidden': !mobileOpen}" class="hidden md:hidden border-t border-gray-800">
                    <div class="px-4 py-3 space-y-2">
                        <a href="{{ url('/') }}" class="block px-3 py-2 rounded-lg text-sm text-gray-300 hover:text-gold hover:bg-gray-800">Beranda</a>
                        <a href="{{ route('projects.index') }}" class="block px-3 py-2 rounded-lg text-sm text-gray-300 hover:text-gold hover:bg-gray-800">Proyek</a>
                        @auth
                            @if(Auth::user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-lg text-sm text-gray-300 hover:text-gold hover:bg-gray-800">Admin</a>
                            @elseif(Auth::user()->role === 'vendor')
                                <a href="{{ route('vendor.dashboard') }}" class="block px-3 py-2 rounded-lg text-sm text-gray-300 hover:text-gold hover:bg-gray-800">Vendor</a>
                            @elseif(Auth::user()->role === 'lender')
                                <a href="{{ route('lender.dashboard') }}" class="block px-3 py-2 rounded-lg text-sm text-gray-300 hover:text-gold hover:bg-gray-800">Dashboard</a>
                            @endif
                            <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded-lg text-sm text-gray-300 hover:text-gold hover:bg-gray-800">Profil</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-3 py-2 rounded-lg text-sm text-gray-300 hover:text-red-400 hover:bg-gray-800">Keluar</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="block px-3 py-2 rounded-lg text-sm text-gray-300 hover:text-gold hover:bg-gray-800">Masuk</a>
                            <a href="{{ route('register') }}" class="block px-3 py-2 rounded-lg text-sm text-gold font-medium hover:bg-gray-800">Daftar</a>
                        @endauth
                    </div>
                </div>
            </nav>

            @isset($header)
                <header class="bg-dark-secondary border-b border-gray-800">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main>
                {{ $slot }}
            </main>

            <footer class="bg-dark-secondary border-t border-gray-800">
                <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                        <div class="flex items-center space-x-2">
                            <div class="w-6 h-6 bg-gradient-to-br from-gold to-gold-light rounded flex items-center justify-center">
                                <svg class="w-3 h-3 text-dark-primary" fill="currentColor" viewBox="0 0 20 20"><path d="M10 0C4.48 0 0 4.48 0 10s4.48 10 10 10 10-4.48 10-10S15.52 0 10 0zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm1-13H9v6h2V5zm0 8H9v2h2v-2z"/></svg>
                            </div>
                            <span class="text-sm font-semibold text-gold">TambangCrowd</span>
                        </div>
                        <p class="text-sm text-gray-500">&copy; {{ date('Y') }} TambangCrowd. Hak Cipta Dilindungi.</p>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>