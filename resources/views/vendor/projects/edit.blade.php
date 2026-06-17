<x-vendor-layout>
    <div class="max-w-4xl mx-auto">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-white">Edit Proyek</h1>
            <p class="text-gray-400 mt-1">Perbarui proyek {{ $project->title }}</p>
        </div>

        <form method="POST" action="{{ route('vendor.projects.update', $project) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf @method('PUT')

            <div class="bg-dark-card border border-gray-700 rounded-xl p-6 space-y-6">
                <h2 class="text-lg font-bold text-white">Informasi Dasar</h2>
                <div class="grid sm:grid-cols-2 gap-4">
                    <div class="sm:col-span-2">
                        <label for="title" class="block text-sm font-medium text-gray-300 mb-1">Judul Proyek</label>
                        <input type="text" id="title" name="title" value="{{ old('title', $project->title) }}" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-4 py-2.5 focus:border-gold focus:ring-gold/20" required>
                        <x-input-error class="mt-2" :messages="$errors->get('title')" />
                    </div>
                    <div class="sm:col-span-2">
                        <label for="tagline" class="block text-sm font-medium text-gray-300 mb-1">Tagline</label>
                        <input type="text" id="tagline" name="tagline" value="{{ old('tagline', $project->tagline) }}" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-4 py-2.5 focus:border-gold focus:ring-gold/20">
                        <x-input-error class="mt-2" :messages="$errors->get('tagline')" />
                    </div>
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-300 mb-1">Lokasi</label>
                        <input type="text" id="location" name="location" value="{{ old('location', $project->location) }}" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-4 py-2.5 focus:border-gold focus:ring-gold/20">
                        <x-input-error class="mt-2" :messages="$errors->get('location')" />
                    </div>
                    <div>
                        <label for="mining_type" class="block text-sm font-medium text-gray-300 mb-1">Tipe Tambang</label>
                        <select id="mining_type" name="mining_type" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-4 py-2.5 focus:border-gold focus:ring-gold/20">
                            <option value="">Pilih</option>
                            <option value="Batubara" {{ old('mining_type', $project->mining_type) === 'Batubara' ? 'selected' : '' }}>Batubara</option>
                            <option value="Emas" {{ old('mining_type', $project->mining_type) === 'Emas' ? 'selected' : '' }}>Emas</option>
                            <option value="Nikel" {{ old('mining_type', $project->mining_type) === 'Nikel' ? 'selected' : '' }}>Nikel</option>
                            <option value="Tembaga" {{ old('mining_type', $project->mining_type) === 'Tembaga' ? 'selected' : '' }}>Tembaga</option>
                            <option value="Lainnya" {{ old('mining_type', $project->mining_type) === 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('mining_type')" />
                    </div>
                    <div>
                        <label for="land_area" class="block text-sm font-medium text-gray-300 mb-1">Luas Lahan</label>
                        <input type="text" id="land_area" name="land_area" value="{{ old('land_area', $project->land_area) }}" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-4 py-2.5 focus:border-gold focus:ring-gold/20">
                        <x-input-error class="mt-2" :messages="$errors->get('land_area')" />
                    </div>
                    <div>
                        <label for="duration" class="block text-sm font-medium text-gray-300 mb-1">Durasi Proyek</label>
                        <input type="text" id="duration" name="duration" value="{{ old('duration', $project->duration) }}" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-4 py-2.5 focus:border-gold focus:ring-gold/20">
                        <x-input-error class="mt-2" :messages="$errors->get('duration')" />
                    </div>
                </div>
            </div>

            <div class="bg-dark-card border border-gray-700 rounded-xl p-6 space-y-6">
                <h2 class="text-lg font-bold text-white">Pendanaan</h2>
                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label for="target_capital" class="block text-sm font-medium text-gray-300 mb-1">Target Pendanaan (Rp)</label>
                        <input type="number" id="target_capital" name="target_capital" value="{{ old('target_capital', $project->target_capital) }}" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-4 py-2.5 focus:border-gold focus:ring-gold/20">
                        <x-input-error class="mt-2" :messages="$errors->get('target_capital')" />
                    </div>
                    <div>
                        <label for="min_investment" class="block text-sm font-medium text-gray-300 mb-1">Min. Investasi (Rp)</label>
                        <input type="number" id="min_investment" name="min_investment" value="{{ old('min_investment', $project->min_investment) }}" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-4 py-2.5 focus:border-gold focus:ring-gold/20">
                        <x-input-error class="mt-2" :messages="$errors->get('min_investment')" />
                    </div>
                </div>
            </div>

            <div class="bg-dark-card border border-gray-700 rounded-xl p-6 space-y-6">
                <h2 class="text-lg font-bold text-white">Konten</h2>
                @if($project->cover_image)
                <div>
                    <p class="text-sm text-gray-400 mb-2">Cover Saat Ini</p>
                    <img src="{{ asset('storage/' . $project->cover_image) }}" class="h-32 rounded-lg object-cover mb-3">
                </div>
                @endif
                <div>
                    <label for="cover_image" class="block text-sm font-medium text-gray-300 mb-1">Ganti Cover Image</label>
                    <input type="file" id="cover_image" name="cover_image" accept="image/*" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-4 py-2.5 focus:border-gold focus:ring-gold/20 file:mr-4 file:py-1.5 file:px-3 file:rounded file:border-0 file:bg-gold/20 file:text-gold file:text-sm">
                    <x-input-error class="mt-2" :messages="$errors->get('cover_image')" />
                </div>
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-300 mb-1">Deskripsi Proyek</label>
                    <textarea id="description" name="description" rows="10" class="w-full bg-dark-primary border border-gray-700 text-gray-200 rounded-lg px-4 py-2.5 focus:border-gold focus:ring-gold/20">{{ old('description', $project->description) }}</textarea>
                    <x-input-error class="mt-2" :messages="$errors->get('description')" />
                </div>
            </div>

            {{-- Milestones with existing --}}
            <div class="bg-dark-card border border-gray-700 rounded-xl p-6" x-data="{ milestones: {{ json_encode($project->milestones->map(function($m) { return ['title' => $m->title, 'date' => $m->date ? \Carbon\Carbon::parse($m->date)->format('Y-m-d') : ''] })->toArray()) }} }">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-bold text-white">Pencapaian (Milestones)</h2>
                    <button type="button" @click="milestones.push({title: '', date: ''})" class="px-3 py-1.5 bg-gold/20 text-gold text-sm rounded-lg border border-gold/30 hover:bg-gold/30 transition-all">+ Tambah</button>
                </div>
                <template x-for="(milestone, index) in milestones" :key="index">
                    <div class="flex items-start space-x-3 mb-3 p-3 bg-dark-primary rounded-lg">
                        <input type="text" x-model="milestone.title" :name="'milestones['+index+'][title]'" placeholder="Judul milestone" class="flex-1 bg-dark-card border border-gray-700 text-gray-200 rounded px-3 py-1.5 text-sm focus:border-gold focus:ring-gold/20">
                        <input type="date" x-model="milestone.date" :name="'milestones['+index+'][date]'" class="bg-dark-card border border-gray-700 text-gray-200 rounded px-3 py-1.5 text-sm focus:border-gold focus:ring-gold/20">
                        <button type="button" @click="milestones.splice(index, 1)" class="p-1.5 text-red-400 hover:text-red-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                </template>
            </div>

            {{-- FAQs with existing --}}
            <div class="bg-dark-card border border-gray-700 rounded-xl p-6" x-data="{ faqs: {{ json_encode($project->faqs->map(function($f) { return ['question' => $f->question, 'answer' => $f->answer]; })->toArray()) }} }">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-bold text-white">FAQ</h2>
                    <button type="button" @click="faqs.push({question: '', answer: ''})" class="px-3 py-1.5 bg-gold/20 text-gold text-sm rounded-lg border border-gold/30 hover:bg-gold/30 transition-all">+ Tambah</button>
                </div>
                <template x-for="(faq, index) in faqs" :key="index">
                    <div class="space-y-2 mb-3 p-3 bg-dark-primary rounded-lg">
                        <div class="flex items-start space-x-3">
                            <div class="flex-1 space-y-2">
                                <input type="text" x-model="faq.question" :name="'faqs['+index+'][question]'" placeholder="Pertanyaan" class="w-full bg-dark-card border border-gray-700 text-gray-200 rounded px-3 py-1.5 text-sm focus:border-gold focus:ring-gold/20">
                                <textarea x-model="faq.answer" :name="'faqs['+index+'][answer]'" placeholder="Jawaban" rows="2" class="w-full bg-dark-card border border-gray-700 text-gray-200 rounded px-3 py-1.5 text-sm focus:border-gold focus:ring-gold/20"></textarea>
                            </div>
                            <button type="button" @click="faqs.splice(index, 1)" class="p-1.5 text-red-400 hover:text-red-300">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>
                    </div>
                </template>
            </div>

            <div class="flex items-center space-x-4">
                <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-gold to-gold-light text-dark-primary font-bold rounded-lg hover:from-gold-light hover:to-gold transition-all">Update Proyek</button>
                <a href="{{ route('vendor.projects.index') }}" class="px-6 py-2.5 border border-gray-600 text-gray-300 rounded-lg hover:border-gold hover:text-gold transition-all">Batal</a>
            </div>
        </form>
    </div>
</x-vendor-layout>