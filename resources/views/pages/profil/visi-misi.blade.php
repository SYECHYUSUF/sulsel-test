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
                <span class="text-[#1A305E] font-medium">Visi Misi</span>
            </div>
          
            {{-- Title --}}
            <div class="flex items-end justify-between">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold text-[#1A305E] mb-2">
                        Visi Misi
                    </h1>
                    <p class="text-gray-600">
                        Visi dan Misi PPID Provinsi Sulawesi Selatan
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
            <div class="max-w-4xl mx-auto space-y-8">
            
                {{-- VISI --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-[#1A305E] px-6 py-4">
                        <div class="flex items-center gap-3 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                            <h2 class="font-bold text-lg">Visi PPID Sulawesi Selatan</h2>
                        </div>
                    </div>
              
                    <div class="p-6 md:p-10">
                        <div class="bg-[#1A305E]/5 border-l-4 border-[#1A305E] rounded-r-lg p-6 md:p-8">
                            <p class="text-lg md:text-xl text-gray-900 leading-relaxed font-medium text-center">
                                "Terwujudnya pelayanan informasi yang transparan dan akuntabel untuk memenuhi hak setiap orang informasi dengan keterbukaan peraturan perundang-undangan yang berlaku"
                            </p>
                        </div>
                    </div>
                </div>

                {{-- MISI --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-[#D4AF37] px-6 py-4">
                        <div class="flex items-center gap-3 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>
                            <h2 class="font-bold text-lg">Misi PPID Sulawesi Selatan</h2>
                        </div>
                    </div>
              
                    <div class="p-6 md:p-10">
                        <p class="text-gray-700 mb-6">
                            Untuk mewujudkan visi tersebut, PPID Sulawesi Selatan memiliki 3 misi utama:
                        </p>

                        <div class="space-y-4">
                            @php
                                $misiList = [
                                    'Meningkatkan Pengelolaan Informasi - Mengelola pengumpulan dan penyebarluasan informasi yang berkualitas dan profesional',
                                    'Meningkatkan Kompetensi SDM - Meningkatkan kompetensi sumber daya manusia dalam bidang Pelayanan Informasi',
                                    'Forum Koordinasi PPID - Membentukan Forum Koordinasi PPID tingkat Pemprov Sulsel yang solid'
                                ];
                            @endphp
                            @foreach ($misiList as $index => $misi)
                                <div class="flex gap-4 items-start p-5 bg-gray-50 rounded-lg border border-gray-200 hover:border-[#1A305E]/20 hover:bg-[#1A305E]/5 transition-all">
                                    <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-[#1A305E] to-[#D4AF37] rounded-lg flex items-center justify-center text-white font-bold shadow-sm">
                                        {{ $index + 1 }}
                                    </div>
                                    <p class="text-gray-700 leading-relaxed flex-1 pt-1.5">
                                        {{ $misi }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Komitmen --}}
                <div class="bg-gradient-to-br from-[#1A305E] to-[#4A5568] rounded-xl p-8 text-white text-center">
                    <h3 class="text-xl font-bold mb-3">Komitmen Kami</h3>
                    <p class="text-white/90 leading-relaxed">
                        Dengan visi dan misi yang jelas, PPID Sulawesi Selatan berkomitmen untuk terus meningkatkan kualitas pelayanan informasi publik demi terwujudnya pemerintahan yang transparan, akuntabel, dan berintegritas.
                    </p>
                </div>

            </div>
        </div>
    </main>
    <x-footer />
</x-layout>
