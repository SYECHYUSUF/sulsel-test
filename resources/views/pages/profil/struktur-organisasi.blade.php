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
                <span class="text-[#1A305E] font-medium">Struktur Organisasi</span>
            </div>
          
            {{-- Title --}}
            <div class="flex items-end justify-between">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold text-[#1A305E] mb-2">
                        Struktur Organisasi
                    </h1>
                    <p class="text-gray-600">
                        Bagan Struktur PPID Provinsi Sulawesi Selatan
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
            <div class="max-w-6xl mx-auto">
            
                {{-- Hierarchy Info --}}
                <div class="grid md:grid-cols-3 gap-6 mb-10">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5">
                        <div class="text-xs uppercase tracking-wide text-gray-500 mb-2">Penanggung Jawab</div>
                        <p class="font-bold text-gray-900">Gubernur Sulawesi Selatan</p>
                    </div>
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5">
                        <div class="text-xs uppercase tracking-wide text-gray-500 mb-2">Atasan PPID</div>
                        <p class="font-bold text-gray-900">Sekretaris Daerah Provinsi</p>
                    </div>
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5">
                        <div class="text-xs uppercase tracking-wide text-gray-500 mb-2">PPID Utama</div>
                        <p class="font-bold text-gray-900">Kepala Dinas Kominfo</p>
                    </div>
                </div>

                {{-- Struktur Image --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-8">
                    <div class="border-b border-gray-200 px-6 py-4 flex items-center justify-between bg-gray-50">
                        <h2 class="font-bold text-gray-900">Bagan Struktur Organisasi PPID</h2>
                        <button class="flex items-center gap-2 text-[#1A305E] hover:text-[#D4AF37] text-sm font-medium transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>
                            Download
                        </button>
                    </div>
              
                    <div class="p-6">
                        <div class="rounded-lg overflow-hidden border border-gray-200">
                             {{-- Placeholder Image --}}
                            <img
                                src="https://placehold.co/1200x800/EEE/31343C?text=Bagan+Struktur+Organisasi+PPID"
                                alt="Struktur Organisasi PPID Sulawesi Selatan"
                                class="w-full h-auto"
                            />
                        </div>
                    </div>
                </div>

                {{-- Info Grid --}}
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-[#1A305E]/10 rounded-lg flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-[#1A305E]"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
                            </div>
                            <h3 class="font-bold text-gray-900">Komponen PPID</h3>
                        </div>
                        <div class="space-y-3 text-sm text-gray-700">
                            <div class="flex gap-3">
                                <span class="text-[#1A305E] mt-1">•</span>
                                <div>
                                    <strong class="text-gray-900">PPID Utama:</strong> Bertanggung jawab atas pengelolaan informasi di tingkat provinsi
                                </div>
                            </div>
                            <div class="flex gap-3">
                                <span class="text-[#1A305E] mt-1">•</span>
                                <div>
                                    <strong class="text-gray-900">PPID Pembantu:</strong> Mengelola informasi di setiap SKPD lingkup Pemprov Sulsel
                                </div>
                            </div>
                            <div class="flex gap-3">
                                <span class="text-[#1A305E] mt-1">•</span>
                                <div>
                                    <strong class="text-gray-900">PPID Pelaksana:</strong> Melaksanakan tugas teknis pelayanan informasi
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-[#1A305E]/5 border border-[#1A305E]/10 rounded-lg p-6">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-[#1A305E] rounded-lg flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-white"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
                            </div>
                            <h3 class="font-bold text-[#1A305E]">Koordinasi & Supervisi</h3>
                        </div>
                        <p class="text-sm text-gray-700 mb-3">
                            PPID Utama melakukan koordinasi dan supervisi terhadap PPID Pembantu di seluruh SKPD untuk memastikan:
                        </p>
                        <div class="space-y-2 text-sm text-gray-700">
                            <div class="flex gap-2">
                                <span class="text-[#1A305E]">•</span>
                                <span>Standarisasi pengelolaan informasi</span>
                            </div>
                            <div class="flex gap-2">
                                <span class="text-[#1A305E]">•</span>
                                <span>Kualitas layanan yang konsisten</span>
                            </div>
                            <div class="flex gap-2">
                                <span class="text-[#1A305E]">•</span>
                                <span>Kepatuhan terhadap regulasi KIP</span>
                            </div>
                            <div class="flex gap-2">
                                <span class="text-[#1A305E]">•</span>
                                <span>Peningkatan kapasitas SDM</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
    <x-footer />
</x-layout>
