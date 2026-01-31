<x-admin-layout>
    <x-slot:title>Maklumat Pelayanan</x-slot:title>

<div class="p-8">
    <div class="max-w-7xl mx-auto">
        {{-- Header --}}
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-slate-800 dark:text-white mb-2">Maklumat Pelayanan</h1>
                <p class="text-slate-600 dark:text-slate-400">Kelola konten halaman Maklumat Pelayanan</p>
            </div>
        </div>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-200 rounded-xl flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

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

            <form action="{{ route('admin.maklumat.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-3">
                        Judul Halaman
                    </label>
                    <input type="text" 
                           name="nm_profil" 
                           value="{{ old('nm_profil', $profil->nm_profil ?? 'Maklumat Pelayanan') }}"
                           class="w-full px-4 py-3 border-2 border-slate-300 dark:border-slate-600 rounded-xl focus:outline-none focus:border-[#1A305E] bg-white dark:bg-slate-700 text-slate-900 dark:text-white"
                           required>
                    @error('nm_profil')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-3">
                        Banner/Card Maklumat (Gambar atau PDF)
                    </label>
                    
                    @if(isset($profil->file_banner) && $profil->file_banner)
                        <div class="mb-4 p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl">
                            @if(Str::endsWith($profil->file_banner, '.pdf'))
                                <div class="flex items-center gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                    <div>
                                        <p class="text-sm font-medium text-slate-700 dark:text-slate-300">{{ basename($profil->file_banner) }}</p>
                                        <a href="{{ asset('storage/' . $profil->file_banner) }}" target="_blank" class="text-xs text-blue-600 hover:underline">Preview PDF</a>
                                    </div>
                                </div>
                            @else
                                <img src="{{ asset('storage/' . $profil->file_banner) }}" 
                                     alt="Banner Maklumat" 
                                     class="max-w-md rounded-lg shadow-sm">
                            @endif
                        </div>
                    @endif
                    
                    <input type="file" 
                           name="file_banner" 
                           accept="image/jpeg,image/png,image/jpg,application/pdf"
                           class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#1A305E] file:text-white hover:file:bg-[#2A4A7E] cursor-pointer border-2 border-slate-300 dark:border-slate-600 rounded-xl focus:outline-none">
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-2">Format: JPG, PNG, PDF • Maksimal: 5MB</p>
                    @error('file_banner')
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
                        rows="20"
                        class="w-full px-4 py-3 border-2 border-slate-300 dark:border-slate-600 rounded-xl focus:outline-none focus:border-[#1A305E] bg-white dark:bg-slate-700 text-slate-900 dark:text-white">{{ old('deskripsi', $profil->deskripsi ?? '') }}</textarea>
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

{{-- Summernote Editor --}}
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<style>
    .dark .note-editor { background-color: #1e293b; border-color: #475569; }
    .dark .note-editor .note-toolbar { background-color: #334155; border-bottom-color: #475569; }
    .dark .note-editor .note-editable { background-color: #1e293b; color: #f1f5f9; }
    .dark .note-editor .btn { color: #f1f5f9; }
    .dark .note-editor .dropdown-menu { background-color: #334155; color: #f1f5f9; }
    .dark .note-editor .dropdown-item { color: #f1f5f9; }
    .dark .note-editor .dropdown-item:hover { background-color: #475569; }
</style>
<script>
    $(document).ready(function() {
        $('#editor').summernote({
            height: 400,
            placeholder: 'Tulis konten maklumat pelayanan di sini...',
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
            styleTags: ['p', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'],
            fontNames: ['Arial', 'Times New Roman', 'Verdana', 'Helvetica', 'Georgia', 'Plus Jakarta Sans']
        });
    });
</script>

</x-admin-layout>
