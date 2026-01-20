<x-layout>
    <x-header />

    {{-- Breadcrumb + Title Section --}}
    <div class="bg-white border-b border-gray-200 font-['Plus_Jakarta_Sans']">
        <div class="container mx-auto px-4 py-6">
            {{-- Breadcrumb --}}
            <div class="flex items-center gap-2 text-sm text-gray-600 mb-4">
                <a href="/" class="hover:text-[#1A305E] transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                </a>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-gray-400"><path d="m9 18 6-6-6-6"/></svg>
                <a href="#" class="hover:text-[#1A305E] transition-colors">Profil</a>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-gray-400"><path d="m9 18 6-6-6-6"/></svg>
                <span class="text-[#1A305E] font-medium">Profil PPID</span>
            </div>
          
            {{-- Title --}}
            <div class="flex items-end justify-between">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold text-[#1A305E] mb-2">
                        Profil PPID
                    </h1>
                    <p class="text-gray-600">
                        Pejabat Pengelola Informasi dan Dokumentasi Provinsi Sulawesi Selatan
                    </p>
                </div>
                <div class="hidden md:block">
                    <div class="w-20 h-1 bg-gradient-to-r from-[#1A305E] to-transparent rounded-full"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content --}}
    <main class="py-10 md:py-16 bg-gray-50 font-['Plus_Jakarta_Sans']">
        <div class="container mx-auto px-4">
          
            {{-- Intro Section with Sidebar Layout --}}
            <div class="grid lg:grid-cols-3 gap-8 mb-12 max-w-6xl mx-auto">
            
                {{-- Main Content - 2 cols --}}
                <div class="lg:col-span-2 space-y-8">
              
                    {{-- Tentang PPID --}}
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 md:p-8">
                        <div class="flex items-start gap-4 mb-5">
                            <div class="w-12 h-12 bg-[#1A305E]/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 text-[#1A305E]"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/><line x1="16" x2="8" y1="13" y2="13"/><line x1="16" x2="8" y1="17" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-[#1A305E] mb-1">Tentang PPID Sulawesi Selatan</h2>
                                <div class="w-16 h-1 bg-[#1A305E] rounded-full"></div>
                            </div>
                        </div>
                
                        <div class="prose prose-gray max-w-none space-y-4 text-gray-700 leading-relaxed">
                            <p>
                                <strong>Pejabat Pengelola Informasi dan Dokumentasi (PPID)</strong> adalah pejabat yang bertanggung jawab dalam pengumpulan, pendokumentasian, penyimpanan, pemeliharaan, penyediaan, distribusi, dan pelayanan informasi di lingkungan Pemerintah Provinsi Sulawesi Selatan.
                            </p>
                            <p>
                                PPID Provinsi Sulawesi Selatan dibentuk berdasarkan <strong>Undang-Undang Nomor 14 Tahun 2008</strong> tentang Keterbukaan Informasi Publik dan <strong>Peraturan Gubernur</strong> tentang Pedoman Pengelolaan Informasi dan Dokumentasi.
                            </p>
                            <p>
                                Era informasi yang telah digunakan berbarengan yang lalu (1998), dan mendorong berbagai elemen masyarakat untuk menuntut hak dasar mereka dalam rangka mewujudkan kehidupan demokratis. Pada masyarakat modern, kebutuhan akan informasi menjadi salah satu penting.
                            </p>
                        </div>
                    </div>

                    {{-- Tugas dan Fungsi --}}
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 md:p-8">
                        <div class="flex items-start gap-4 mb-5">
                            <div class="w-12 h-12 bg-[#D4AF37]/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 text-[#D4AF37]"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-[#1A305E] mb-1">Tugas dan Fungsi PPID</h2>
                                <div class="w-16 h-1 bg-[#D4AF37] rounded-full"></div>
                            </div>
                        </div>
                
                        <div class="grid sm:grid-cols-2 gap-4">
                            <div class="bg-[#1A305E]/5 rounded-lg p-5 border border-[#1A305E]/10">
                                <h3 class="font-bold text-[#1A305E] mb-3 text-sm">Tugas Utama</h3>
                                <ul class="space-y-2 text-sm text-gray-700">
                                    <li class="flex gap-2">
                                        <span class="text-[#1A305E] mt-0.5">•</span>
                                        <span>Mengelola informasi dan dokumentasi</span>
                                    </li>
                                    <li class="flex gap-2">
                                        <span class="text-[#1A305E] mt-0.5">•</span>
                                        <span>Menyediakan layanan informasi publik</span>
                                    </li>
                                    <li class="flex gap-2">
                                        <span class="text-[#1A305E] mt-0.5">•</span>
                                        <span>Mengkoordinasikan PPID Pembantu</span>
                                    </li>
                                    <li class="flex gap-2">
                                        <span class="text-[#1A305E] mt-0.5">•</span>
                                        <span>Memfasilitasi akses informasi</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="bg-[#D4AF37]/5 rounded-lg p-5 border border-[#D4AF37]/10">
                                <h3 class="font-bold text-[#B08D26] mb-3 text-sm">Fungsi Pendukung</h3>
                                <ul class="space-y-2 text-sm text-gray-700">
                                    <li class="flex gap-2">
                                        <span class="text-[#D4AF37] mt-0.5">•</span>
                                        <span>Pengumpulan dan klasifikasi informasi</span>
                                    </li>
                                    <li class="flex gap-2">
                                        <span class="text-[#D4AF37] mt-0.5">•</span>
                                        <span>Penyimpanan dan pemeliharaan data</span>
                                    </li>
                                    <li class="flex gap-2">
                                        <span class="text-[#D4AF37] mt-0.5">•</span>
                                        <span>Distribusi informasi kepada publik</span>
                                    </li>
                                    <li class="flex gap-2">
                                        <span class="text-[#D4AF37] mt-0.5">•</span>
                                        <span>Evaluasi layanan informasi</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Sidebar - 1 col --}}
                <div class="space-y-6">
              
                    {{-- Feature Cards --}}
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h3 class="font-bold text-[#1A305E] mb-4 text-sm uppercase tracking-wide">Prinsip Layanan</h3>
                        <div class="space-y-4">
                            <div class="flex gap-3 items-start">
                                <div class="w-10 h-10 bg-[#1A305E]/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-[#1A305E]"><path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/><path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2"/><path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2"/><path d="M10 6h4"/><path d="M10 10h4"/><path d="M10 14h4"/><path d="M10 18h4"/></svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 text-sm mb-0.5">Transparansi</h4>
                                    <p class="text-xs text-gray-600">Keterbukaan informasi publik untuk masyarakat</p>
                                </div>
                            </div>
                            <div class="flex gap-3 items-start">
                                <div class="w-10 h-10 bg-[#4A5568]/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-[#4A5568]"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"/></svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 text-sm mb-0.5">Akuntabilitas</h4>
                                    <p class="text-xs text-gray-600">Pengelolaan informasi yang bertanggung jawab</p>
                                </div>
                            </div>
                            <div class="flex gap-3 items-start">
                                <div class="w-10 h-10 bg-[#D4AF37]/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-[#D4AF37]"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 text-sm mb-0.5">Profesional</h4>
                                    <p class="text-xs text-gray-600">Layanan prima untuk seluruh masyarakat</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Landasan Hukum --}}
                    <div class="bg-[#1A305E] text-white rounded-xl shadow-sm p-6">
                        <h3 class="font-bold mb-4 text-sm uppercase tracking-wide">Landasan Hukum</h3>
                        <div class="space-y-3 text-sm">
                            <div class="flex gap-2 items-start">
                                <div class="w-1.5 h-1.5 bg-[#D4AF37] rounded-full mt-2 flex-shrink-0"></div>
                                <p class="text-white/90">UU No. 14 Tahun 2008 tentang Keterbukaan Informasi Publik</p>
                            </div>
                            <div class="flex gap-2 items-start">
                                <div class="w-1.5 h-1.5 bg-[#D4AF37] rounded-full mt-2 flex-shrink-0"></div>
                                <p class="text-white/90">PP No. 61 Tahun 2010 tentang Pelaksanaan UU KIP</p>
                            </div>
                            <div class="flex gap-2 items-start">
                                <div class="w-1.5 h-1.5 bg-[#D4AF37] rounded-full mt-2 flex-shrink-0"></div>
                                <p class="text-white/90">Peraturan Komisi Informasi No. 1 Tahun 2010</p>
                            </div>
                            <div class="flex gap-2 items-start">
                                <div class="w-1.5 h-1.5 bg-[#D4AF37] rounded-full mt-2 flex-shrink-0"></div>
                                <p class="text-white/90">Peraturan Gubernur Sulawesi Selatan</p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </main>

    <x-footer />
</x-layout>
