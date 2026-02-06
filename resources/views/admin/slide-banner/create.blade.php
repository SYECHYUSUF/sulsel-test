<x-admin-layout title="Tambah Banner - Admin PPID">
    <x-slot name="extra_head">
        <link href="/vendor/filepond/index.css" rel="stylesheet" />
        <link href="/vendor/filepond/image-preview.css" rel="stylesheet" />
        <script src="/vendor/filepond/image-preview.js"></script>
        <script src="/vendor/filepond/image-validate-size.js"></script>
        <script src="/vendor/filepond/image-crop.js"></script>
        <script src="/vendor/filepond/image-transform.js"></script>
        <script src="/vendor/filepond/index.js"></script>
    </x-slot>

    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-100 dark:border-slate-700 overflow-hidden max-w-4xl mx-auto">
        <div class="p-6 border-b border-slate-100 dark:border-slate-700">
            <h3 class="text-lg font-bold text-ppid-primary dark:text-blue-400">Form Tambah Banner</h3>
        </div>

        <form id="createForm" action="{{ route('admin.slide-banner.store') }}" method="POST" enctype="multipart/form-data"
            class="p-6 pt-0 space-y-6" x-data="{ showConfirm: false }" @confirm="document.getElementById('createForm').submit()">
            @csrf

            <!-- Gambar -->
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Gambar Banner</label>
                <div class="flex-1">
                    <input type="file" class="filepond" name="nm_slide" id="nm_slide"
                        accept="image/png, image/jpeg, image/gif" />
                    @error('nm_slide')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-2">
                    Format: JPG, PNG, GIF (Max: 20MB). Rekomendasi ukuran: 2752×1536 atau lebih besar untuk hasil terbaik.
                </p>
            </div>

            <div class="pt-6 border-t border-slate-100 dark:border-slate-700 flex justify-end gap-3">
                <a href="{{ route('admin.slide-banner.index') }}"
                    class="px-4 py-2 bg-white dark:bg-slate-700 border border-slate-200 dark:border-slate-600 text-slate-700 dark:text-slate-200 rounded-lg text-sm font-medium hover:bg-slate-50 dark:hover:bg-slate-600 transition-colors">
                    Batal
                </a>
                <button type="button" @click="showConfirm = true"
                    class="px-4 py-2 bg-ppid-primary dark:bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-ppid-dark dark:hover:bg-blue-700 transition-colors">
                    Simpan Banner
                </button>
            </div>
            
            <x-confirmation-dialog trigger="showConfirm" title="Simpan Banner?"
                description="Apakah Anda yakin ingin menyimpan banner ini?" confirmText="Ya, Simpan" theme="primary" />
        </form>
    </div>

    <x-slot name="extra_script">
        <script>
            FilePond.registerPlugin(
                FilePondPluginImagePreview,
                FilePondPluginImageValidateSize,
                FilePondPluginImageCrop,
                FilePondPluginImageTransform
            );
            FilePond.create(
                document.querySelector('#nm_slide'),
                {
                    labelIdle: `Seret & Letakkan file atau <span class="filepond--label-action">Telusuri</span>`,
                    
                    imagePreviewHeight: 300,
                    storeAsFile: true,

                    server: null, 
                    allowProcess: false,

                    // Memaksa Rasio Gambar (Crop)
                    imageCropAspectRatio: '2752:1536', 

                    // Validasi Dimensi Minimum (Opsional tapi disarankan)
                    imageValidateSizeMinWidth: 2752,
                    imageValidateSizeMinHeight: 1536,

                    // Paksa Format Output
                    imageTransformOutputMimeType: 'image/jpeg',
                    
                    // Pesan error kustom
                    labelFileTypeNotAllowed: 'File tidak valid',
                    fileValidateSizeLabelExpectedMinSize: 'Ukuran minimum adalah {minWidth} x {minHeight}',
                }
            );
        </script>
    </x-slot>
</x-admin-layout>