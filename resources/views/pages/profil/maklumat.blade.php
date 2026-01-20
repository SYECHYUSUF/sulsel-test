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
                <span class="text-[#1A305E] font-medium">Maklumat</span>
            </div>
          
            {{-- Title --}}
            <div class="flex items-end justify-between">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold text-[#1A305E] mb-2">
                        Maklumat
                    </h1>
                    <p class="text-gray-600">
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
    <main class="py-10 md:py-16 bg-gray-50 font-['Plus_Jakarta_Sans']">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto space-y-8">
            
                {{-- Maklumat Document --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="border-b border-gray-200 px-6 py-4 flex items-center justify-between bg-gray-50">
                        <h2 class="font-bold text-gray-900">Maklumat Pelayanan Informasi Publik</h2>
                        <button class="flex items-center gap-2 text-[#1A305E] hover:text-[#D4AF37] text-sm font-medium transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>
                            Download
                        </button>
                    </div>
              
                    <div class="p-6">
                        <div class="rounded-lg overflow-hidden border border-gray-200">
                            {{-- Image detected in public/images/ --}}
                            <img
                                src="{{ asset('images/20230918134717_Maklumat pelayanan informasi publik.png') }}"
                                alt="Maklumat Pelayanan Informasi Publik PPID Sulawesi Selatan"
                                class="w-full h-auto"
                            />
                        </div>
                        <p class="text-sm text-gray-600 text-center mt-4">
                            Maklumat Pelayanan Informasi Publik - PPID Provinsi Sulawesi Selatan
                        </p>
                    </div>
                </div>

                {{-- Info Cards --}}
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <h3 class="font-bold text-gray-900 mb-4">Komitmen PPID</h3>
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
