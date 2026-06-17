<x-admin-layout>
    <div class="max-w-2xl mx-auto space-y-6">
        <div>
            <h1 class="text-2xl font-bold text-white">Tambah Pengguna Baru</h1>
            <p class="text-gray-400 mt-1">Buat akun pengguna baru untuk platform</p>
        </div>

        <form method="POST" action="{{ route('admin.users.store') }}" class="bg-dark-card border border-gray-700 rounded-xl p-6 space-y-6">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-300 mb-1">Nama Lengkap</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-4 py-2.5 focus:border-gold focus:ring-gold/20" required>
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-4 py-2.5 focus:border-gold focus:ring-gold/20" required>
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>
            <div>
                <label for="role" class="block text-sm font-medium text-gray-300 mb-1">Role</label>
                <select id="role" name="role" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-4 py-2.5 focus:border-gold focus:ring-gold/20">
                    <option value="lender" {{ old('role') === 'lender' ? 'selected' : '' }}>Lender</option>
                    <option value="vendor" {{ old('role') === 'vendor' ? 'selected' : '' }}>Vendor</option>
                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('role')" />
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-300 mb-1">Password</label>
                <input type="password" id="password" name="password" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-4 py-2.5 focus:border-gold focus:ring-gold/20" required>
                <x-input-error class="mt-2" :messages="$errors->get('password')" />
            </div>
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-1">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-4 py-2.5 focus:border-gold focus:ring-gold/20" required>
            </div>

            <div class="flex items-center space-x-4">
                <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-gold to-gold-light text-dark-primary font-bold rounded-lg hover:from-gold-light hover:to-gold transition-all">Simpan</button>
                <a href="{{ route('admin.users.index') }}" class="px-6 py-2.5 border border-gray-600 text-gray-300 rounded-lg hover:border-gold hover:text-gold transition-all">Batal</a>
            </div>
        </form>
    </div>
</x-admin-layout>