<x-admin-layout>
    <x-slot:title>Sambutan</x-slot:title>

<div class="p-8">
    <div class="max-w-7xl mx-auto">
        {{-- Header --}}
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-slate-800 dark:text-white mb-2">Sambutan</h1>
                <p class="text-slate-600 dark:text-slate-400">Kelola konten halaman Sambutan</p>
            </div>
        </div>

    <div x-data="{ showSuccess: {{ session('success') ? 'true' : 'false' }} }">
        <x-notification-modal 
            trigger="showSuccess" 
            status="success" 
            title="Berhasil!" 
            description="{{ session('success') }}" 
        />

        {{-- Editor Section --}}
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 p-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="flex items-center justify-center w-12 h-12 rounded-full bg-[#1A305E] text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-slate-800 dark:text-white">Editor Konten</h2>
            </div>

            <form action="{{ route('admin.sambutan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-3">
                        Judul Halaman
                    </label>
                    <input type="text" 
                           name="nm_profil" 
                           value="{{ old('nm_profil', $profil->nm_profil ?? 'Sambutan') }}"
                           class="w-full px-4 py-3 border-2 border-slate-300 dark:border-slate-600 rounded-xl focus:outline-none focus:border-[#1A305E] bg-white dark:bg-slate-700 text-slate-900 dark:text-white"
                           required>
                    @error('nm_profil')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-3">
                        Foto Kepala PPID
                    </label>
                    
                    @if(isset($profil->foto_kepala) && $profil->foto_kepala)
                        <div class="mb-4">
                            <img src="{{ asset('storage/' . $profil->foto_kepala) }}" 
                                 alt="Kepala PPID Sulawesi Selatan" 
                                 class="w-64 h-80 rounded-xl shadow-lg object-cover">
                        </div>
                    @endif
                    
                    <input type="file" 
                           name="foto_kepala" 
                           accept="image/jpeg,image/png,image/jpg"
                           class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#1A305E] file:text-white hover:file:bg-[#2A4A7E] cursor-pointer border-2 border-slate-300 dark:border-slate-600 rounded-xl focus:outline-none">
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-2">Format: JPG, PNG • Maksimal: 5MB</p>
                    @error('foto_kepala')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-3">
                        Konten Halaman
                    </label>
                    <textarea 
                        name="deskripsi" 
                        id="editor"
                        class="editor w-full px-4 py-3 border-2 border-slate-300 dark:border-slate-600 rounded-xl focus:outline-none focus:border-[#1A305E] bg-white dark:bg-slate-700 text-slate-900 dark:text-white"
                        rows="10">{{ old('deskripsi', $profil->deskripsi ?? '') }}</textarea>
                    @error('deskripsi')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-3">
                    <button type="submit" 
                            class="px-6 py-3 bg-gradient-to-r from-[#1A305E] to-[#2A4A7E] text-white font-semibold rounded-xl hover:from-[#2A4A7E] hover:to-[#1A305E] transition-all shadow-md hover:shadow-lg flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        {{-- Preview Section --}}
        @if(isset($profil->deskripsi) && $profil->deskripsi)
        <div class="mt-8 bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 p-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="flex items-center justify-center w-12 h-12 rounded-full bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-slate-800 dark:text-white">Preview Konten</h2>
            </div>
            <div class="prose prose-slate max-w-none dark:prose-invert">
                {!! $profil->deskripsi !!}
            </div>
        </div>
        @endif
        </div>
    </div>
</div>

<x-slot name="extra_script">
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/tinymce/tinymce.min.js"></script>
    <script src="/vendor/tinymce/init-editor.js"></script>
</x-slot>

</x-admin-layout>
