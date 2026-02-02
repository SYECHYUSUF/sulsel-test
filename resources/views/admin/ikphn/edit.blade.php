<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Informasi Pengadaan') }}
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

                <form action="{{ route('admin.ikphns.update', $item->id) }}" method="POST"
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

                    <!-- SKPD -->
                    <div class="mb-4">
                        <label for="id_skpd" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            SKPD
                        </label>
                        <select name="id_skpd" id="id_skpd" required
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-slate-700 dark:border-slate-600 dark:text-white">
                            <option value="">-- Pilih SKPD --</option>
                            @foreach ($skpdList as $skpd)
                                <option value="{{ $skpd->id_skpd }}" {{ old('id_skpd', $item->id_skpd) == $skpd->id_skpd ? 'selected' : '' }}>
                                    {{ $skpd->nm_skpd }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- File Upload -->
                    <div class="mb-6">
                        <label for="file" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Update File (Biarkan kosong jika tidak ingin mengubah)
                        </label>
                        @if($item->file)
                            <div class="mb-2 text-sm text-gray-500">
                                File saat ini: <a href="{{ Storage::url($item->file) }}" target="_blank"
                                    class="text-blue-500 underline">Download</a>
                            </div>
                        @endif
                        <input type="file" name="file" id="file"
                            class="w-full px-4 py-2 border rounded-lg dark:bg-slate-700 dark:border-slate-600 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Verification (Admin Only) -->
                    @role('admin')
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status
                            Verifikasi</label>
                        <div class="flex items-center gap-4">
                            <label class="flex items-center gap-2">
                                <input type="radio" name="verify" value="n" {{ old('verify', $item->verify) == 'n' ? 'checked' : '' }} class="text-blue-600 focus:ring-blue-500">
                                <span class="text-gray-700 dark:text-gray-300">Pending</span>
                            </label>
                            <label class="flex items-center gap-2">
                                <input type="radio" name="verify" value="y" {{ old('verify', $item->verify) == 'y' ? 'checked' : '' }} class="text-green-600 focus:ring-green-500">
                                <span class="text-gray-700 dark:text-gray-300">Terverifikasi</span>
                            </label>
                            <label class="flex items-center gap-2">
                                <input type="radio" name="verify" value="t" {{ old('verify', $item->verify) == 't' ? 'checked' : '' }} class="text-red-600 focus:ring-red-500">
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
                            Simpan Perubahan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-admin-layout>