<x-admin-layout title="Manajemen SKPD - Admin PPID">

    <x-slot name="extra_head">
        <link href="/vendor/filepond/index.css" rel="stylesheet" />
        <link
            href="/vendor/filepond/image-preview.css"
            rel="stylesheet"
        />
        <script src="/vendor/filepond/image-preview.js"></script>
        <script src="/vendor/filepond/index.js"></script>
    </x-slot>

    <h3 class="text-lg font-bold text-[#1A305E] dark:text-blue-400 mb-4">{{ $skpd->nm_skpd }}</h3>

    {{-- Success/Error Messages --}}
    @if(session('success'))
        <div class="bg-green-50 dark:bg-green-900/30 border-l-4 mb-4 border-green-500 p-4 rounded-lg">
            <p class="text-green-700 dark:text-green-300">{{ session('success') }}</p>
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-50 dark:bg-red-900/30 border-l-4 mb-4 border-red-500 p-4 rounded-lg">
            <p class="text-red-700 dark:text-red-300">{{ session('error') }}</p>
        </div>
    @endif

    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm p-6 border border-slate-100 dark:border-slate-700 overflow-hidden">
        

        <form action="{{ route('admin.skpd.update', $skpd) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Logo -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Logo SKPD</label>
                    <div class="flex-1">                        
                        <input type="file" 
                            class="filepond"
                            name="logo"
                            id="logo"
                            accept="image/png, image/jpeg, image/jpg"
                        />
                        @error('logo')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Nama SKPD -->
                <div class="col-span-1 md:col-span-2">
                    <x-input-label for="nm_skpd" :value="__('Nama SKPD')" />
                    <x-text-input id="nm_skpd" class="block mt-1 w-full" type="text" name="nm_skpd"
                        :value="old('nm_skpd', $skpd->nm_skpd)" required />
                    <x-input-error :messages="$errors->get('nm_skpd')" class="mt-2" />
                </div>

                <!-- Alamat -->
                <div class="col-span-1 md:col-span-2">
                    <x-input-label for="alamat" :value="__('Alamat')" />
                    <x-text-input id="alamat" class="block mt-1 w-full" type="text" name="alamat" :value="old('alamat', $skpd->alamat)" />
                    <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
                </div>

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $skpd->email)" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- No Telepon -->
                <div>
                    <x-input-label for="no_tlp" :value="__('No Telepon')" />
                    <x-text-input id="no_tlp" class="block mt-1 w-full" type="text" name="no_tlp" :value="old('no_tlp', $skpd->no_tlp)" />
                    <x-input-error :messages="$errors->get('no_tlp')" class="mt-2" />
                </div>

                <!-- Website -->
                <div>
                    <x-input-label for="website" :value="__('Website')" />
                    <x-text-input id="website" class="block mt-1 w-full" type="url" name="website"
                        :value="old('website', $skpd->website)" />
                    <x-input-error :messages="$errors->get('website')" class="mt-2" />
                </div>

                <!-- Jenis -->
                <div>
                    <x-input-label for="jenis" :value="__('Jenis')" />
                    <select id="jenis" name="jenis"
                        class="block mt-1 w-full border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                        <option value="">-- Pilih Jenis --</option>
                        <option value="opd" {{ old('jenis', $skpd->jenis) == 'opd' ? 'selected' : '' }}>OPD</option>
                        <option value="kab" {{ old('jenis', $skpd->jenis) == 'kab' ? 'selected' : '' }}>Kabupaten</option>
                    </select>
                    <x-input-error :messages="$errors->get('jenis')" class="mt-2" />
                </div>

                <!-- Kepala Dinas -->
                <div>
                    <x-input-label for="kadis" :value="__('Kepala Dinas')" />
                    <x-text-input id="kadis" class="block mt-1 w-full" type="text" name="kadis" :value="old('kadis', $skpd->kadis)" />
                    <x-input-error :messages="$errors->get('kadis')" class="mt-2" />
                </div>

                <!-- Sekretaris -->
                <div>
                    <x-input-label for="sek" :value="__('Sekretaris')" />
                    <x-text-input id="sek" class="block mt-1 w-full" type="text" name="sek" :value="old('sek', $skpd->sek)" />
                    <x-input-error :messages="$errors->get('sek')" class="mt-2" />
                </div>

                <!-- Status Aktif -->
                <div>
                    <x-input-label for="is_active" :value="__('Status Aktif')" />
                    <select id="is_active" name="is_active"
                        class="block mt-1 w-full border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                        <option value="1" {{ old('is_active', $skpd->is_active) == '1' ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ old('is_active', $skpd->is_active) == '0' ? 'selected' : '' }}>Tidak Aktif
                        </option>
                    </select>
                    <x-input-error :messages="$errors->get('is_active')" class="mt-2" />
                </div>
            </div>

            <div class="space-y-6 mb-6">
                <!-- Visi Misi -->
                <div>
                    <x-input-label for="visimisi" :value="__('Visi Misi')" />
                    <textarea name="visimisi" id="editor" class="editor"
                        rows="10">{{ old('visimisi', $skpd->visimisi) }}</textarea>

                    <x-input-error :messages="$errors->get('visimisi')" class="mt-2" />
                </div>

                <!-- Tupoksi -->
                <div>
                    <x-input-label for="tupoksi" :value="__('Tupoksi')" />
                    <textarea name="tupoksi" id="editor" class="editor"
                        rows="10">{{ old('tupoksi', $skpd->tupoksi) }}</textarea>

                    <x-input-error :messages="$errors->get('tupoksi')" class="mt-2" />
                </div>
            </div>

            <div class="flex items-center justify-end gap-4">
                <a href="{{ route('admin.skpd.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                    Batal
                </a>
                <x-primary-button>
                    {{ __('Simpan Perubahan') }}
                </x-primary-button>
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
                document.querySelector('#logo'),
                {
                    labelIdle: `Drag & Drop your picture or <span class="filepond--label-action">Browse</span>`,
                    imagePreviewHeight: 170,
                    storeAsFile: true,
                    // Menambahkan file yang sudah ada
                    files: [
                        @if($skpd->logo)
                        {
                            source: "{{ asset('storage/logo-skpd/' . $skpd->logo) }}",
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