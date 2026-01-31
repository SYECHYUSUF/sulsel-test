<x-layout>
    <x-header />

    {{-- Breadcrumb + Title Section --}}
    <div class="bg-white dark:bg-slate-800 border-b border-gray-200 dark:border-slate-700 font-['Plus_Jakarta_Sans']">
        <div class="container mx-auto px-4 py-6">
            {{-- Breadcrumb --}}
            <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300 mb-4">
                <a href="/" class="hover:text-[#1A305E] dark:text-white transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                </a>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-gray-400"><path d="m9 18 6-6-6-6"/></svg>
                <a href="#" class="hover:text-[#1A305E] dark:text-white transition-colors">Profil</a>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-gray-400"><path d="m9 18 6-6-6-6"/></svg>
                <span class="text-[#1A305E] dark:text-white font-medium">Maklumat</span>
            </div>
          
            {{-- Title --}}
            <div class="flex items-end justify-between">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold text-[#1A305E] dark:text-white mb-2">
                        Maklumat
                    </h1>
                    <p class="text-gray-600 dark:text-gray-300">
                        Maklumat Pelayanan Informasi Publik PPID Sulawesi Selatan
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
            <div class="max-w-5xl mx-auto space-y-8">
            
                {{-- Maklumat Document --}}
                <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-200 dark:border-slate-700 overflow-hidden">
                    <div class="border-b border-gray-200 dark:border-slate-700 px-6 py-4 flex items-center justify-between bg-gray-50 dark:bg-slate-900">
                        <h2 class="font-bold text-gray-900 dark:text-white">Maklumat Pelayanan Informasi Publik</h2>
                        <button class="flex items-center gap-2 text-[#1A305E] dark:text-white hover:text-[#D4AF37] text-sm font-medium transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>
                            Download
                        </button>
                    </div>
              
                    <div class="p-6">
                        <div class="rounded-lg overflow-hidden border border-gray-200 dark:border-slate-700">
                            @if($profil && $profil->file_banner)
                                @if(Str::endsWith($profil->file_banner, '.pdf'))
                                    {{-- PDF Preview --}}
                                    <div class="aspect-[4/3] bg-gray-100 dark:bg-slate-700 flex flex-col items-center justify-center p-8">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-24 h-24 text-red-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                        </svg>
                                        <p class="text-gray-700 dark:text-gray-300 font-medium mb-4">Maklumat Pelayanan (PDF)</p>
                                        <a href="{{ asset('storage/' . $profil->file_banner) }}" 
                                           target="_blank"
                                           class="inline-flex items-center gap-2 px-6 py-3 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            Lihat PDF
                                        </a>
                                    </div>
                                @else
                                    {{-- Image Display --}}
                                    <img
                                        src="{{ asset('storage/' . $profil->file_banner) }}"
                                        alt="Maklumat Pelayanan Informasi Publik PPID Sulawesi Selatan"
                                        class="w-full h-auto"
                                    />
                                @endif
                            @else
                                {{-- Fallback to static image if no dynamic file --}}
                                <img
                                    src="{{ asset('images/20230918134717_Maklumat pelayanan informasi publik.png') }}"
                                    alt="Maklumat Pelayanan Informasi Publik PPID Sulawesi Selatan"
                                    class="w-full h-auto"
                                />
                            @endif
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-300 text-center mt-4">
                            Maklumat Pelayanan Informasi Publik - PPID Provinsi Sulawesi Selatan
                        </p>
                    </div>
                </div>

                {{-- Info Cards --}}
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm border border-gray-200 dark:border-slate-700 p-6">
                        <h3 class="font-bold text-gray-900 dark:text-white mb-4">Komitmen PPID</h3>
                        <p class="text-sm text-gray-700 leading-relaxed mb-4">
                            Dengan ini kami menyatakan sanggup menyelenggarakan pelayanan informasi publik dengan sebaik-baiknya sesuai dengan Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik.
                        </p>
                        <div class="bg-[#1A305E]/5 border-l-4 border-[#1A305E] rounded-r p-4">
                            <p class="text-xs text-gray-700 italic">
                                "Apabila pelayanan kami tidak sesuai dengan standar yang telah ditetapkan, kami siap menerima sanksi sesuai dengan peraturan perundang-undangan yang berlaku."
                            </p>
                        </div>
                    </div>

                    <div class="bg-[#D4AF37]/5 border border-[#D4AF37]/20 rounded-lg p-6">
                        <h3 class="font-bold text-[#B08D26] mb-4">Standar Pelayanan</h3>
                        <div class="space-y-3 text-sm text-gray-700">
                            <div class="flex gap-2">
                                <span class="text-[#D4AF37] mt-0.5">•</span>
                                <span>Memberikan layanan informasi yang cepat, mudah, dan sederhana</span>
                            </div>
                            <div class="flex gap-2">
                                <span class="text-[#D4AF37] mt-0.5">•</span>
                                <span>Menyediakan informasi yang akurat, benar, dan tidak menyesatkan</span>
                            </div>
                            <div class="flex gap-2">
                                <span class="text-[#D4AF37] mt-0.5">•</span>
                                <span>Melayani permohonan informasi sesuai waktu yang ditentukan</span>
                            </div>
                            <div class="flex gap-2">
                                <span class="text-[#D4AF37] mt-0.5">•</span>
                                <span>Memberikan alasan tertulis jika permohonan ditolak</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Contact Info --}}
                <div class="bg-gradient-to-br from-[#1A305E] to-[#4A5568] rounded-xl p-6 md:p-8 text-white text-center">
                    <h3 class="text-lg font-bold mb-2">Informasi & Pengaduan</h3>
                    <p class="text-white/90 text-sm">
                        Untuk informasi lebih lanjut atau menyampaikan pengaduan terkait pelayanan informasi publik, silakan hubungi PPID Sulawesi Selatan melalui saluran yang tersedia.
                    </p>
                </div>

            </div>
        </div>
    </main>

    <x-footer />
</x-layout>
