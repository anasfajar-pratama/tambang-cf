@props(['project'])

<div class="bg-dark-card border border-gray-700 rounded-xl overflow-hidden hover:border-gold/50 transition-all duration-300 group">
    <div class="relative h-48 overflow-hidden">
        @if($project->cover_image)
            <img src="{{ asset('storage/' . $project->cover_image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
        @else
            <div class="w-full h-full bg-gradient-to-br from-dark-card to-gray-700 flex items-center justify-center">
                <svg class="w-12 h-12 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
            </div>
        @endif
        <div class="absolute top-3 right-3">
            <x-project-status-badge :status="$project->status" />
        </div>
        @if($project->investment_type)
            <div class="absolute top-3 left-3">
                <span class="px-2 py-1 bg-dark-primary/80 text-gold text-xs font-semibold rounded-lg border border-gold/30">
                    {{ $project->investment_type === 'single' ? 'Investor Tunggal' : 'Multi Investor' }}
                </span>
            </div>
        @endif
    </div>
    <div class="p-5">
        <h3 class="text-lg font-bold text-gray-100 mb-1 group-hover:text-gold transition-colors">{{ $project->title }}</h3>
        @if($project->tagline)
            <p class="text-sm text-gray-400 mb-3 line-clamp-2">{{ $project->tagline }}</p>
        @endif
        <div class="flex items-center space-x-3 text-xs text-gray-500 mb-4">
            @if($project->location)
                <span class="flex items-center"><svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>{{ $project->location }}</span>
            @endif
            @if($project->mining_type)
                <span class="flex items-center"><svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.963-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>{{ $project->mining_type }}</span>
            @endif
        </div>
        <div class="mb-3">
            <div class="flex justify-between text-sm mb-1">
                <span class="text-gray-400">Terkumpul</span>
                <span class="text-emerald font-semibold">Rp {{ number_format($project->collected_capital ?? 0, 0, ',', '.') }}</span>
            </div>
            <div class="w-full bg-gray-700 rounded-full h-2">
                <div class="bg-gradient-to-r from-gold to-emerald h-2 rounded-full transition-all duration-500" style="width: {{ $project->target_capital > 0 ? min(($project->collected_capital / $project->target_capital) * 100, 100) : 0 }}%"></div>
            </div>
            <div class="flex justify-between text-xs mt-1">
                <span class="text-gray-500">Target: Rp {{ number_format($project->target_capital ?? 0, 0, ',', '.') }}</span>
                <span class="text-gray-500">{{ $project->target_capital > 0 ? number_format(min(($project->collected_capital / $project->target_capital) * 100, 100), 1) : 0 }}%</span>
            </div>
        </div>
        <a href="{{ route('projects.show', $project) }}" class="block w-full text-center py-2.5 rounded-lg bg-gradient-to-r from-gold to-gold-light text-dark-primary text-sm font-bold hover:from-gold-light hover:to-gold transition-all">Lihat Detail</a>
    </div>
</div>