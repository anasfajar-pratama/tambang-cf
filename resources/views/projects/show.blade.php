<x-app-layout>
    {{-- Hero --}}
    <section class="relative h-[50vh] min-h-[400px] overflow-hidden">
        @if($project->cover_image)
            <img src="{{ asset('storage/' . $project->cover_image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover">
        @else
            <div class="w-full h-full bg-gradient-to-br from-dark-card to-gray-800"></div>
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-dark-primary via-dark-primary/60 to-transparent"></div>
        <div class="absolute bottom-0 left-0 right-0 p-6 sm:p-8 lg:p-12">
            <div class="max-w-7xl mx-auto">
                <div class="flex items-center space-x-3 mb-3">
                    <x-project-status-badge :status="$project->status" />
                    @if($project->investment_type)
                        <span class="px-3 py-1 bg-dark-primary/80 text-gold text-xs font-semibold rounded-lg border border-gold/30">{{ $project->investment_type === 'single' ? 'Investor Tunggal' : 'Multi Investor' }}</span>
                    @endif
                </div>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white mb-2">{{ $project->title }}</h1>
                @if($project->tagline)
                    <p class="text-lg sm:text-xl text-gray-300 max-w-3xl">{{ $project->tagline }}</p>
                @endif
            </div>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 relative z-10">
        {{-- Funding Progress Card --}}
        <div class="bg-dark-card border border-gray-700 rounded-xl p-6 sm:p-8 mb-8">
            <div class="grid sm:grid-cols-2 lg:grid-cols-5 gap-6">
                <div>
                    <p class="text-sm text-gray-400 mb-1">Target Pendanaan</p>
                    <p class="text-xl font-bold text-white">Rp {{ number_format($project->target_capital ?? 0, 0, ',', '.') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-400 mb-1">Terkumpul</p>
                    <p class="text-xl font-bold text-emerald">Rp {{ number_format($project->collected_capital ?? 0, 0, ',', '.') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-400 mb-1">Min. Investasi</p>
                    <p class="text-xl font-bold text-white">Rp {{ number_format($project->min_investment ?? 0, 0, ',', '.') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-400 mb-1">Sisa Waktu</p>
                    <p class="text-xl font-bold text-gold">{{ $project->days_remaining ?? '-' }} Hari</p>
                </div>
                <div>
                    <p class="text-sm text-gray-400 mb-1">Progress</p>
                    <div class="mt-2">
                        <div class="w-full bg-gray-700 rounded-full h-3">
                            <div class="bg-gradient-to-r from-gold to-emerald h-3 rounded-full" style="width: {{ $project->target_capital > 0 ? min(($project->collected_capital / $project->target_capital) * 100, 100) : 0 }}%"></div>
                        </div>
                        <p class="text-sm text-gray-400 mt-1">{{ $project->target_capital > 0 ? number_format(min(($project->collected_capital / $project->target_capital) * 100, 100), 1) : 0 }}% terkumpul</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-8">
                {{-- Project Info Grid --}}
                <div class="bg-dark-card border border-gray-700 rounded-xl p-6">
                    <h2 class="text-xl font-bold text-white mb-4">Informasi Proyek</h2>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                        <div class="p-3 bg-dark-primary rounded-lg">
                            <p class="text-xs text-gray-500">Lokasi</p>
                            <p class="text-sm font-semibold text-gray-200">{{ $project->location ?? '-' }}</p>
                        </div>
                        <div class="p-3 bg-dark-primary rounded-lg">
                            <p class="text-xs text-gray-500">Tipe Tambang</p>
                            <p class="text-sm font-semibold text-gray-200">{{ $project->mining_type ?? '-' }}</p>
                        </div>
                        <div class="p-3 bg-dark-primary rounded-lg">
                            <p class="text-xs text-gray-500">Luas Lahan</p>
                            <p class="text-sm font-semibold text-gray-200">{{ $project->land_area ?? '-' }}</p>
                        </div>
                        <div class="p-3 bg-dark-primary rounded-lg">
                            <p class="text-xs text-gray-500">Izin Usaha</p>
                            <p class="text-sm font-semibold text-gray-200">{{ $project->permit_status ?? '-' }}</p>
                        </div>
                        <div class="p-3 bg-dark-primary rounded-lg">
                            <p class="text-xs text-gray-500">Tingkat Risiko</p>
                            <p class="text-sm font-semibold text-gray-200">{{ $project->risk_level ?? '-' }}</p>
                        </div>
                        <div class="p-3 bg-dark-primary rounded-lg">
                            <p class="text-xs text-gray-500">Durasi</p>
                            <p class="text-sm font-semibold text-gray-200">{{ $project->duration ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                {{-- Description --}}
                @if($project->description)
                <div class="bg-dark-card border border-gray-700 rounded-xl p-6">
                    <h2 class="text-xl font-bold text-white mb-4">Tentang Proyek</h2>
                    <div class="text-gray-300 leading-relaxed prose prose-invert max-w-none">
                        {!! nl2br(e($project->description)) !!}
                    </div>
                </div>
                @endif

                {{-- Profit Sharing --}}
                @if($project->investor_share || $project->vendor_share)
                <div class="bg-dark-card border border-gray-700 rounded-xl p-6 mb-8">
                    <h2 class="text-xl font-bold text-white mb-4">Skema Bagi Hasil</h2>
                    <div class="flex items-center justify-center space-x-8 py-8">
                        <div class="text-center">
                            <div class="w-24 h-24 rounded-full border-4 border-gold flex items-center justify-center mx-auto mb-3">
                                <span class="text-2xl font-bold text-gold">{{ $project->vendor_share ?? 0 }}%</span>
                            </div>
                            <p class="text-sm text-gray-400">Vendor</p>
                        </div>
                        <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        <div class="text-center">
                            <div class="w-24 h-24 rounded-full border-4 border-emerald flex items-center justify-center mx-auto mb-3">
                                <span class="text-2xl font-bold text-emerald">{{ $project->investor_share ?? 0 }}%</span>
                            </div>
                            <p class="text-sm text-gray-400">Investor</p>
                        </div>
                    </div>
                </div>
                @endif

                {{-- Milestones --}}
                @if(isset($project->milestones) && $project->milestones->count() > 0)
                <div class="bg-dark-card border border-gray-700 rounded-xl p-6">
                    <h2 class="text-xl font-bold text-white mb-4">Pencapaian</h2>
                    <div class="relative">
                        <div class="absolute left-4 top-0 bottom-0 w-0.5 bg-gray-700"></div>
                        <div class="space-y-6">
                            @foreach($project->milestones as $milestone)
                                <div class="relative pl-10">
                                    <div class="absolute left-2.5 top-1.5 w-3 h-3 rounded-full {{ $milestone->is_completed ? 'bg-emerald' : 'bg-gray-600' }} border-2 border-dark-card"></div>
                                    <div>
                                        <h4 class="font-semibold text-gray-200">{{ $milestone->title }}</h4>
                                        @if($milestone->description)
                                            <p class="text-sm text-gray-400">{{ $milestone->description }}</p>
                                        @endif
                                        @if($milestone->date)
                                            <p class="text-xs text-gray-500 mt-1">{{ \Carbon\Carbon::parse($milestone->date)->format('d M Y') }}</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                {{-- Gallery --}}
                @if(isset($project->gallery) && $project->gallery->count() > 0)
                <div class="bg-dark-card border border-gray-700 rounded-xl p-6">
                    <h2 class="text-xl font-bold text-white mb-4">Galeri</h2>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                        @foreach($project->gallery as $image)
                            <div class="aspect-video rounded-lg overflow-hidden bg-dark-primary">
                                <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $image->caption ?? '' }}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Documents --}}
                @if(isset($project->documents) && $project->documents->count() > 0)
                <div class="bg-dark-card border border-gray-700 rounded-xl p-6">
                    <h2 class="text-xl font-bold text-white mb-4">Dokumen</h2>
                    <div class="space-y-3">
                        @foreach($project->documents as $document)
                            <a href="{{ asset('storage/' . $document->file) }}" target="_blank" class="flex items-center p-3 bg-dark-primary rounded-lg hover:border-gold/50 border border-transparent transition-all">
                                <svg class="w-8 h-8 text-gold mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-200">{{ $document->title }}</p>
                                    @if($document->description)
                                        <p class="text-xs text-gray-500">{{ $document->description }}</p>
                                    @endif
                                </div>
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                            </a>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- FAQ --}}
                @if(isset($project->faqs) && $project->faqs->count() > 0)
                <div class="bg-dark-card border border-gray-700 rounded-xl p-6">
                    <h2 class="text-xl font-bold text-white mb-4">FAQ</h2>
                    <div class="space-y-3" x-data="{ active: null }">
                        @foreach($project->faqs as $index => $faq)
                            <div class="bg-dark-primary rounded-lg overflow-hidden border border-gray-700">
                                <button @click="active = active === {{ $index }} ? null : {{ $index }}" class="w-full flex items-center justify-between p-4 text-left">
                                    <span class="font-medium text-gray-200">{{ $faq->question }}</span>
                                    <svg class="w-5 h-5 text-gray-400 transition-transform" :class="active === {{ $index }} ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                </button>
                                <div x-show="active === {{ $index }}" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 max-h-0" x-transition:enter-end="opacity-100 max-h-96" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 max-h-96" x-transition:leave-end="opacity-0 max-h-0" class="border-t border-gray-700">
                                    <p class="p-4 text-sm text-gray-400">{{ $faq->answer }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <div class="space-y-6">
                {{-- Vendor Info --}}
                @if($project->vendor)
                <div class="bg-dark-card border border-gray-700 rounded-xl p-6">
                    <h2 class="text-lg font-bold text-white mb-4">Vendor</h2>
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-gold to-emerald flex items-center justify-center text-lg font-bold text-white">
                            {{ substr($project->vendor->name, 0, 1) }}
                        </div>
                        <div>
                            <p class="font-semibold text-gray-200">{{ $project->vendor->name }}</p>
                            @if($project->vendor->company)
                                <p class="text-sm text-gray-400">{{ $project->vendor->company }}</p>
                            @endif
                        </div>
                    </div>
                    @if($project->vendor->bio)
                        <p class="text-sm text-gray-400">{{ $project->vendor->bio }}</p>
                    @endif
                </div>
                @endif

                {{-- Invest Form --}}
                @if($project->status === 'fundraising' && auth()->check() && auth()->user()->role === 'lender')
                <div class="bg-dark-card border border-gray-700 rounded-xl p-6 sticky top-8">
                    <h2 class="text-lg font-bold text-white mb-4">Investasi Sekarang</h2>
                    <form method="POST" action="{{ route('investments.store', $project) }}" class="space-y-4">
                        @csrf
                        <div>
                            <label for="amount" class="block text-sm font-medium text-gray-300 mb-1">Jumlah Investasi (Rp)</label>
                            <input type="number" id="amount" name="amount" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-4 py-2.5 focus:border-gold focus:ring-gold/20" placeholder="Min. Rp {{ number_format($project->min_investment ?? 0, 0, ',', '.') }}" min="{{ $project->min_investment ?? 0 }}" required>
                            <x-input-error class="mt-2" :messages="$errors->get('amount')" />
                        </div>
                        <p class="text-xs text-gray-500">Saldo Anda: Rp {{ number_format(auth()->user()->wallet->balance ?? 0, 0, ',', '.') }}</p>
                        <button type="submit" class="w-full px-6 py-3 bg-gradient-to-r from-gold to-gold-light text-dark-primary font-bold rounded-lg hover:from-gold-light hover:to-gold transition-all">Investasi Sekarang</button>
                    </form>
                </div>
                @elseif(!auth()->check())
                <div class="bg-dark-card border border-gray-700 rounded-xl p-6 text-center sticky top-8">
                    <svg class="w-12 h-12 mx-auto text-gold mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    <h3 class="text-lg font-semibold text-gray-200 mb-2">Masuk untuk Investasi</h3>
                    <p class="text-sm text-gray-400 mb-4">Silakan masuk atau daftar untuk mulai berinvestasi</p>
                    <a href="{{ route('login') }}" class="block w-full px-4 py-2 bg-gradient-to-r from-gold to-gold-light text-dark-primary font-bold rounded-lg hover:from-gold-light hover:to-gold transition-all">Masuk</a>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>