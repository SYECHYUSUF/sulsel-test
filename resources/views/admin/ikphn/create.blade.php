<x-admin-layout>

    <x-slot name="extra_head">
        <link href="/vendor/filepond/index.css" rel="stylesheet" />
        <link href="/vendor/filepond/image-preview.css" rel="stylesheet" />
        <link href="/vendor/filepond/filepond-plugin-pdf-preview.min.css" rel="stylesheet" />

        <script src="/vendor/filepond/image-preview.js"></script>
        <script src="/vendor/filepond/index.js"></script>
        <script src="/vendor/filepond/filepond-plugin-pdf-preview.min.js"></script>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-800 p-6 shadow-sm rounded-t-lg border-b border-slate-100">
                <h3 class="text-lg font-bold text-[#1A305E]">Form Tambah Informasi Pengadaan</h3>
            </div>

            <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm rounded-b-lg p-6"
                x-data="{ showConfirm: false }" @confirm="document.getElementById('createForm').submit()">

                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                        <strong class="font-bold">Error!</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form id="createForm" action="{{ route('admin.ikphns.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <!-- Judul / Nama Jabatan -->
                    <div class="mb-4">
                        <label for="nama_jabatan"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Judul / Nama Jabatan
                        </label>
                        <input type="text" name="nama_jabatan" id="nama_jabatan" value="{{ old('nama_jabatan') }}"
                            class="w-full px-4 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-ppid-accent focus:ring-1 focus:ring-ppid-accent"
                            placeholder="Masukkan judul berita" required>
                    </div>

                    <!-- SKPD -->
                    <!-- <div class="mb-4">
                        <label for="id_skpd" class="text-sm font-medium text-slate-700">SKPD Terkait</label>

                        <x-searchable-select name="id_skpd" id="id_skpd" :options="$skpdList" idKey="id_skpd"
                            :disabled="auth()->user()->hasRole('opd')" labelKey="nm_skpd" :value="old('id_skpd', auth()->user()->id_skpd)" placeholder="-- Pilih SKPD --" />

                        @error('id_skpd')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div> -->

                    <!-- File Upload -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Dokumen File <span
                                class="text-red-500">*</span></label>
                        <input type="file" class="filepond" name="file" id="file_upload" required>
                        <p class="text-xs text-slate-500 mt-1">Format: PDF, DOC, DOCX, XLS, XLSX, JPG, PNG (Max: 50MB)
                        </p>
                        @error('file')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>


                    <!-- Verification (Admin Only) -->
                    <!-- @role('admin')
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status
                            Verifikasi</label>
                        <div class="flex items-center gap-4">
                            <label class="flex items-center gap-2">
                                <input type="radio" name="verify" value="n" {{ old('verify') == 'n' ? 'checked' : '' }}
                                    class="text-blue-600 focus:ring-blue-500">
                                <span class="text-gray-700 dark:text-gray-300">Pending</span>
                            </label>
                            <label class="flex items-center gap-2">
                                <input type="radio" name="verify" value="y" {{ old('verify') == 'y' ? 'checked' : '' }}
                                    class="text-green-600 focus:ring-green-500">
                                <span class="text-gray-700 dark:text-gray-300">Terverifikasi</span>
                            </label>
                            <label class="flex items-center gap-2">
                                <input type="radio" name="verify" value="t" {{ old('verify') == 't' ? 'checked' : '' }}
                                    class="text-red-600 focus:ring-red-500">
                                <span class="text-gray-700 dark:text-gray-300">Ditolak</span>
                            </label>
                        </div>
                    </div>
                    @endrole -->

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('admin.ikphns.index') }}"
                            class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">
                            Batal
                        </a>
                        <button type="button" @click="showConfirm = true"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                            Simpan Data
                        </button>
                    </div>
                </form>

                <x-confirmation-dialog trigger="showConfirm" title="Simpan Data?"
                    description="Apakah anda yakin ingin menyimpan data ini?" confirmText="Ya, Simpan"
                    theme="primary" />

            </div>
        </div>
    </div>

    <!-- Vendor -->
    <x-slot name="extra_script">
        <script src="/vendor/filepond/image-preview.js"></script>
        <script src="/vendor/filepond/filepond-plugin-pdf-preview.min.js"></script>
        <script src="/vendor/filepond/index.js"></script>
        <script>
            // Registrasi kedua plugin: Image Preview dan PDF Preview
            FilePond.registerPlugin(
                FilePondPluginImagePreview,
                FilePondPluginPdfPreview
            );
            FilePond.create(
                document.querySelector('#file_upload'),
                {
                    labelIdle: `Seret & Letakkan file atau <span class="filepond--label-action">Telusuri</span>`,
                    storeAsFile: true,
                    maxFileSize: '50MB',

                    // Konfigurasi PDF Preview
                    allowPdfPreview: true,
                    pdfPreviewHeight: 320,
                    pdfComponentExtraParams: 'toolbar=0&view=fit&page=1'
                }
            );
        </script>
    </x-slot>
</x-admin-layout>