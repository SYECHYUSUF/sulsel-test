<x-errors-layout>
    <x-slot:title>{{ '404 - ' . (app()->getLocale() == 'id' ? 'Halaman Tidak Ditemukan' : 'Page Not Found') }}</x-slot:title>

    <div class="relative z-10 flex items-center justify-center min-h-[calc(100vh-12rem)] px-4 py-12">
        <div class="max-w-4xl w-full text-center">
            <!-- 3D Illustration -->
            <div class="mb-4 animate-float">
                <img src="{{ asset('images/errors/404.png') }}" alt="404 Illustration"
                    class="w-full max-w-md mx-auto drop-shadow-2xl">
            </div>

            <!-- Error Content -->
            <div class="space-y-6">
                <!-- Title -->
                <h1 class="text-5xl md:text-7xl font-bold text-white mb-4">
                    @if(app()->getLocale() == 'id')
                        Oops!
                    @else
                        Oops!
                    @endif
                </h1>

                <!-- Subtitle -->
                <h2 class="text-2xl md:text-3xl font-semibold text-sky-200">
                    @if(app()->getLocale() == 'id')
                        Halaman Tidak Ditemukan
                    @else
                        Page Not Found
                    @endif
                </h2>

                <!-- Description -->
                <p class="text-base md:text-lg text-slate-300 max-w-2xl mx-auto">
                    @if(app()->getLocale() == 'id')
                        Halaman yang Anda cari mungkin telah dipindahkan, dihapus, atau tidak pernah ada.
                    @else
                        The page you are looking for might have been moved, removed, or never existed.
                    @endif
                </p>

                <!-- Search Box -->
                <div class="max-w-xl mx-auto mt-8">
                    <form action="/berita" method="GET" class="relative">
                        <input type="text" name="search"
                            placeholder="{{ app()->getLocale() == 'id' ? 'Cari berita...' : 'Search news...' }}"
                            class="w-full px-6 py-4 pr-14 rounded-2xl bg-white/10 backdrop-blur-md border-2 border-white/20 text-white placeholder-slate-300 focus:outline-none focus:border-sky-400 focus:ring-4 focus:ring-sky-400/30 transition-all">
                        <button type="submit"
                            class="absolute right-2 top-1/2 -translate-y-1/2 p-3 bg-sky-500 hover:bg-sky-600 rounded-xl transition-colors">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </form>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mt-8">
                    <a href="/"
                        class="group px-8 py-4 bg-white dark:text-black hover:bg-sky-50 text-[#1e3a8a] font-semibold rounded-2xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                        <span class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            @if(app()->getLocale() == 'id')
                                Kembali ke Beranda
                            @else
                                Back to Home
                            @endif
                        </span>
                    </a>

                    <a href="/contact"
                        class="px-8 py-4 bg-transparent border-2 border-white/40 hover:border-white hover:bg-white/10 text-white font-semibold rounded-2xl backdrop-blur-md transform hover:-translate-y-1 transition-all duration-300">
                        <span class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            @if(app()->getLocale() == 'id')
                                Hubungi Kami
                            @else
                                Contact Us
                            @endif
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-errors-layout>