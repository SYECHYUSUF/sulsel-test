<x-admin-layout>
    <x-slot:title>Edit SOP</x-slot:title>

    <x-slot name="extra_head">
        <link href="/vendor/filepond/index.css" rel="stylesheet" />
        <link href="/vendor/filepond/image-preview.css" rel="stylesheet" />
        <script src="/vendor/filepond/image-preview.js"></script>
        <script src="/vendor/filepond/index.js"></script>
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <div class="flex items-center gap-4 mb-6">
            <a href="{{ route('admin.data-sop.index') }}"
                class="p-2 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-slate-900 dark:text-slate-100">Edit SOP</h1>
                <p class="text-slate-500 dark:text-slate-400 text-sm">Perbarui informasi atau dokumen SOP.</p>
            </div>
        </div>

        <form action="{{ route('admin.data-sop.update', $sop->id) }}" method="POST" enctype="multipart/form-data"
            class="space-y-6">
            @csrf
            @method('PUT')
            <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl p-6 shadow-sm space-y-6">
                <div>
                    <label for="judul" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Judul Dokumen SOP <span
                            class="text-rose-500">*</span></label>
                    <input type="text" name="judul" id="judul" value="{{ old('judul', $sop->judul) }}"
                        class="w-full px-4 py-2.5 border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all placeholder-slate-400 dark:placeholder-slate-500"
                        placeholder="Contoh: SOP Pelayanan Informasi Publik" required>
                    @error('judul')
                        <p class="mt-1 text-sm text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">File Dokumen</label>
                    <div class="mb-4 p-4 bg-slate-50 dark:bg-slate-700/50 border border-slate-100 dark:border-slate-700 rounded-xl flex items-center gap-3">
                        <div class="p-2 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-600 rounded-lg shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600 dark:text-indigo-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-slate-900 dark:text-slate-100">File Saat Ini:</p>
                            <a href="{{ asset('storage/sop/' . $sop->file) }}" target="_blank"
                                class="text-xs text-indigo-600 dark:text-indigo-400 hover:underline">{{ $sop->file }}</a>
                        </div>
                    </div>

                    <input type="file" name="file" id="file" class="filepond">
                    <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">Biarkan kosong jika tidak ingin mengubah file. Format: PDF,
                        DOC, DOCX, XLS, XLSX, JPG, PNG (Max 5MB).</p>
                    @error('file')
                        <p class="mt-1 text-sm text-rose-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex items-center justify-end gap-3">
                <a href="{{ route('admin.data-sop.index') }}"
                    class="px-6 py-2.5 border border-slate-200 dark:border-slate-600 rounded-xl text-sm font-semibold text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 transition-all">Batal</a>
                <button type="submit"
                    class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-semibold shadow-sm transition-all focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Perbarui
                    SOP</button>
            </div>
        </form>
    </div>

    <!-- Vendor -->
    <x-slot name="extra_script">
        <script>
            FilePond.registerPlugin(FilePondPluginImagePreview);
            FilePond.registerPlugin(
                FilePondPluginImagePreview,
            );
            // Select the file input and use 
            // create() to turn it into a pond
            FilePond.create(
                document.querySelector('#file'),
                {
                    labelIdle: `Seret & Letakkan file atau <span class="filepond--label-action">Telusuri</span> untuk mengganti file`,
                    imagePreviewHeight: 170,
                    storeAsFile: true,
                    // Menambahkan file yang sudah ada
                    files: [
                        @if($sop->file)
                                            {
                                source: "{{ asset('storage/sop/' . $sop->file) }}",
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