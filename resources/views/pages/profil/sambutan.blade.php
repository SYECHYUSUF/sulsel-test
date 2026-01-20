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
                <span class="text-[#1A305E] font-medium">Sambutan</span>
            </div>
          
            {{-- Title --}}
            <div class="flex items-end justify-between">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold text-[#1A305E] mb-2">
                        Sambutan
                    </h1>
                    <p class="text-gray-600">
                        Kata Sambutan Kepala PPID Provinsi Sulawesi Selatan
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
            <div class="max-w-4xl mx-auto">
            
                {{-- Opening Quote --}}
                <div class="bg-[#1A305E] rounded-xl p-8 md:p-10 mb-8 text-white relative overflow-hidden">
                    <div class="absolute -right-6 -top-6 text-white/10 text-[120px] leading-none font-serif">"</div>
                    <div class="relative">
                        <p class="text-lg md:text-xl leading-relaxed mb-4 italic">
                            Transparansi adalah kunci untuk membangun kepercayaan publik dan mewujudkan tata kelola pemerintahan yang baik
                        </p>
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-0.5 bg-white/50"></div>
                            <span class="text-sm text-white/90">Komitmen PPID Sulawesi Selatan</span>
                        </div>
                    </div>
                </div>

                {{-- Main Content --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 md:p-10">
              
                    {{-- Greeting --}}
                    <div class="mb-8 pb-6 border-b border-gray-200">
                        <p class="text-lg text-gray-900 font-medium mb-2">
                            Assalamu'alaikum Warahmatullahi Wabarakatuh,
                        </p>
                        <p class="text-gray-700">
                            Salam Sejahtera untuk kita semua,
                        </p>
                    </div>

                    {{-- Content --}}
                    <div class="prose prose-gray max-w-none space-y-5 text-gray-700 leading-relaxed text-justify">
                        <p>
                            Era informasi yang telah digunakan bersamaan yang lalu (1998), dan mendorong berbagai elemen masyarakat untuk menuntut hak dasar mereka dalam rangka mewujudkan kehidupan demokratis. Pada masyarakat modern, kebutuhan akan informasi menjadi salah satu penting. Penyeberasan informasi mendorong kebebasan akan informasi semenjak mereka tidaklah sejalan dengan kondisi dan konstitusi yang ada.
                        </p>

                        <p>
                            Lahirnya Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik (UU KIP) memberikan mandat kepada pelaksanaan pemerintahan yang transparan dan akuntabel untuk memenuhi hak setiap orang dalam memperoleh informasi sesuai dengan ketentuan peraturan perundang-undangan yang berlaku.
                        </p>

                        <p>
                            Dalam rangka mendukung proses penyajian dan pelayanan informasi untuk publik, maka Pejabat Pengelola Informasi dan Dokumentasi (PPID) merupakan pihom yang ditunjuk langsung sesuai dengan kemampuan khusus dan kapasitas dalam memberikan berbagai informasi yang dibutuhkan oleh masyarakat.
                        </p>

                        {{-- Highlight Box --}}
                        <div class="bg-[#1A305E]/5 border-l-4 border-[#1A305E] rounded-r-lg p-5 my-6 not-prose">
                            <h3 className="font-bold text-[#1A305E] mb-3 text-sm uppercase tracking-wide">Prinsip Layanan PPID</h3>
                            <div class="grid sm:grid-cols-2 gap-3 text-sm text-gray-700">
                                <div>
                                    <strong class="text-[#1A305E] block mb-1">Terbuka dan Mudah Diakses</strong>
                                    <p class="text-xs">Informasi tersedia untuk semua kalangan</p>
                                </div>
                                <div>
                                    <strong class="text-[#1A305E] block mb-1">Akurat dan Akuntabel</strong>
                                    <p class="text-xs">Informasi benar dan dapat dipertanggungjawabkan</p>
                                </div>
                                <div>
                                    <strong class="text-[#1A305E] block mb-1">Cepat dan Tepat Waktu</strong>
                                    <p class="text-xs">Pelayanan sesuai standar waktu</p>
                                </div>
                                <div>
                                    <strong class="text-[#1A305E] block mb-1">Profesional</strong>
                                    <p class="text-xs">Pengelolaan dengan standar profesional</p>
                                </div>
                            </div>
                        </div>

                        <p>
                            Masyarakat merupakan hak yang dijamin oleh undang-undang. Era good governance menuntut bahwa setiap pelaksana public sebagai bentuk kepatuhan pemerintah akan lingkungan berbeda dari pemangku kepentingan pihak third good dan publik.
                        </p>

                        <p>
                            Semoga dengan adanya Portal PPID ini, masyarakat dapat dengan mudah mengakses berbagai informasi yang diperlukan dan turut serta dalam pengawasan penyelenggaraan pemerintahan. Kritik dan saran yang membangun sangat kami harapkan demi peningkatan kualitas layanan kami.
                        </p>
                    </div>

                    {{-- Closing --}}
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <p class="text-gray-900 font-medium mb-6">
                            Wassalamu'alaikum Warahmatullahi Wabarakatuh
                        </p>
                
                        <div class="flex items-start gap-4">
                            <div class="w-1 h-20 bg-[#D4AF37] rounded-full"></div>
                            <div>
                                <p class="font-bold text-gray-900 text-lg">Kepala PPID</p>
                                <p class="text-gray-600 text-sm">Provinsi Sulawesi Selatan</p>
                                <p class="text-gray-500 text-xs mt-1">Pejabat Pengelola Informasi dan Dokumentasi</p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </main>

    <x-footer />
</x-layout>
