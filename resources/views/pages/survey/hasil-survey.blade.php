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
                <span class="text-[#1A305E] font-medium">Survey</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-gray-400"><path d="m9 18 6-6-6-6"/></svg>
                <span class="text-[#1A305E] font-medium">Hasil Survey</span>
            </div>
          
            {{-- Title --}}
            <div class="flex items-end justify-between">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold text-[#1A305E] mb-2">
                        Hasil Survey
                    </h1>
                    <p class="text-gray-600">
                        Indeks Kepuasan Masyarakat (IKM)
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
            <div class="max-w-7xl mx-auto space-y-12">
            
                <div class="grid md:grid-cols-2 gap-8 items-center">
                    <div>
                        <h2 class="text-2xl font-bold text-[#1A305E] mb-4">Indeks Kepuasan Masyarakat</h2>
                        <p class="text-gray-600 leading-relaxed mb-6">
                            Hasil survei kepuasan masyarakat terhadap pelayanan informasi publik di lingkungan Pemerintah Provinsi Sulawesi Selatan menunjukkan kategori <strong>SANGAT BAIK</strong>. Kami terus berkomitmen untuk meningkatkan kualitas pelayanan publik.
                        </p>
                        
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <div class="flex items-end gap-2 mb-2">
                                <span class="text-5xl font-bold text-[#D4AF37]">88.5</span>
                                <span class="text-gray-500 mb-2">/ 100</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5 mb-2">
                                <div class="bg-[#1A305E] h-2.5 rounded-full" style="width: 88.5%"></div>
                            </div>
                            <p class="text-sm font-medium text-[#1A305E]">Kategori: SANGAT BAIK</p>
                        </div>
                    </div>
                    <div>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 text-center">
                                <h3 class="text-4xl font-bold text-[#1A305E] mb-1">1,240</h3>
                                <p class="text-sm text-gray-500">Responden</p>
                            </div>
                            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 text-center">
                                <h3 class="text-4xl font-bold text-[#1A305E] mb-1">92%</h3>
                                <p class="text-sm text-gray-500">Tingkat Penyelesaian</p>
                            </div>
                            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 text-center">
                                <h3 class="text-4xl font-bold text-[#1A305E] mb-1">4.8</h3>
                                <p class="text-sm text-gray-500">Rating Rata-rata</p>
                            </div>
                             <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 text-center">
                                <h3 class="text-4xl font-bold text-[#1A305E] mb-1">24h</h3>
                                <p class="text-sm text-gray-500">Waktu Respon</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                     <div class="border-b border-gray-200 px-6 py-4">
                        <h3 class="font-bold text-[#1A305E]">Laporan Hasil Survey Tahunan</h3>
                    </div>
                    <div class="p-6">
                        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                             {{-- Report Card 2024 --}}
                            <div class="border border-gray-200 rounded-xl p-5 hover:shadow-md transition-shadow">
                                <div class="flex items-start justify-between mb-4">
                                     <div class="bg-blue-50 p-3 rounded-lg text-[#1A305E]">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/><path d="M16 13H8"/><path d="M16 17H8"/><path d="M10 9H8"/></svg>
                                    </div>
                                    <span class="bg-[#D4AF37]/10 text-[#D4AF37] text-xs font-bold px-2 py-1 rounded">2024</span>
                                </div>
                                <h4 class="font-bold text-gray-900 mb-1">Laporan IKM 2024</h4>
                                <p class="text-sm text-gray-500 mb-4">Laporan Indeks Kepuasan Masyarakat Semester I Tahun 2024.</p>
                                <button class="text-sm font-medium text-[#1A305E] hover:underline flex items-center gap-1">
                                    Download PDF
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 17l9.2-9.2M17 17V7H7"/></svg>
                                </button>
                            </div>

                             {{-- Report Card 2023 --}}
                            <div class="border border-gray-200 rounded-xl p-5 hover:shadow-md transition-shadow">
                                <div class="flex items-start justify-between mb-4">
                                     <div class="bg-blue-50 p-3 rounded-lg text-[#1A305E]">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/><path d="M16 13H8"/><path d="M16 17H8"/><path d="M10 9H8"/></svg>
                                    </div>
                                    <span class="bg-gray-100 text-gray-600 text-xs font-bold px-2 py-1 rounded">2023</span>
                                </div>
                                <h4 class="font-bold text-gray-900 mb-1">Laporan IKM 2023</h4>
                                <p class="text-sm text-gray-500 mb-4">Laporan Indeks Kepuasan Masyarakat Tahun 2023 Lengkap.</p>
                                <button class="text-sm font-medium text-[#1A305E] hover:underline flex items-center gap-1">
                                    Download PDF
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 17l9.2-9.2M17 17V7H7"/></svg>
                                </button>
                            </div>

                             {{-- Report Card 2022 --}}
                            <div class="border border-gray-200 rounded-xl p-5 hover:shadow-md transition-shadow">
                                <div class="flex items-start justify-between mb-4">
                                     <div class="bg-blue-50 p-3 rounded-lg text-[#1A305E]">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/><path d="M16 13H8"/><path d="M16 17H8"/><path d="M10 9H8"/></svg>
                                    </div>
                                    <span class="bg-gray-100 text-gray-600 text-xs font-bold px-2 py-1 rounded">2022</span>
                                </div>
                                <h4 class="font-bold text-gray-900 mb-1">Laporan IKM 2022</h4>
                                <p class="text-sm text-gray-500 mb-4">Laporan Indeks Kepuasan Masyarakat Tahun 2022 Lengkap.</p>
                                <button class="text-sm font-medium text-[#1A305E] hover:underline flex items-center gap-1">
                                    Download PDF
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 17l9.2-9.2M17 17V7H7"/></svg>
                                </button>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <x-footer />
</x-layout>
