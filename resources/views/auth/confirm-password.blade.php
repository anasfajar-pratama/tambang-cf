<x-guest-layout>
    <div class="mb-4 text-sm text-gray-400">
        Ini adalah area aman. Harap konfirmasi password Anda sebelum melanjutkan.
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div>
            <x-input-label for="password" :value="__('Password')" class="text-gray-300" />
            <x-text-input id="password" class="block mt-1 w-full bg-dark-primary border-gray-700 text-gray-200" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            <button type="submit" class="px-4 py-2 bg-gradient-to-r from-gold to-gold-light text-dark-primary font-bold rounded-lg hover:from-gold-light hover:to-gold transition-all text-sm">Konfirmasi</button>
        </div>
    </form>
</x-guest-layout>
