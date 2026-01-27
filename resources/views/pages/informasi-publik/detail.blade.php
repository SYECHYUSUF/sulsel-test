<x-layout>
    <x-header />

    {{-- Breadcrumb + Title Section --}}
    <div class="bg-white dark:bg-slate-800 border-b border-gray-200 dark:border-slate-700 font-['Plus_Jakarta_Sans']">
        <div class="container mx-auto px-4 py-6">
            {{-- Breadcrumb --}}
            <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300 mb-4">
                <a href="/" class="hover:text-[#1A305E] dark:text-white transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="w-4 h-4">
                        <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                        <polyline points="9 22 9 12 15 12 15 22" />
                    </svg>
                </a>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="w-4 h-4 text-gray-400">
                    <path d="m9 18 6-6-6-6" />
                </svg>
                <a href="/informasi-publik" class="hover:text-[#1A305E] dark:text-white transition-colors">Informasi
                    Publik</a>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="w-4 h-4 text-gray-400">
                    <path d="m9 18 6-6-6-6" />
                </svg>
                <span class="text-[#1A305E] dark:text-white font-medium">Detail Informasi</span>
            </div>

            {{-- Title --}}
            <div class="flex items-end justify-between">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-[#1A305E] dark:text-white mb-2 leading-tight">
                        {{ $informasi->judul }}
                    </h1>
                    <p class="text-gray-600 dark:text-gray-300">
                        Detail lengkap informasi publik
                    </p>
                </div>
                <div class="hidden md:block">
                    <div class="w-20 h-1 bg-gradient-to-r from-[#1A305E] to-transparent rounded-full"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content --}}
    <main class="py-10 md:py-16 bg-gray-50 dark:bg-slate-900 font-['Plus_Jakarta_Sans']">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div
                    class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl shadow-[#1A305E]/5 border border-gray-100 dark:border-slate-700 overflow-hidden">
                    {{-- Detail Header --}}
                    <div class="bg-gradient-to-br from-[#1A305E] to-[#2A4A8E] p-8 text-white relative overflow-hidden">
                        <div class="absolute top-0 right-0 p-8 opacity-10">
                            <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z" />
                                <polyline points="14 2 14 8 20 8" />
                                <line x1="16" y1="13" x2="8" y2="13" />
                                <line x1="16" y1="17" x2="8" y2="17" />
                                <line x1="10" y1="9" x2="8" y2="9" />
                            </svg>
                        </div>
                        <div class="relative z-10">
                            <span
                                class="inline-block px-3 py-1 bg-[#D4AF37] text-white text-xs font-bold rounded-full mb-4 uppercase tracking-wider">
                                {{ $informasi->kategori->nm_kat_info ?? 'Informasi Publik' }}
                            </span>
                            <h2 class="text-2xl font-bold mb-4">{{ $informasi->judul }}</h2>
                            <div class="flex flex-wrap items-center gap-6 text-sm text-white/80">
                                <div class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="w-4 h-4">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                                        <line x1="16" y1="2" x2="16" y2="6" />
                                        <line x1="8" y1="2" x2="8" y2="6" />
                                        <line x1="3" y1="10" x2="21" y2="10" />
                                    </svg>
                                    {{ $informasi->tgl_upload }}
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="w-4 h-4">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                        <polyline points="7 10 12 15 17 10" />
                                        <line x1="12" x2="12" y1="15" y2="3" />
                                    </svg>
                                    {{ $informasi->jumlah_download ?? 0 }} Unduhan
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Detail Body --}}
                    <div class="p-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                            <div class="space-y-6">
                                <div>
                                    <label
                                        class="block text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-1">SKPD
                                        / Instansi</label>
                                    <p class="text-gray-900 dark:text-white font-medium italic">
                                        {{ $informasi->skpd->nm_skpd ?? '-' }}
                                    </p>
                                </div>
                                <div>
                                    <label
                                        class="block text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-1">Keterangan</label>
                                    <div
                                        class="text-gray-700 dark:text-gray-300 leading-relaxed prose prose-sm dark:prose-invert max-w-none">
                                        {!! $informasi->ket ?? 'Tidak ada keterangan tambahan.' !!}
                                    </div>
                                </div>
                            </div>
                            <div
                                class="bg-gray-50 dark:bg-slate-900/50 p-6 rounded-xl border border-gray-100 dark:border-slate-700 self-start">
                                <label
                                    class="block text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-4">Informasi
                                    Dokumen</label>
                                <ul class="space-y-4 text-sm">
                                    <li class="flex items-start gap-3">
                                        <div
                                            class="w-8 h-8 rounded-lg bg-[#1A305E]/10 flex items-center justify-center flex-shrink-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" class="text-[#1A305E]">
                                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                                <polyline points="14 2 14 8 20 8" />
                                                <line x1="16" y1="13" x2="8" y2="13" />
                                                <line x1="16" y1="17" x2="8" y2="17" />
                                                <line x1="10" y1="9" x2="8" y2="9" />
                                            </svg>
                                        </div>
                                        <div>
                                            <span class="block text-gray-500 dark:text-gray-400 text-xs">Nama
                                                Berkas</span>
                                            <span
                                                class="text-gray-900 dark:text-white font-medium break-all">{{ basename($informasi->file) }}</span>
                                        </div>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <div
                                            class="w-8 h-8 rounded-lg bg-[#1A305E]/10 flex items-center justify-center flex-shrink-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" class="text-[#1A305E]">
                                                <polyline points="22 12 18 12 15 21 9 3 6 12 2 12" />
                                            </svg>
                                        </div>
                                        <div>
                                            <span class="block text-gray-500 dark:text-gray-400 text-xs">Status
                                                Verifikasi</span>
                                            <span
                                                class="inline-flex items-center gap-1.5 text-green-600 font-bold uppercase text-[10px]">
                                                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                                Terverifikasi ({{ $informasi->tgl_verify }})
                                            </span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div
                            class="flex flex-col sm:flex-row items-center gap-4 pt-8 border-t border-gray-100 dark:border-slate-700">
                            @if($informasi->file)
                                <a href="{{ str_starts_with($informasi->file, 'http') ? $informasi->file : asset('storage/' . $informasi->file) }}"
                                    target="_blank"
                                    class="w-full sm:w-auto px-8 py-3 bg-[#1A305E] text-white rounded-xl hover:bg-[#2A4A8E] transition-all flex items-center justify-center gap-2 font-bold shadow-lg shadow-[#1A305E]/20">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" />
                                        <circle cx="12" cy="12" r="3" />
                                    </svg>
                                    Lihat Berkas
                                </a>
                                <a href="{{ str_starts_with($informasi->file, 'http') ? $informasi->file : asset('storage/' . $informasi->file) }}"
                                    download
                                    class="w-full sm:w-auto px-8 py-3 bg-white dark:bg-slate-700 text-[#1A305E] dark:text-white border-2 border-[#1A305E] dark:border-slate-600 rounded-xl hover:bg-gray-50 dark:hover:bg-slate-600 transition-all flex items-center justify-center gap-2 font-bold">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                        <polyline points="7 10 12 15 17 10" />
                                        <line x1="12" x2="12" y1="15" y2="3" />
                                    </svg>
                                    Download Berkas
                                </a>
                            @else
                                <div
                                    class="w-full p-4 bg-red-50 text-red-600 rounded-xl border border-red-100 text-center font-bold">
                                    Berkas tidak tersedia
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Back Link --}}
                <div class="mt-8 text-center">
                    <a href="javascript:history.back()"
                        class="inline-flex items-center gap-2 text-gray-500 hover:text-[#1A305E] transition-colors group italic font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="group-hover:-translate-x-1 transition-transform">
                            <line x1="19" y1="12" x2="5" y2="12" />
                            <polyline points="12 19 5 12 12 5" />
                        </svg>
                        Kembali ke halaman sebelumnya
                    </a>
                </div>
            </div>
        </div>
    </main>

    <x-footer />
</x-layout>