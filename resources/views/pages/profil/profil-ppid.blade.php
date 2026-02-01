<x-layout>
    <x-header />

    {{-- Breadcrumb + Title Section --}}
    <div class="bg-white dark:bg-slate-800 border-b border-gray-200 dark:border-slate-700 font-['Plus_Jakarta_Sans']">
        <div class="container mx-auto px-4 py-6">
            {{-- Breadcrumb --}}
            <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300 mb-4">
                <a href="/" class="hover:text-[#1A305E] dark:text-white transition-colors">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                        </path>
                    </svg>
                </a>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <a href="#"
                    class="hover:text-[#1A305E] dark:text-white transition-colors">{{ __('messages.breadcrumb.profile') }}</a>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-[#1A305E] dark:text-white font-medium">{{ __('messages.profile.ppid_title') }}</span>
            </div>

            {{-- Title --}}
            <div class="w-20 h-1 bg-gradient-to-r from-[#1A305E] to-transparent rounded-full"></div>
        </div>
    </div>
    </div>
    </div>

    {{-- Main Content --}}
    <main class="py-10 md:py-16 bg-gray-50 dark:bg-slate-900 font-['Plus_Jakarta_Sans']">
        <div class="container mx-auto px-4">

            {{-- Intro Section with Sidebar Layout --}}
            <div class="grid lg:grid-cols-2 gap-8 mb-12 max-w-6xl mx-auto">

                {{-- Dynamic Content --}}
                <div
                    class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-200 dark:border-slate-700 p-6 md:p-8">
                    <div class="prose prose-slate max-w-none dark:prose-invert">
                        {!! $profil->deskripsi ?? 'Konten belum tersedia.' !!}
                    </div>
                </div>

                {{-- Sidebar - 1 col --}}
                <div class="space-y-6">

                    {{-- Feature Cards --}}
                    <div
                        class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-200 dark:border-slate-700 p-6">
                        <h3 class="font-bold text-[#1A305E] dark:text-white mb-4 text-sm uppercase tracking-wide">
                            Prinsip Layanan</h3>
                        <div class="space-y-4">
                            <div class="flex gap-3 items-start">
                                <div
                                    class="w-10 h-10 bg-[#1A305E]/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="w-5 h-5 text-[#1A305E] dark:text-white">
                                        <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z" />
                                        <path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2" />
                                        <path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2" />
                                        <path d="M10 6h4" />
                                        <path d="M10 10h4" />
                                        <path d="M10 14h4" />
                                        <path d="M10 18h4" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 dark:text-white text-sm mb-0.5">Transparansi
                                    </h4>
                                    <p class="text-xs text-gray-600 dark:text-gray-300">Keterbukaan informasi publik
                                        untuk masyarakat</p>
                                </div>
                            </div>
                            <div class="flex gap-3 items-start">
                                <div
                                    class="w-10 h-10 bg-[#4A5568]/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="w-5 h-5 text-[#4A5568]">
                                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 dark:text-white text-sm mb-0.5">Akuntabilitas
                                    </h4>
                                    <p class="text-xs text-gray-600 dark:text-gray-300">Pengelolaan informasi yang
                                        bertanggung jawab</p>
                                </div>
                            </div>
                            <div class="flex gap-3 items-start">
                                <div
                                    class="w-10 h-10 bg-[#D4AF37]/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="w-5 h-5 text-[#D4AF37]">
                                        <circle cx="12" cy="8" r="7" />
                                        <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 dark:text-white text-sm mb-0.5">Profesional
                                    </h4>
                                    <p class="text-xs text-gray-600 dark:text-gray-300">Layanan prima untuk seluruh
                                        masyarakat</p>
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