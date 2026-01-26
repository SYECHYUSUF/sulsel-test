<x-admin-layout title="Tambah Banner - Admin PPID">
    <x-slot name="extra_head">
        <link href="/vendor/filepond/index.css" rel="stylesheet" />
        <link href="/vendor/filepond/image-preview.css" rel="stylesheet" />
        <script src="/vendor/filepond/image-preview.js"></script>
        <script src="/vendor/filepond/index.js"></script>
    </x-slot>

    <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden max-w-4xl mx-auto">
        <div class="p-6 border-b border-slate-100">
            <h3 class="text-lg font-bold text-[#1A305E]">Form Tambah Banner</h3>
        </div>

        <form action="{{ route('admin.slide-banner.store') }}" method="POST" enctype="multipart/form-data"
            class="p-6 pt-0 space-y-6">
            @csrf

            <!-- Gambar -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Gambar Banner</label>
                <div class="flex-1">
                    <input type="file" class="filepond" name="nm_slide" id="nm_slide"
                        accept="image/png, image/jpeg, image/gif" />
                    @error('nm_slide')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <p class="text-xs text-slate-500 mt-2">
                    Format: JPG, PNG, GIF (Max: 5MB). Rekomendasi ukuran: 1920x600px untuk hasil terbaik.
                </p>
            </div>

            <div class="pt-6 border-t border-slate-100 flex justify-end gap-3">
                <a href="{{ route('admin.slide-banner.index') }}"
                    class="px-4 py-2 bg-white border border-slate-200 text-slate-700 rounded-lg text-sm font-medium hover:bg-slate-50 transition-colors">
                    Batal
                </a>
                <button type="submit"
                    class="px-4 py-2 bg-[#1A305E] text-white rounded-lg text-sm font-medium hover:bg-ppid-dark transition-colors">
                    Simpan Banner
                </button>
            </div>
        </form>
    </div>

    <x-slot name="extra_script">
        <script>
            FilePond.registerPlugin(FilePondPluginImagePreview);
            FilePond.create(
                document.querySelector('#nm_slide'),
                {
                    labelIdle: `Drag & Drop your banner or <span class="filepond--label-action">Browse</span>`,
                    imagePreviewHeight: 300,
                    storeAsFile: true,
                }
            );
        </script>
    </x-slot>
</x-admin-layout>