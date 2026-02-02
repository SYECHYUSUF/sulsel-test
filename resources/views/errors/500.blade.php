@extends('errors::layout')

@section('title', '500 - ' . (app()->getLocale() == 'id' ? 'Kesalahan Server' : 'Server Error'))

@section('content')
<div class="relative z-10 flex items-center justify-center min-h-[calc(100vh-12rem)] px-4 py-12">
    <div class="max-w-4xl w-full text-center">
        <!-- 3D Illustration -->
        <div class="mb-8 animate-float">
            <img src="{{ asset('images/errors/500.png') }}" 
                 alt="500 Illustration" 
                 class="w-full max-w-md mx-auto drop-shadow-2xl">
        </div>
        
        <!-- Error Content -->
        <div class="space-y-6">
            <!-- Title -->
            <h1 class="text-5xl md:text-7xl font-bold text-white mb-4">
                500
            </h1>
            
            <!-- Subtitle -->
            <h2 class="text-2xl md:text-3xl font-semibold text-sky-200">
                @if(app()->getLocale() == 'id')
                    Kesalahan Server Internal
                @else
                    Internal Server Error
                @endif
            </h2>
            
            <!-- Description -->
            <p class="text-base md:text-lg text-slate-300 max-w-2xl mx-auto">
                @if(app()->getLocale() == 'id')
                    Maaf, terjadi kesalahan pada server kami. Tim teknis kami telah diberi tahu dan sedang bekerja untuk memperbaikinya. Silakan coba lagi nanti.
                @else
                    Sorry, something went wrong on our server. Our technical team has been notified and is working to fix it. Please try again later.
                @endif
            </p>
            
            <!-- Info Box -->
            <div class="max-w-xl mx-auto mt-6 p-6 bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl">
                <p class="text-sm text-slate-200">
                    @if(app()->getLocale() == 'id')
                        <strong>Saran:</strong> Tunggu beberapa saat dan muat ulang halaman. Jika masalah berlanjut, hubungi dukungan teknis kami.
                    @else
                        <strong>Suggestion:</strong> Wait a moment and reload the page. If the problem persists, contact our technical support.
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
                            Muat Ulang
                        @else
                            Reload Page
                        @endif
                    </span>
                </button>
                
                <a href="/" 
                   class="px-8 py-4 bg-transparent border-2 border-white/40 hover:border-white hover:bg-white/10 text-white font-semibold rounded-2xl backdrop-blur-md transform hover:-translate-y-1 transition-all duration-300">
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
            </div>
        </div>
    </div>
</div>
@endsection
