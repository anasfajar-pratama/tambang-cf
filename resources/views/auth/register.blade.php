<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Name')" class="text-gray-300" />
            <x-text-input id="name" class="block mt-1 w-full bg-dark-primary border-gray-700 text-gray-200" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" class="text-gray-300" />
            <x-text-input id="email" class="block mt-1 w-full bg-dark-primary border-gray-700 text-gray-200" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-gray-300" />
            <x-text-input id="password" class="block mt-1 w-full bg-dark-primary border-gray-700 text-gray-200" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-300" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full bg-dark-primary border-gray-700 text-gray-200" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="role" :value="__('Register as')" class="text-gray-300" />
            <select id="role" name="role" class="block mt-1 w-full bg-dark-primary border-gray-700 text-gray-200 rounded-lg px-4 py-2.5 focus:border-gold focus:ring-gold/20">
                <option value="lender" {{ old('role') === 'lender' ? 'selected' : '' }}>Investor (Lender)</option>
                <option value="vendor" {{ old('role') === 'vendor' ? 'selected' : '' }}>Vendor (Pemilik Proyek)</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-400 hover:text-gold rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold" href="{{ route('login') }}">
                Sudah punya akun?
            </a>

            <button type="submit" class="ms-4 px-4 py-2 bg-gradient-to-r from-gold to-gold-light text-dark-primary font-bold rounded-lg hover:from-gold-light hover:to-gold transition-all text-sm">Daftar</button>
        </div>
    </form>
</x-guest-layout>
