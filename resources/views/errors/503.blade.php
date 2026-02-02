@extends('errors::layout')

@section('title', '503 - ' . (app()->getLocale() == 'id' ? 'Layanan Tidak Tersedia' : 'Service Unavailable'))

@section('content')
<div class="relative z-10 flex items-center justify-center min-h-[calc(100vh-12rem)] px-4 py-12">
    <div class="max-w-4xl w-full text-center">
        <!-- 3D Illustration -->
        <div class="mb-8 animate-float-slow">
            <img src="{{ asset('images/errors/503.png') }}" 
                 alt="503 Illustration" 
                 class="w-full max-w-md mx-auto drop-shadow-2xl">
        </div>
        
        <!-- Error Content -->
        <div class="space-y-6">
            <!-- Title -->
            <h1 class="text-5xl md:text-7xl font-bold text-white mb-4">
                503
            </h1>
            
            <!-- Subtitle -->
            <h2 class="text-2xl md:text-3xl font-semibold text-sky-200">
                @if(app()->getLocale() == 'id')
                    Layanan Tidak Tersedia
                @else
                    Service Unavailable
                @endif
            </h2>
            
            <!-- Description -->
            <p class="text-base md:text-lg text-slate-300 max-w-2xl mx-auto">
                @if(app()->getLocale() == 'id')
                    Situs sedang dalam pemeliharaan untuk meningkatkan layanan kami. Kami akan segera kembali. Terima kasih atas kesabaran Anda.
                @else
                    The site is under maintenance to improve our services. We'll be back soon. Thank you for your patience.
                @endif
            </p>
            
            <!-- Status Box -->
            <div class="max-w-xl mx-auto mt-6 p-6 bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl">
                <div class="flex items-center justify-center gap-3 mb-3">
                    <div class="w-3 h-3 bg-sky-400 rounded-full animate-pulse-glow"></div>
                    <p class="text-sm font-medium text-white">
                        @if(app()->getLocale() == 'id')
                            Status: Sedang Pemeliharaan
                        @else
                            Status: Under Maintenance
                        @endif
                    </p>
                </div>
                <p class="text-sm text-slate-200">
                    @if(app()->getLocale() == 'id')
                        Kami sedang melakukan peningkatan sistem untuk memberikan pengalaman yang lebih baik. Silakan kembali dalam beberapa saat.
                    @else
                        We're performing system upgrades to provide you with a better experience. Please check back in a few moments.
                    @endif
                </p>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mt-8">
                <button onclick="window.location.reload()" 
                        class="group px-8 py-4 bg-white hover:bg-sky-50 text-[#1e3a8a] font-semibold rounded-2xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                    <span class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        @if(app()->getLocale() == 'id')
                            Coba Lagi
                        @else
                            Try Again
                        @endif
                    </span>
                </button>
                
                <a href="https://twitter.com/pemprov_sulsel" 
                   target="_blank"
                   class="px-8 py-4 bg-transparent border-2 border-white/40 hover:border-white hover:bg-white/10 text-white font-semibold rounded-2xl backdrop-blur-md transform hover:-translate-y-1 transition-all duration-300">
                    <span class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"/>
                        </svg>
                        @if(app()->getLocale() == 'id')
                            Cek Update
                        @else
                            Check Updates
                        @endif
                    </span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
