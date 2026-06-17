<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Mining Crowdfunding</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-100 antialiased bg-dark-primary">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div class="mb-6">
                <a href="{{ url('/') }}" class="flex items-center space-x-2">
                    <div class="w-10 h-10 bg-gradient-to-br from-gold to-gold-light rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-dark-primary" fill="currentColor" viewBox="0 0 20 20"><path d="M10 0C4.48 0 0 4.48 0 10s4.48 10 10 10 10-4.48 10-10S15.52 0 10 0zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm1-13H9v6h2V5zm0 8H9v2h2v-2z"/></svg>
                    </div>
                    <span class="text-xl font-bold text-gold">TambangCrowd</span>
                </a>
            </div>

            <div class="w-full sm:max-w-md px-6 py-6 bg-dark-card border border-gray-700 shadow-md overflow-hidden sm:rounded-xl">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
