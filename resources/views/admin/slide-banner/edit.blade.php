<x-admin-layout title="Edit Banner - Admin PPID">
    <x-slot name="extra_head">
        <link href="/vendor/filepond/index.css" rel="stylesheet" />
        <link href="/vendor/filepond/image-preview.css" rel="stylesheet" />
        <script src="/vendor/filepond/image-preview.js"></script>
        <script src="/vendor/filepond/index.js"></script>
    </x-slot>

    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-100 dark:border-slate-700 overflow-hidden max-w-4xl mx-auto">
        <div class="p-6 border-b border-slate-100 dark:border-slate-700">
            <h3 class="text-lg font-bold text-[#1A305E] dark:text-blue-400">Form Edit Banner</h3>
        </div>

        <form action="{{ route('admin.slide-banner.update', $slide->id_slide) }}" method="POST"
            enctype="multipart/form-data" class="p-6 pt-0 space-y-6">
            @csrf
            @method('PUT')

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
                    Biarkan kosong jika tidak ingin mengubah gambar. Format: JPG, PNG, GIF (Max: 5MB).
                </p>
            </div>

            <div class="pt-6 border-t border-slate-100 dark:border-slate-700 flex justify-end gap-3">
                <a href="{{ route('admin.slide-banner.index') }}"
                    class="px-4 py-2 bg-white dark:bg-slate-700 border border-slate-200 dark:border-slate-600 text-slate-700 dark:text-slate-200 rounded-lg text-sm font-medium hover:bg-slate-50 dark:hover:bg-slate-600 transition-colors">
                    Batal
                </a>
                <button type="submit"
                    class="px-4 py-2 bg-[#1A305E] dark:bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-ppid-dark dark:hover:bg-blue-700 transition-colors">
                    Perbarui Banner
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
                    files: [
                        @if($slide->nm_slide)
                            {
                                source: '{{ asset('storage/slide_banner/' . $slide->nm_slide) }}',
                                options: {
                                    type: 'local',
                                }
                            }
                        @endif
                    ],
                    server: {
                        load: (source, load, error, progress, abort, headers) => {
                            fetch(source).then((res) => {
                                return res.blob();
                            }).then(load).catch(error);
                        }
                    }
                }
            );
        </script>
    </x-slot>
</x-admin-layout>