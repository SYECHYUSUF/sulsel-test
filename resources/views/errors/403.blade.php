<x-errors-layout>
    <x-slot:title>{{ '403 - ' . (app()->getLocale() == 'id' ? 'Akses Ditolak' : 'Forbidden') }}</x-slot:title>

    <div class="relative z-10 flex items-center justify-center min-h-[calc(100vh-12rem)] px-4 py-12">
        <div class="max-w-4xl w-full text-center">
            <!-- 3D Illustration -->
            <div class="mb-8 animate-float-slow">
                <img src="{{ asset('images/errors/403.png') }}" 
                     alt="403 Illustration" 
                     class="w-full max-w-md mx-auto drop-shadow-2xl">
            </div>
            
            <!-- Error Content -->
            <div class="space-y-6">
                <!-- Title -->
                <h1 class="text-5xl md:text-7xl font-bold text-white mb-4">
                    403
                </h1>
                
                <!-- Subtitle -->
                <h2 class="text-2xl md:text-3xl font-semibold text-sky-200">
                    @if(app()->getLocale() == 'id')
                        Akses Ditolak
                    @else
                        Access Forbidden
                    @endif
                </h2>
                
                <!-- Description -->
                <p class="text-base md:text-lg text-slate-300 max-w-2xl mx-auto">
                    @if(app()->getLocale() == 'id')
                        Maaf, Anda tidak memiliki izin untuk mengakses halaman ini. Silakan hubungi administrator jika Anda merasa ini adalah kesalahan.
                    @else
                        Sorry, you don't have permission to access this page. Please contact the administrator if you believe this is an error.
                    @endif
                </p>
                
                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mt-8">
                    <a href="/" 
                       class="group px-8 py-4 bg-white dark:text-black hover:bg-sky-50 text-[#1e3a8a] font-semibold rounded-2xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                        <span class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            @if(app()->getLocale() == 'id')
                                Minta Akses
                            @else
                                Request Access
                            @endif
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-errors-layout>
