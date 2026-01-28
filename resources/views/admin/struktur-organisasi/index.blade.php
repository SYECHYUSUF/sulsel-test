<x-admin-layout>
    <x-slot:title>Struktur Organisasi</x-slot:title>

<div class="p-8">
    <div class="max-w-7xl mx-auto">
        {{-- Header --}}
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-slate-800 dark:text-white mb-2">Struktur Organisasi</h1>
                <p class="text-slate-600 dark:text-slate-400">Kelola struktur organisasi PPID Sulawesi Selatan</p>
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

        {{-- Upload Section --}}
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 p-8 mb-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="flex items-center justify-center w-12 h-12 rounded-full bg-[#1A305E] text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-slate-800 dark:text-white">Upload File PDF</h2>
            </div>

            <form action="{{ route('admin.struktur-organisasi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-3">
                        Pilih File PDF Struktur Organisasi
                    </label>
                    
                    @if(isset($settings['struktur_organisasi_path']))
                        <div class="mb-4 p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                                <div>
                                    <p class="text-sm font-semibold text-slate-700 dark:text-slate-300">File Saat Ini Aktif</p>
                                    <p class="text-xs text-slate-500 dark:text-slate-400">{{ basename($settings['struktur_organisasi_path']) }}</p>
                                </div>
                            </div>
                            <a href="{{ asset($settings['struktur_organisasi_path']) }}" 
                               target="_blank" 
                               class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm font-medium flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                Lihat File
                            </a>
                        </div>
                    @endif
                    
                    <input type="file" 
                           name="struktur_organisasi" 
                           accept=".pdf" 
                           class="block w-full text-sm text-slate-500 dark:text-slate-400
                                  file:mr-4 file:py-3 file:px-6
                                  file:rounded-xl file:border-0
                                  file:text-sm file:font-semibold
                                  file:bg-[#1A305E] file:text-white
                                  hover:file:bg-[#2A4A7E]
                                  file:transition-colors file:cursor-pointer
                                  border-2 border-dashed border-slate-300 dark:border-slate-600 rounded-xl 
                                  cursor-pointer focus:outline-none focus:border-[#1A305E] 
                                  bg-white dark:bg-slate-700 p-4">
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-2">Format: PDF • Ukuran maksimal: 5MB</p>
                    @error('struktur_organisasi')
                        <p class="text-red-500 text-sm mt-2 flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ $message }}
                        </p>
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

        {{-- PDF Preview Section --}}
        @if(isset($settings['struktur_organisasi_path']) && $settings['struktur_organisasi_path'])
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
            <div class="border-b border-slate-200 dark:border-slate-700 px-8 py-5 flex items-center justify-between bg-slate-50 dark:bg-slate-900">
                <div class="flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-[#1A305E] dark:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h2 class="font-bold text-slate-900 dark:text-white text-lg">Preview Struktur Organisasi</h2>
                </div>
                <a href="{{ asset($settings['struktur_organisasi_path']) }}" 
                   download
                   class="flex items-center gap-2 px-4 py-2 bg-[#1A305E] text-white rounded-lg hover:bg-[#2A4A7E] transition-colors text-sm font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    Download PDF
                </a>
            </div>
            
            <div class="p-8">
                <div class="rounded-xl overflow-hidden border-2 border-slate-200 dark:border-slate-700 shadow-inner bg-slate-50 dark:bg-slate-900">
                    <iframe src="{{ asset($settings['struktur_organisasi_path']) }}" 
                            class="w-full border-0 bg-white dark:bg-slate-800" 
                            style="height: 800px;">
                        <p class="p-8 text-center text-slate-600 dark:text-slate-400">
                            Browser Anda tidak mendukung pratinjau PDF. 
                            <a href="{{ asset($settings['struktur_organisasi_path']) }}" 
                               class="text-[#1A305E] dark:text-blue-400 font-semibold hover:underline">
                                Klik di sini untuk download PDF
                            </a>
                        </p>
                    </iframe>
                </div>
            </div>
        </div>
        @else
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 p-12">
            <div class="text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-20 h-20 mx-auto mb-4 text-slate-300 dark:text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                </svg>
                <h3 class="text-lg font-bold text-slate-700 dark:text-slate-300 mb-2">Belum Ada File Struktur Organisasi</h3>
                <p class="text-slate-500 dark:text-slate-400">Upload file PDF struktur organisasi menggunakan form di atas.</p>
            </div>
        </div>
        @endif
    </div>
</div>

</x-admin-layout>
