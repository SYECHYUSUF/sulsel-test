<section id="layanan" class="py-12 md:py-24 bg-white relative overflow-hidden font-['Plus_Jakarta_Sans']">
    {{-- Decorative Background - Diperkecil ukurannya di mobile agar tidak menutupi konten --}}
    <div class="absolute top-0 left-0 w-64 h-64 md:w-96 md:h-96 bg-violet-100 rounded-full blur-3xl opacity-30 -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-64 h-64 md:w-96 md:h-96 bg-purple-100 rounded-full blur-3xl opacity-30 translate-x-1/2 translate-y-1/2"></div>

    <div class="container mx-auto px-4 relative z-10">
        {{-- Section Header - Ukuran font adaptif --}}
        <div class="text-center mb-10 md:mb-16 max-w-3xl mx-auto">
            <div class="inline-flex items-center gap-2 mb-4 px-4 py-2 md:px-5 md:py-2.5 bg-violet-100 border border-violet-200 rounded-full">
                <div class="w-2 h-2 bg-violet-600 rounded-full"></div>
                <span class="text-violet-700 text-xs md:text-sm font-bold tracking-wide uppercase">Layanan Kami</span>
            </div>
            <h2 class="text-2xl sm:text-3xl md:text-5xl font-bold text-gray-900 mb-4 leading-tight">Layanan Informasi Publik</h2>
            <p class="text-base md:text-xl text-gray-600 leading-relaxed">Akses mudah untuk berbagai layanan informasi publik yang tersedia di PPID Provinsi Sulawesi Selatan</p>
        </div>

        {{-- Cards Grid - Adaptasi kolom: 1 (Mobile) -> 2 (Tablet) -> 3 (Desktop) --}}
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 max-w-7xl mx-auto">
            @php
                $services = [
                    ['title' => 'Informasi Publik', 'desc' => 'Akses berbagai informasi publik yang tersedia secara berkala, serta merta, dan setiap saat sesuai UU KIP', 'bg' => 'from-violet-100 to-purple-100', 'text' => 'text-violet-600', 'hover' => 'hover:shadow-violet-200'],
                    ['title' => 'Permohonan Informasi', 'desc' => 'Ajukan permohonan untuk mendapatkan informasi publik yang Anda butuhkan dengan proses yang mudah dan cepat', 'bg' => 'from-blue-100 to-cyan-100', 'text' => 'text-blue-600', 'hover' => 'hover:shadow-blue-200'],
                    ['title' => 'Keberatan', 'desc' => 'Sampaikan keberatan atas permohonan informasi yang ditolak atau tidak dilayani sesuai ketentuan yang berlaku', 'bg' => 'from-fuchsia-100 to-pink-100', 'text' => 'text-fuchsia-600', 'hover' => 'hover:shadow-fuchsia-200'],
                ];
            @endphp

            @foreach($services as $s)
            <div class="group bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100 hover:border-violet-200 {{ $s['hover'] }} hover:-translate-y-2 flex flex-col">
                <div class="p-6 md:p-8 flex-grow">
                    <div class="relative w-16 h-16 md:w-20 md:h-20 bg-gradient-to-br {{ $s['bg'] }} rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                        <div class="absolute inset-0 bg-gradient-to-br {{ $s['bg'] }} rounded-2xl translate-x-1 translate-y-1 -z-10 opacity-50"></div>
                        <div class="w-8 h-8 md:w-10 md:h-10 {{ $s['text'] }}">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-3 leading-tight">{{ $s['title'] }}</h3>
                    <p class="text-sm md:text-base text-gray-600 leading-relaxed mb-6">{{ $s['desc'] }}</p>
                    <button class="inline-flex items-center gap-2 text-violet-600 hover:text-violet-700 font-bold text-sm md:text-base group/link">
                        <span>Akses Layanan</span>
                        <svg class="w-4 h-4 md:w-5 md:h-5 group-hover/link:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </button>
                </div>
                <div class="h-2 bg-gradient-to-r {{ $s['bg'] }}"></div>
            </div>
            @endforeach
        </div>

        {{-- Bottom Banner - Penyesuaian Flex dan Padding --}}
        <div class="mt-12 md:mt-16 max-w-4xl mx-auto">
            <div class="bg-gradient-to-r from-violet-600 to-purple-600 rounded-3xl p-6 md:p-8 shadow-xl text-white text-center">
                <h4 class="text-xl md:text-2xl font-bold mb-3">Butuh Bantuan?</h4>
                <p class="text-base md:text-lg text-white/90 mb-6">Tim kami siap membantu Anda dengan senang hati</p>
                <div class="flex flex-col md:flex-row items-center justify-center gap-4 text-sm md:text-base">
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 bg-white rounded-full"></div>
                        <span class="font-semibold">Senin - Jumat:</span>
                        <span>08:00 - 16:00 WITA</span>
                    </div>
                    <div class="hidden md:block w-px h-6 bg-white/30"></div>
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 bg-white rounded-full"></div>
                        <span class="font-semibold">Telepon:</span>
                        <span>(0411) 123-4567</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>