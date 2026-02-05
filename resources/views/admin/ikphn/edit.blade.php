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
                <h3 class="text-lg font-bold text-ppid-primary">Form Edit Informasi Pengadaan</h3>
            </div>

            <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm rounded-b-lg p-6"
                x-data="{ showConfirm: false }" @confirm="document.getElementById('editForm').submit()">

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

                <form id="editForm" action="{{ route('admin.ikphns.update', $item->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Judul / Nama Jabatan -->
                    <div class="mb-4">
                        <label for="nama_jabatan"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Judul / Nama Jabatan
                        </label>
                        <input type="text" name="nama_jabatan" id="nama_jabatan"
                            value="{{ old('nama_jabatan', $item->nama_jabatan) }}" required
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-slate-700 dark:border-slate-600 dark:text-white">
                    </div>


                    <!-- File Upload -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Dokumen File
                            <span class="text-xs text-gray-500 font-normal">(Biarkan kosong jika tidak ingin
                                mengubah)</span>
                        </label>

                        @if($item->file)
                            <div class="mb-2 text-sm text-gray-500 flex items-center gap-2">
                                <span>File saat ini:</span>
                                <a href="{{ Storage::url($item->file) }}" target="_blank"
                                    class="text-blue-500 hover:text-blue-700 underline flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                    Download
                                </a>
                            </div>
                        @endif

                        <input type="file" class="filepond" name="file" id="file_upload">
                        <p class="text-xs text-slate-500 mt-1">Format: PDF, DOC, DOCX, XLS, XLSX, JPG, PNG (Max: 50MB)
                        </p>
                        @error('file')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>




                    <div class="flex justify-end gap-3 mt-6">
                        <a href="{{ route('admin.ikphns.index') }}"
                            class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">
                            Batal
                        </a>
                        <button type="button" @click="showConfirm = true"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>

                <x-confirmation-dialog trigger="showConfirm" title="Simpan Perubahan?"
                    description="Apakah anda yakin ingin menyimpan perubahan data ini?" confirmText="Ya, Simpan"
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
                document.querySelector('#file_upload'), {
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