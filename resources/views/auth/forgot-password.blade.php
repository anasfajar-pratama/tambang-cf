<x-guest-layout>
    <div class="mb-4 text-sm text-gray-400">
        Lupa password? Tidak masalah. Beri tahu kami email Anda dan kami akan kirimkan tautan reset password.
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-gray-300" />
            <x-text-input id="email" class="block mt-1 w-full bg-dark-primary border-gray-700 text-gray-200" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <button type="submit" class="px-4 py-2 bg-gradient-to-r from-gold to-gold-light text-dark-primary font-bold rounded-lg hover:from-gold-light hover:to-gold transition-all text-sm">Kirim Tautan Reset</button>
        </div>
    </form>
</x-guest-layout>
