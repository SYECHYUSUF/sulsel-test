<x-admin-layout title="Edit Berita - Admin PPID">
    <x-slot name="extra_head">
        <link href="/vendor/filepond/index.css" rel="stylesheet" />
        <link
            href="/vendor/filepond/image-preview.css"
            rel="stylesheet"
        />
        <script src="/vendor/filepond/image-preview.js"></script>
        <script src="/vendor/filepond/index.js"></script>
    </x-slot>

    <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden max-w-4xl mx-auto">
        <div class="p-6 border-b border-slate-100">
            <h3 class="text-lg font-bold text-[#1A305E]">Form Edit Berita</h3>
        </div>

        <form action="{{ route('admin.berita.update', $berita->id_berita) }}" method="POST"
            enctype="multipart/form-data" class="p-6 pt-0 space-y-6">
            @csrf
            @method('PUT')

            <!-- Judul -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Judul Berita</label>
                <input type="text" name="judul" value="{{ old('judul', $berita->judul) }}"
                    class="w-full px-4 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-ppid-accent focus:ring-1 focus:ring-ppid-accent"
                    placeholder="Masukkan judul berita" required>
                @error('judul')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="id_skpd" class="text-sm font-medium text-slate-700">SKPD Terkait</label>
                
                <x-searchable-select 
                    name="id_skpd" 
                    id="id_skpd" 
                    :options="$skpdList" 
                    idKey="id_skpd"
                    :disabled="auth()->user()->hasRole('opd')"
                    labelKey="nm_skpd"
                    :value="old('id_skpd', auth()->user()->id_skpd)"
                    placeholder="-- Pilih SKPD --"
                />

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

            <!-- Gambar -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Gambar Sampul</label>
                <div class="flex-1">                        
                    <input type="file" 
                        class="filepond"
                        name="img_berita"
                        id="gambar"
                        accept="image/png, image/jpeg, image/gif"
                    />
                    @error('img_berita')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <!-- Deskripsi (WYSIWYG) -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Konten Berita</label>

                <textarea name="deskripsi" id="editor" class="editor" rows="10">{{ old('deskripsi', $berita->deskripsi) }}</textarea>
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
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    <!-- Vendor -->
    <x-slot name="extra_script">
        <script src="/vendor/jquery/jquery.min.js"></script>
        <script src="/vendor/tinymce/tinymce.min.js"></script>
        <script src="/vendor/tinymce/init-editor.js"></script>
        <script>
            FilePond.registerPlugin(FilePondPluginImagePreview);
            FilePond.registerPlugin(
                FilePondPluginImagePreview,
            );
            // Select the file input and use 
            // create() to turn it into a pond
            FilePond.create(
                document.querySelector('#gambar'),
                {
                    labelIdle: `Drag & Drop your picture or <span class="filepond--label-action">Browse</span>`,
                    imagePreviewHeight: 170,
                    storeAsFile: true,
                    // Menambahkan file yang sudah ada
                    files: [
                        @if($berita->img_berita)
                        {
                            source: "{{ asset('storage/img_berita/' . $berita->img_berita) }}",
                            options: {
                                type: 'local', // Menandakan file sudah ada di server
                            }
                        }
                        @endif
                    ],
                    server: {
                        // FilePond membutuhkan endpoint 'load' untuk mengambil gambar dari URL 'local'
                        load: (source, load, error, progress, abort, headers) => {
                            fetch(source)
                                .then(response => response.blob())
                                .then(load)
                                .catch(error);
                        }
                    }
                }
            );  
        </script>
    </x-slot>
</x-admin-layout>