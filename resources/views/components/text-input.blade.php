@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-700 bg-dark-primary text-gray-200 focus:border-gold focus:ring-gold/20 rounded-lg shadow-sm']) }}>
