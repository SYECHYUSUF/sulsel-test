<x-admin-layout title="Manajemen SKPD - Admin PPID">
    <x-slot name="header">
        Manajemen SKPD
    </x-slot>

    <h3 class="text-lg font-bold text-[#1A305E] mb-4">{{ $skpd->nm_skpd }}</h3>

    <div class="bg-white rounded-xl shadow-sm p-6 border border-slate-100 overflow-hidden">
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-200 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.skpd.update', $skpd) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
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
                        class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
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
                        class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
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
                    class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
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
    </x-slot>
</x-admin-layout>