<x-admin-layout>
    <div class="max-w-4xl mx-auto space-y-6">
        <div>
            <h1 class="text-2xl font-bold text-white">Buat Proyek Baru</h1>
            <p class="text-gray-400 mt-1">Tambahkan proyek pertambangan baru ke platform</p>
        </div>

        <form method="POST" action="{{ route('admin.projects.store') }}" enctype="multipart/form-data" class="bg-dark-card border border-gray-700 rounded-xl p-6 space-y-6" x-data="{ milestones: [], faqs: [], galleries: [], documents: [] }">
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
                        <option value="in_progress" {{ old('status') === 'in_progress' ? 'selected' : '' }}>Berjalan</option>
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
                        <option value="single" {{ old('investment_type') === 'single' ? 'selected' : '' }}>Investor Tunggal</option>
                        <option value="multi" {{ old('investment_type') === 'multi' ? 'selected' : '' }}>Multi Investor</option>
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('investment_type')" />
                </div>
                <div>
                    <label for="luas_lahan" class="block text-sm font-medium text-gray-300 mb-1">Luas Lahan</label>
                    <input type="text" id="luas_lahan" name="luas_lahan" value="{{ old('luas_lahan') }}" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-4 py-2.5 focus:border-gold focus:ring-gold/20">
                    <x-input-error class="mt-2" :messages="$errors->get('luas_lahan')" />
                </div>
                <div>
                    <label for="permit_status" class="block text-sm font-medium text-gray-300 mb-1">Status Izin</label>
                    <input type="text" id="permit_status" name="permit_status" value="{{ old('permit_status') }}" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-4 py-2.5 focus:border-gold focus:ring-gold/20">
                    <x-input-error class="mt-2" :messages="$errors->get('permit_status')" />
                </div>
                <div>
                    <label for="risk_level" class="block text-sm font-medium text-gray-300 mb-1">Tingkat Risiko</label>
                    <select id="risk_level" name="risk_level" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-4 py-2.5 focus:border-gold focus:ring-gold/20">
                        <option value="rendah" {{ old('risk_level') === 'rendah' ? 'selected' : '' }}>Rendah</option>
                        <option value="sedang" {{ old('risk_level') === 'sedang' ? 'selected' : '' }}>Sedang</option>
                        <option value="tinggi" {{ old('risk_level') === 'tinggi' ? 'selected' : '' }}>Tinggi</option>
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('risk_level')" />
                </div>
                <div>
                    <label for="duration_months" class="block text-sm font-medium text-gray-300 mb-1">Durasi Proyek (Bulan)</label>
                    <input type="number" id="duration_months" name="duration_months" value="{{ old('duration_months') }}" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-4 py-2.5 focus:border-gold focus:ring-gold/20">
                    <x-input-error class="mt-2" :messages="$errors->get('duration_months')" />
                </div>
                <div>
                    <label for="total_capital" class="block text-sm font-medium text-gray-300 mb-1">Total Modal (Rp)</label>
                    <input type="number" id="total_capital" name="total_capital" value="{{ old('total_capital') }}" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-4 py-2.5 focus:border-gold focus:ring-gold/20">
                    <x-input-error class="mt-2" :messages="$errors->get('total_capital')" />
                </div>
                <div>
                    <label for="min_investment" class="block text-sm font-medium text-gray-300 mb-1">Min. Investasi (Rp)</label>
                    <input type="number" id="min_investment" name="min_investment" value="{{ old('min_investment', 100000) }}" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-4 py-2.5 focus:border-gold focus:ring-gold/20">
                    <x-input-error class="mt-2" :messages="$errors->get('min_investment')" />
                </div>
                <div>
                    <label for="investor_share" class="block text-sm font-medium text-gray-300 mb-1">Bagi Hasil Investor (%)</label>
                    <input type="number" id="investor_share" name="investor_share" value="{{ old('investor_share') }}" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-4 py-2.5 focus:border-gold focus:ring-gold/20" step="0.01">
                    <x-input-error class="mt-2" :messages="$errors->get('investor_share')" />
                </div>
                <div>
                    <label for="vendor_share" class="block text-sm font-medium text-gray-300 mb-1">Bagi Hasil Vendor (%)</label>
                    <input type="number" id="vendor_share" name="vendor_share" value="{{ old('vendor_share') }}" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-4 py-2.5 focus:border-gold focus:ring-gold/20" step="0.01">
                    <x-input-error class="mt-2" :messages="$errors->get('vendor_share')" />
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

            <hr class="border-gray-700">

            <div>
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-bold text-white">Galeri</h2>
                    <button type="button" @click="galleries.push({})" class="text-sm text-gold hover:text-gold-light transition-colors">+ Tambah Gambar</button>
                </div>
                <template x-for="(g, i) in galleries" :key="i">
                    <div class="flex items-start space-x-3 mb-3 p-3 bg-dark-primary rounded-lg">
                        <div class="flex-1">
                            <input type="file" :name="'galleries['+i+']'" accept="image/*" class="w-full text-sm text-gray-300 file:mr-4 file:py-1.5 file:px-3 file:rounded file:border-0 file:bg-gold/20 file:text-gold file:text-sm">
                            <input type="text" :name="'galleries_caption['+i+']'" placeholder="Caption" class="w-full mt-2 bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-3 py-1.5 text-sm focus:border-gold focus:ring-gold/20">
                        </div>
                        <button type="button" @click="galleries.splice(i, 1)" class="p-1 text-red-400 hover:text-red-300 transition-colors flex-shrink-0 mt-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </div>
                </template>
                <p class="text-xs text-gray-500" x-show="galleries.length === 0">Belum ada gambar. Klik "Tambah Gambar" untuk menambahkan.</p>
            </div>

            <hr class="border-gray-700">

            <div>
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-bold text-white">Pencapaian</h2>
                    <button type="button" @click="milestones.push({ phase_name: '', description: '', target_date: '', is_completed: false })" class="text-sm text-gold hover:text-gold-light transition-colors">+ Tambah Pencapaian</button>
                </div>
                <template x-for="(m, i) in milestones" :key="i">
                    <div class="flex items-start space-x-3 mb-3 p-3 bg-dark-primary rounded-lg">
                        <div class="flex-1 grid sm:grid-cols-2 gap-3">
                            <input type="text" x-model="m.phase_name" :name="'milestones['+i+'][phase_name]'" placeholder="Nama Tahap" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-3 py-1.5 text-sm focus:border-gold focus:ring-gold/20" required>
                            <input type="date" x-model="m.target_date" :name="'milestones['+i+'][target_date]'" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-3 py-1.5 text-sm focus:border-gold focus:ring-gold/20">
                            <div class="sm:col-span-2">
                                <textarea x-model="m.description" :name="'milestones['+i+'][description]'" placeholder="Deskripsi" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-3 py-1.5 text-sm focus:border-gold focus:ring-gold/20"></textarea>
                            </div>
                            <label class="flex items-center space-x-2 text-sm text-gray-400">
                                <input type="checkbox" x-model="m.is_completed" :name="'milestones['+i+'][is_completed]'" value="1" class="rounded border-gray-600 bg-dark-primary text-gold focus:ring-gold/20">
                                <span>Selesai</span>
                            </label>
                        </div>
                        <button type="button" @click="milestones.splice(i, 1)" class="p-1 text-red-400 hover:text-red-300 transition-colors flex-shrink-0 mt-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </div>
                </template>
                <p class="text-xs text-gray-500" x-show="milestones.length === 0">Belum ada pencapaian. Klik "Tambah Pencapaian" untuk menambahkan.</p>
            </div>

            <hr class="border-gray-700">

            <div>
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-bold text-white">Dokumen</h2>
                    <button type="button" @click="documents.push({})" class="text-sm text-gold hover:text-gold-light transition-colors">+ Tambah Dokumen</button>
                </div>
                <template x-for="(d, i) in documents" :key="i">
                    <div class="flex items-start space-x-3 mb-3 p-3 bg-dark-primary rounded-lg">
                        <div class="flex-1 grid sm:grid-cols-3 gap-3">
                            <input type="text" :name="'document_names['+i+']'" placeholder="Nama Dokumen" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-3 py-1.5 text-sm focus:border-gold focus:ring-gold/20" required>
                            <select :name="'document_types['+i+']'" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-3 py-1.5 text-sm focus:border-gold focus:ring-gold/20">
                                <option value="other">Lainnya</option>
                                <option value="iup">IUP</option>
                                <option value="amdal">AMDAL</option>
                                <option value="fs">Feasibility Study</option>
                                <option value="contract">Kontrak</option>
                            </select>
                            <input type="file" :name="'documents['+i+']'" accept=".pdf,.doc,.docx" class="w-full text-sm text-gray-300 file:mr-4 file:py-1.5 file:px-3 file:rounded file:border-0 file:bg-gold/20 file:text-gold file:text-sm">
                        </div>
                        <button type="button" @click="documents.splice(i, 1)" class="p-1 text-red-400 hover:text-red-300 transition-colors flex-shrink-0 mt-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </div>
                </template>
                <p class="text-xs text-gray-500" x-show="documents.length === 0">Belum ada dokumen. Klik "Tambah Dokumen" untuk menambahkan.</p>
            </div>

            <hr class="border-gray-700">

            <div>
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-bold text-white">FAQ</h2>
                    <button type="button" @click="faqs.push({ question: '', answer: '' })" class="text-sm text-gold hover:text-gold-light transition-colors">+ Tambah FAQ</button>
                </div>
                <template x-for="(f, i) in faqs" :key="i">
                    <div class="flex items-start space-x-3 mb-3 p-3 bg-dark-primary rounded-lg">
                        <div class="flex-1 space-y-2">
                            <input type="text" x-model="f.question" :name="'faqs['+i+'][question]'" placeholder="Pertanyaan" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-3 py-1.5 text-sm focus:border-gold focus:ring-gold/20" required>
                            <textarea x-model="f.answer" :name="'faqs['+i+'][answer]'" placeholder="Jawaban" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-3 py-1.5 text-sm focus:border-gold focus:ring-gold/20"></textarea>
                        </div>
                        <button type="button" @click="faqs.splice(i, 1)" class="p-1 text-red-400 hover:text-red-300 transition-colors flex-shrink-0 mt-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </div>
                </template>
                <p class="text-xs text-gray-500" x-show="faqs.length === 0">Belum ada FAQ. Klik "Tambah FAQ" untuk menambahkan.</p>
            </div>

            <div class="flex items-center space-x-4">
                <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-gold to-gold-light text-dark-primary font-bold rounded-lg hover:from-gold-light hover:to-gold transition-all">Simpan Proyek</button>
                <a href="{{ route('admin.projects.index') }}" class="px-6 py-2.5 border border-gray-600 text-gray-300 rounded-lg hover:border-gold hover:text-gold transition-all">Batal</a>
            </div>
        </form>
    </div>
</x-admin-layout>