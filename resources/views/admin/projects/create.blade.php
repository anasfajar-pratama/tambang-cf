<x-admin-layout>
    <div class="max-w-4xl mx-auto space-y-6">
        <div>
            <h1 class="text-2xl font-bold text-white">Buat Proyek Baru</h1>
            <p class="text-gray-400 mt-1">Tambahkan proyek pertambangan baru ke platform</p>
        </div>

        <form method="POST" action="{{ route('admin.projects.store') }}" enctype="multipart/form-data" class="bg-dark-card border border-gray-700 rounded-xl p-6 space-y-6">
            @csrf

            <div class="grid sm:grid-cols-2 gap-6">
                <div class="sm:col-span-2">
                    <label for="title" class="block text-sm font-medium text-gray-300 mb-1">Judul Proyek</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-4 py-2.5 focus:border-gold focus:ring-gold/20" required>
                    <x-input-error class="mt-2" :messages="$errors->get('title')" />
                </div>
                <div class="sm:col-span-2">
                    <label for="tagline" class="block text-sm font-medium text-gray-300 mb-1">Tagline</label>
                    <input type="text" id="tagline" name="tagline" value="{{ old('tagline') }}" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-4 py-2.5 focus:border-gold focus:ring-gold/20">
                    <x-input-error class="mt-2" :messages="$errors->get('tagline')" />
                </div>
                <div>
                    <label for="vendor_id" class="block text-sm font-medium text-gray-300 mb-1">Vendor</label>
                    <select id="vendor_id" name="vendor_id" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-4 py-2.5 focus:border-gold focus:ring-gold/20" required>
                        <option value="">Pilih Vendor</option>
                        @foreach($vendors as $vendor)
                            <option value="{{ $vendor->id }}" {{ old('vendor_id') == $vendor->id ? 'selected' : '' }}>{{ $vendor->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('vendor_id')" />
                </div>
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-300 mb-1">Status</label>
                    <select id="status" name="status" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-4 py-2.5 focus:border-gold focus:ring-gold/20">
                        <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="pending" {{ old('status') === 'pending' ? 'selected' : '' }}>Menunggu</option>
                        <option value="fundraising" {{ old('status') === 'fundraising' ? 'selected' : '' }}>Penggalangan Dana</option>
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('status')" />
                </div>
                <div>
                    <label for="location" class="block text-sm font-medium text-gray-300 mb-1">Lokasi</label>
                    <input type="text" id="location" name="location" value="{{ old('location') }}" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-4 py-2.5 focus:border-gold focus:ring-gold/20">
                    <x-input-error class="mt-2" :messages="$errors->get('location')" />
                </div>
                <div>
                    <label for="mining_type" class="block text-sm font-medium text-gray-300 mb-1">Tipe Tambang</label>
                    <select id="mining_type" name="mining_type" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-4 py-2.5 focus:border-gold focus:ring-gold/20">
                        <option value="">Pilih Tipe</option>
                        <option value="Batubara" {{ old('mining_type') === 'Batubara' ? 'selected' : '' }}>Batubara</option>
                        <option value="Emas" {{ old('mining_type') === 'Emas' ? 'selected' : '' }}>Emas</option>
                        <option value="Nikel" {{ old('mining_type') === 'Nikel' ? 'selected' : '' }}>Nikel</option>
                        <option value="Tembaga" {{ old('mining_type') === 'Tembaga' ? 'selected' : '' }}>Tembaga</option>
                        <option value="Timah" {{ old('mining_type') === 'Timah' ? 'selected' : '' }}>Timah</option>
                        <option value="Pasir" {{ old('mining_type') === 'Pasir' ? 'selected' : '' }}>Pasir</option>
                        <option value="Lainnya" {{ old('mining_type') === 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('mining_type')" />
                </div>
                <div>
                    <label for="investment_type" class="block text-sm font-medium text-gray-300 mb-1">Tipe Investasi</label>
                    <select id="investment_type" name="investment_type" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-4 py-2.5 focus:border-gold focus:ring-gold/20">
                        <option value="equity" {{ old('investment_type') === 'equity' ? 'selected' : '' }}>Ekuitas</option>
                        <option value="debt" {{ old('investment_type') === 'debt' ? 'selected' : '' }}>Pendanaan</option>
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('investment_type')" />
                </div>
                <div>
                    <label for="land_area" class="block text-sm font-medium text-gray-300 mb-1">Luas Lahan</label>
                    <input type="text" id="land_area" name="land_area" value="{{ old('land_area') }}" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-4 py-2.5 focus:border-gold focus:ring-gold/20">
                    <x-input-error class="mt-2" :messages="$errors->get('land_area')" />
                </div>
                <div>
                    <label for="permit_status" class="block text-sm font-medium text-gray-300 mb-1">Status Izin</label>
                    <input type="text" id="permit_status" name="permit_status" value="{{ old('permit_status') }}" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-4 py-2.5 focus:border-gold focus:ring-gold/20">
                    <x-input-error class="mt-2" :messages="$errors->get('permit_status')" />
                </div>
                <div>
                    <label for="risk_level" class="block text-sm font-medium text-gray-300 mb-1">Tingkat Risiko</label>
                    <select id="risk_level" name="risk_level" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-4 py-2.5 focus:border-gold focus:ring-gold/20">
                        <option value="Rendah" {{ old('risk_level') === 'Rendah' ? 'selected' : '' }}>Rendah</option>
                        <option value="Sedang" {{ old('risk_level') === 'Sedang' ? 'selected' : '' }}>Sedang</option>
                        <option value="Tinggi" {{ old('risk_level') === 'Tinggi' ? 'selected' : '' }}>Tinggi</option>
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('risk_level')" />
                </div>
                <div>
                    <label for="duration" class="block text-sm font-medium text-gray-300 mb-1">Durasi Proyek</label>
                    <input type="text" id="duration" name="duration" value="{{ old('duration') }}" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-4 py-2.5 focus:border-gold focus:ring-gold/20">
                    <x-input-error class="mt-2" :messages="$errors->get('duration')" />
                </div>
                <div>
                    <label for="days_remaining" class="block text-sm font-medium text-gray-300 mb-1">Sisa Hari</label>
                    <input type="number" id="days_remaining" name="days_remaining" value="{{ old('days_remaining') }}" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-4 py-2.5 focus:border-gold focus:ring-gold/20">
                    <x-input-error class="mt-2" :messages="$errors->get('days_remaining')" />
                </div>
                <div>
                    <label for="target_capital" class="block text-sm font-medium text-gray-300 mb-1">Target Pendanaan (Rp)</label>
                    <input type="number" id="target_capital" name="target_capital" value="{{ old('target_capital') }}" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-4 py-2.5 focus:border-gold focus:ring-gold/20">
                    <x-input-error class="mt-2" :messages="$errors->get('target_capital')" />
                </div>
                <div>
                    <label for="min_investment" class="block text-sm font-medium text-gray-300 mb-1">Min. Investasi (Rp)</label>
                    <input type="number" id="min_investment" name="min_investment" value="{{ old('min_investment', 100000) }}" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-4 py-2.5 focus:border-gold focus:ring-gold/20">
                    <x-input-error class="mt-2" :messages="$errors->get('min_investment')" />
                </div>
                <div>
                    <label for="profit_sharing_vendor" class="block text-sm font-medium text-gray-300 mb-1">Bagi Hasil Vendor (%)</label>
                    <input type="number" id="profit_sharing_vendor" name="profit_sharing_vendor" value="{{ old('profit_sharing_vendor') }}" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-4 py-2.5 focus:border-gold focus:ring-gold/20" step="0.01">
                    <x-input-error class="mt-2" :messages="$errors->get('profit_sharing_vendor')" />
                </div>
                <div>
                    <label for="profit_sharing_investor" class="block text-sm font-medium text-gray-300 mb-1">Bagi Hasil Investor (%)</label>
                    <input type="number" id="profit_sharing_investor" name="profit_sharing_investor" value="{{ old('profit_sharing_investor') }}" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-4 py-2.5 focus:border-gold focus:ring-gold/20" step="0.01">
                    <x-input-error class="mt-2" :messages="$errors->get('profit_sharing_investor')" />
                </div>
                <div>
                    <label for="profit_sharing_platform" class="block text-sm font-medium text-gray-300 mb-1">Bagi Hasil Platform (%)</label>
                    <input type="number" id="profit_sharing_platform" name="profit_sharing_platform" value="{{ old('profit_sharing_platform') }}" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-4 py-2.5 focus:border-gold focus:ring-gold/20" step="0.01">
                    <x-input-error class="mt-2" :messages="$errors->get('profit_sharing_platform')" />
                </div>
                <div class="sm:col-span-2">
                    <label for="cover_image" class="block text-sm font-medium text-gray-300 mb-1">Cover Image</label>
                    <input type="file" id="cover_image" name="cover_image" accept="image/*" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-4 py-2.5 focus:border-gold focus:ring-gold/20 file:mr-4 file:py-1.5 file:px-3 file:rounded file:border-0 file:bg-gold/20 file:text-gold file:text-sm">
                    <x-input-error class="mt-2" :messages="$errors->get('cover_image')" />
                </div>
                <div class="sm:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-300 mb-1">Deskripsi Proyek</label>
                    <textarea id="description" name="description" rows="10" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-4 py-2.5 focus:border-gold focus:ring-gold/20">{{ old('description') }}</textarea>
                    <x-input-error class="mt-2" :messages="$errors->get('description')" />
                </div>
            </div>

            <div class="flex items-center space-x-4">
                <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-gold to-gold-light text-dark-primary font-bold rounded-lg hover:from-gold-light hover:to-gold transition-all">Simpan Proyek</button>
                <a href="{{ route('admin.projects.index') }}" class="px-6 py-2.5 border border-gray-600 text-gray-300 rounded-lg hover:border-gold hover:text-gold transition-all">Batal</a>
            </div>
        </form>
    </div>
</x-admin-layout>