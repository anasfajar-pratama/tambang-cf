<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-gray-300" />
            <x-text-input id="email" class="block mt-1 w-full bg-dark-primary border-gray-700 text-gray-200" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-gray-300" />
            <x-text-input id="password" class="block mt-1 w-full bg-dark-primary border-gray-700 text-gray-200" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-600 bg-dark-primary text-gold shadow-sm focus:ring-gold" name="remember">
                <span class="ms-2 text-sm text-gray-400">Ingat saya</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-400 hover:text-gold rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold" href="{{ route('password.request') }}">
                    Lupa password?
                </a>
            @endif

            <button type="submit" class="ms-3 px-4 py-2 bg-gradient-to-r from-gold to-gold-light text-dark-primary font-bold rounded-lg hover:from-gold-light hover:to-gold transition-all text-sm">Masuk</button>
        </div>

        <p class="text-center text-sm text-gray-400 mt-6">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-gold hover:text-gold-light font-medium">Daftar</a>
        </p>
    </form>
</x-guest-layout>
