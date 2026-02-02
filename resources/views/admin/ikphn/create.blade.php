<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Informasi Pengadaan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg p-8">

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

                <form action="{{ route('admin.ikphns.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Judul / Nama Jabatan -->
                    <div class="mb-4">
                        <label for="nama_jabatan"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Judul / Nama Jabatan
                        </label>
                        <input type="text" name="nama_jabatan" id="nama_jabatan" value="{{ old('nama_jabatan') }}"
                            required
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-slate-700 dark:border-slate-600 dark:text-white">
                    </div>

                    <!-- SKPD -->
                    <div class="mb-4">
                        <label for="id_skpd" class="text-sm font-medium text-slate-700">SKPD Terkait</label>

                        <x-searchable-select name="id_skpd" id="id_skpd" :options="$skpdList" idKey="id_skpd"
                            :disabled="auth()->user()->hasRole('opd')" labelKey="nm_skpd" :value="old('id_skpd', auth()->user()->id_skpd)" placeholder="-- Pilih SKPD --" />

                        @error('id_skpd')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- File Upload -->
                    <div class="mb-6">
                        <label for="file" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Upload File (PDF, DOCX, JPG, PNG) max 10MB
                        </label>
                        <input type="file" name="file" id="file" required
                            class="w-full px-4 py-2 border rounded-lg dark:bg-slate-700 dark:border-slate-600 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Verification (Admin Only) -->
                    @role('admin')
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
                    @endrole

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('admin.ikphns.index') }}"
                            class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">
                            Batal
                        </a>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                            Simpan Data
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-admin-layout>