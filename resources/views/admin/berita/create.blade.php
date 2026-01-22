<x-admin-layout title="Tambah Berita - Admin PPID">
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.berita.index') }}" class="text-slate-500 hover:text-slate-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <span class="text-slate-300">/</span>
            <span>Tambah Berita</span>
        </div>
    </x-slot>

    <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden max-w-4xl mx-auto">
        <div class="p-6 border-b border-slate-100">
            <h3 class="text-lg font-bold text-[#1A305E]">Form Tambah Berita</h3>
        </div>

        <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data"
            class="p-6 space-y-6">
            @csrf

            <!-- Judul -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Judul Berita</label>
                <input type="text" name="judul" value="{{ old('judul') }}"
                    class="w-full px-4 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-ppid-accent focus:ring-1 focus:ring-ppid-accent"
                    placeholder="Masukkan judul berita" required>
                @error('judul')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- SKPD & Status -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">SKPD</label>
                    <select name="id_skpd"
                        class="w-full px-4 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-ppid-accent focus:ring-1 focus:ring-ppid-accent"
                        required>
                        <option value="">Pilih SKPD</option>
                        @foreach($skpdList as $skpd)
                            <option value="{{ $skpd->id_skpd }}" {{ old('id_skpd') == $skpd->id_skpd ? 'selected' : '' }}>
                                {{ $skpd->nm_skpd }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_skpd')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Status Verifikasi</label>
                    <select name="verify"
                        class="w-full px-4 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-ppid-accent focus:ring-1 focus:ring-ppid-accent"
                        required>
                        <option value="n" {{ old('verify') == 'n' ? 'selected' : '' }}>Belum Verifikasi</option>
                        <option value="y" {{ old('verify') == 'y' ? 'selected' : '' }}>Terverifikasi</option>
                        <option value="t" {{ old('verify') == 't' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                    @error('verify')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Gambar -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Gambar Sampul</label>
                <div class="flex items-start gap-4">
                    <div class="flex-1">
                        <input type="file" name="img_berita" accept="image/*"
                            class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200"
                            onchange="previewImage(this)" required>
                        <p class="text-xs text-slate-400 mt-1">Format: JPG, PNG, GIF. Maks: 2MB.</p>
                        @error('img_berita')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div id="imagePreview"
                        class="w-32 h-20 bg-slate-100 rounded-lg overflow-hidden hidden border border-slate-200">
                        <img src="" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>

            <!-- Deskripsi (WYSIWYG) -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Konten Berita</label>
                <textarea name="deskripsi" id="editor" rows="10">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-6 border-t border-slate-100 flex justify-end gap-3">
                <a href="{{ route('admin.berita.index') }}"
                    class="px-4 py-2 bg-white border border-slate-200 text-slate-700 rounded-lg text-sm font-medium hover:bg-slate-50 transition-colors">
                    Batal
                </a>
                <button type="submit"
                    class="px-4 py-2 bg-[#1A305E] text-white rounded-lg text-sm font-medium hover:bg-ppid-dark transition-colors">
                    Simpan Berita
                </button>
            </div>
        </form>
    </div>

    @push('scripts')
        <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
        <script>
            ClassicEditor
                .create(document.querySelector('#editor'))
                .catch(error => {
                    console.error(error);
                });

            function previewImage(input) {
                const preview = document.getElementById('imagePreview');
                const img = preview.querySelector('img');

                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        img.src = e.target.result;
                        preview.classList.remove('hidden');
                    }
                    reader.readAsDataURL(input.files[0]);
                } else {
                    img.src = '';
                    preview.classList.add('hidden');
                }
            }
        </script>
    @endpush

    @push('styles')
        <style>
            .ck-editor__editable_inline {
                min-height: 400px;
            }
        </style>
    @endpush
</x-admin-layout>