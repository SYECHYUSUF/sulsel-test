<x-admin-layout title="Edit Informasi - Admin PPID">
    <x-slot name="extra_head">
        <link href="/vendor/filepond/index.css" rel="stylesheet" />
        <link href="/vendor/filepond/image-preview.css" rel="stylesheet" />
        <script src="/vendor/filepond/image-preview.js"></script>
        <script src="/vendor/filepond/index.js"></script>
    </x-slot>

    <x-slot name="header">
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.dokumen-publik.index') }}" class="text-slate-500 hover:text-slate-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <span class="text-slate-300">/</span>
            <span>Edit Informasi Publik</span>
        </div>
    </x-slot>

    <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden max-w-4xl mx-auto">
        <div class="p-6 border-b border-slate-100">
            <h3 class="text-lg font-bold text-[#1A305E]">Form Edit Informasi</h3>
        </div>

        <form action="{{ route('admin.dokumen-publik.update', $informasi->id_informasi) }}" method="POST"
            enctype="multipart/form-data" class="p-6 pt-0 space-y-6">
            @csrf
            @method('PUT')

            <!-- Judul -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Judul Informasi <span
                        class="text-red-500">*</span></label>
                <input type="text" name="judul" value="{{ old('judul', $informasi->judul) }}"
                    class="w-full px-4 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-ppid-accent focus:ring-1 focus:ring-ppid-accent"
                    placeholder="Masukkan judul informasi" required>
                @error('judul')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Kategori -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Kategori <span
                        class="text-red-500">*</span></label>
                <select name="id_kat_info"
                    class="w-full px-4 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-ppid-accent focus:ring-1 focus:ring-ppid-accent"
                    required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategoriList as $kategori)
                        <option value="{{ $kategori->id_kat_info }}" {{ old('id_kat_info', $informasi->id_kat_info) == $kategori->id_kat_info ? 'selected' : '' }}>
                            {{ $kategori->nm_kat_info }}
                        </option>
                    @endforeach
                </select>
                @error('id_kat_info')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- SKPD -->
            <div class="space-y-2">
                <label for="id_skpd" class="text-sm font-medium text-slate-700">SKPD Terkait <span
                        class="text-red-500">*</span></label>
                <x-searchable-select name="id_skpd" id="id_skpd" :options="$skpdList" idKey="id_skpd"
                    :disabled="auth()->user()->hasRole('opd')" labelKey="nm_skpd" :value="old('id_skpd', $informasi->id_skpd)" placeholder="-- Pilih SKPD --" />
                @error('id_skpd')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status Verifikasi -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Status Verifikasi <span
                        class="text-red-500">*</span></label>
                <select name="verify"
                    class="w-full px-4 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-ppid-accent focus:ring-1 focus:ring-ppid-accent"
                    required>
                    <option value="n" {{ old('verify', $informasi->verify) == 'n' ? 'selected' : '' }}>Belum Verifikasi
                    </option>
                    <option value="y" {{ old('verify', $informasi->verify) == 'y' ? 'selected' : '' }}>Terverifikasi
                    </option>
                    <option value="t" {{ old('verify', $informasi->verify) == 't' ? 'selected' : '' }}>Ditolak</option>
                </select>
                @error('verify')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- File Upload -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Dokumen File</label>

                @if($informasi->file)
                    <div class="mb-2 p-3 bg-slate-50 border border-slate-200 rounded flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        <a href="{{ Storage::url($informasi->file) }}" target="_blank"
                            class="text-sm text-blue-600 hover:underline">
                            Lihat File Saat Ini
                        </a>
                    </div>
                @endif

                <input type="file" class="filepond" name="file" id="file_upload">
                <p class="text-xs text-slate-500 mt-1">Biarkan kosong jika tidak ingin mengubah file. Format: PDF, DOC,
                    DOCX, XLS, XLSX, JPG, PNG (Max: 5MB)</p>
                @error('file')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Keterangan -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Keterangan <span
                        class="text-red-500">*</span></label>
                <textarea name="ket" rows="4"
                    class="w-full px-4 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-ppid-accent focus:ring-1 focus:ring-ppid-accent"
                    placeholder="Masukkan keterangan informasi..." required>{{ old('ket', $informasi->ket) }}</textarea>
                @error('ket')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-6 border-t border-slate-100 flex justify-end gap-3">
                <a href="{{ route('admin.dokumen-publik.index') }}"
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
        <script>
            FilePond.registerPlugin(FilePondPluginImagePreview);
            FilePond.create(
                document.querySelector('#file_upload'),
                {
                    labelIdle: `Drag & Drop your file or <span class="filepond--label-action">Browse</span>`,
                    storeAsFile: true,
                    maxFileSize: '5MB',
                }
            );
        </script>
    </x-slot>
</x-admin-layout>