@props(['status'])

@php
$classes = match ($status) {
    'draft' => 'bg-gray-700 text-gray-300 border-gray-600',
    'pending' => 'bg-yellow-900/50 text-yellow-400 border-yellow-600/50',
    'fundraising' => 'bg-emerald-900/50 text-emerald border-emerald-600/50',
    'funded' => 'bg-blue-900/50 text-blue-400 border-blue-600/50',
    'active' => 'bg-gold/20 text-gold border-gold/50',
    'completed' => 'bg-green-900/50 text-green-400 border-green-600/50',
    'cancelled' => 'bg-red-900/50 text-red-400 border-red-600/50',
    default => 'bg-gray-700 text-gray-300 border-gray-600',
};

$labels = match ($status) {
    'draft' => 'Draft',
    'pending' => 'Menunggu',
    'fundraising' => 'Penggalangan Dana',
    'funded' => 'Terdanai',
    'active' => 'Berjalan',
    'completed' => 'Selesai',
    'cancelled' => 'Dibatalkan',
    default => $status,
};
@endphp

<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold border {{ $classes }}">
    {{ $labels }}
</span>