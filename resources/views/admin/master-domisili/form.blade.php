<x-admin-layout>
    <x-slot:title>{{ isset($item) ? 'Edit' : 'Tambah' }} Domisili</x-slot:title>

    <div class="max-w-3xl space-y-6">
        {{-- Header --}}
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.master-domisili.index') }}" 
               class="p-2 text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-lg transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-slate-900 dark:text-slate-100">{{ isset($item) ? 'Edit' : 'Tambah' }} Domisili</h1>
                <p class="text-slate-500 dark:text-slate-400 text-sm">{{ isset($item) ? 'Perbarui' : 'Tambahkan' }} data domisili</p>
            </div>
        </div>

        {{-- Form Card --}}
        <div class="bg-white dark:bg-slate-800 rounded-2xl overflow-hidden shadow-sm border border-slate-200 dark:border-slate-700">
            <form action="{{ isset($item) ? route('admin.master-domisili.update', $item->id) : route('admin.master-domisili.store') }}" method="POST" class="p-6 space-y-6">
                @csrf
                @if(isset($item))
                    @method('PUT')
                @endif

                {{-- Nama Daerah --}}
                <div class="space-y-2">
                    <label for="nama_daerah" class="block text-sm font-medium text-slate-700 dark:text-slate-300">
                        Nama Daerah <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" 
                           name="nama_daerah" 
                           id="nama_daerah" 
                           value="{{ old('nama_daerah', $item->nama_daerah ?? '') }}"
                           class="w-full px-4 py-2 border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all @error('nama_daerah') border-rose-500 @enderror"
                           placeholder="Contoh: Kota Makassar"
                           required>
                    @error('nama_daerah')
                        <p class="text-sm text-rose-600 dark:text-rose-400 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Provinsi --}}
                <div class="space-y-2">
                    <label for="provinsi" class="block text-sm font-medium text-slate-700 dark:text-slate-300">
                        Provinsi <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" 
                           name="provinsi" 
                           id="provinsi" 
                           value="{{ old('provinsi', $item->provinsi ?? 'Sulawesi Selatan') }}"
                           class="w-full px-4 py-2 border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all @error('provinsi') border-rose-500 @enderror"
                           required>
                    @error('provinsi')
                        <p class="text-sm text-rose-600 dark:text-rose-400 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Status Aktif --}}
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Status</label>
                    <div class="flex items-center gap-3 p-4 bg-slate-50 dark:bg-slate-700/50 rounded-xl border border-slate-200 dark:border-slate-700">
                        <input type="checkbox" 
                               id="is_active" 
                               name="is_active" 
                               value="1"
                               {{ old('is_active', $item->is_active ?? true) ? 'checked' : '' }}
                               class="w-4 h-4 rounded border-slate-300 dark:border-slate-600 text-indigo-600 focus:ring-indigo-500 dark:bg-slate-700">
                        <label for="is_active" class="flex-1 text-sm text-slate-700 dark:text-slate-300">
                            Aktifkan domisili ini di form permohonan informasi
                        </label>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex items-center gap-3 pt-4 border-t border-slate-200 dark:border-slate-700">
                    <button type="submit" 
                            class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-xl transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        {{ isset($item) ? 'Update' : 'Simpan' }}
                    </button>
                    <a href="{{ route('admin.master-domisili.index') }}" 
                       class="px-4 py-2 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-400 text-sm font-medium rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
