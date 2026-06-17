<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-100">Hapus Akun</h2>
        <p class="mt-1 text-sm text-gray-400">Setelah akun Anda dihapus, semua data akan terhapus permanen. Sebelum menghapus, unduh data atau informasi yang ingin Anda simpan.</p>
    </header>

    <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')" class="px-4 py-2 bg-red-900/50 border border-red-700 text-red-400 rounded-lg hover:bg-red-900/70 transition-all text-sm font-medium">
        Hapus Akun
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 bg-dark-card">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-100">Apakah Anda yakin ingin menghapus akun?</h2>
            <p class="mt-1 text-sm text-gray-400">Setelah akun dihapus, semua data akan terhapus permanen. Masukkan password untuk konfirmasi.</p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only text-gray-300" />
                <x-text-input id="password" name="password" type="password" class="mt-1 block w-3/4 bg-dark-primary border-gray-700 text-gray-200" placeholder="{{ __('Password') }}" />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <button x-on:click="$dispatch('close')" type="button" class="px-4 py-2 border border-gray-600 text-gray-300 rounded-lg hover:border-gold hover:text-gold transition-all text-sm">Batal</button>
                <button type="submit" class="ms-3 px-4 py-2 bg-red-900/50 border border-red-700 text-red-400 rounded-lg hover:bg-red-900/70 transition-all text-sm font-medium">Hapus Akun</button>
            </div>
        </form>
    </x-modal>
</section>