@extends('layouts.app')

@section('title', 'Login - PPID Sulsel')

@section('content')
<!-- Background container with image and gradient overlay -->
<div class="min-h-screen relative flex items-center justify-center p-4 lg:p-0 font-sans">
    
    <!-- Background Image (Kantor Gubernur) with Low Opacity -->
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('images/kantor.jpeg') }}" alt="Kantor Gubernur" class="w-full h-full object-cover object-center opacity-30">
        <!-- Navy Gradient Overlay -->
        <div class="absolute inset-0 bg-linear-to-br from-[#1A305E]/95 via-[#1A305E]/85 to-[#122143]/95 mix-blend-multiply"></div>
        <!-- Additional Subtle Pattern for Texture -->
        <div class="absolute inset-0 opacity-5 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUpIi8+PC9zdmc+')]"></div>
    </div>

    <!-- Main Card Container: Glassmorphism + Firm Borders -->
    <div class="relative z-10 w-full max-w-[1100px] h-auto lg:h-[650px] bg-white rounded-3xl shadow-2xl border border-white/40 overflow-hidden flex flex-col lg:flex-row shadow-[0_20px_60px_-15px_rgba(0,0,0,0.5)] animate-slide-up">
        
        <!-- Left Side: Branding & Info (Hidden on small mobile, visible on large) -->
        <!-- Added better mobile handling: Hidden on base, flex on lg -->
        <div class="hidden lg:flex lg:w-5/12 bg-linear-to-b from-[#1A305E] to-[#0f172a] p-12 flex-col justify-between items-center text-center relative overflow-hidden group border-r border-white/10">
            
            <!-- Decorative Circles -->
            <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
                <div class="absolute -top-24 -left-24 w-64 h-64 bg-white/5 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-24 -right-24 w-80 h-80 bg-[#D4AF37]/10 rounded-full blur-3xl"></div>
            </div>

            <div class="relative z-10 w-full text-left">
                <a href="{{ url('/') }}" class="inline-flex items-center text-white/90 hover:text-white transition-all gap-2 group-hover:-translate-x-1 duration-300 font-medium">
                    <div class="p-1.5 bg-white/10 rounded-lg backdrop-blur-sm border border-white/20 group-hover:bg-white/20 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                    </div>
                    <span>Kembali ke Beranda</span>
                </a>
            </div>

            <div class="relative z-10 flex flex-col items-center mt-8">
                <!-- PPID LOGO -->
                <div class="relative w-40 h-auto mb-6 transform transition-transform duration-500 hover:scale-105 drop-shadow-2xl">
                    <img src="{{ asset('images/logo-ppid.png') }}" alt="Logo PPID Sulsel" class="w-full h-auto object-contain drop-shadow-lg">
                </div>
                
                <h2 class="text-3xl font-bold text-white mb-2 tracking-tight leading-tight">PPID Utama<br><span class="text-[#D4AF37]">Sulawesi Selatan</span></h2>
                <div class="h-1 w-20 bg-[#D4AF37] rounded-full my-4"></div>
                <p class="text-blue-50 text-sm font-light leading-relaxed max-w-[80%] mx-auto opacity-90">
                    Transparansi untuk Partisipasi. Akses informasi publik dengan mudah, cepat, dan akurat.
                </p>
            </div>

            <div class="relative z-10 w-full mt-auto">
                {{-- <div class="bg-white/5 backdrop-blur-md rounded-2xl p-4 border border-white/10 shadow-inner">
                   <p class="text-xs text-white/60 italic font-medium">"Sipakatau, Sipakalebbi, Sipakainge"</p>
                </div> --}}
                 <div class="flex items-center justify-center gap-2 opacity-60">
                     <span class="w-2 h-2 rounded-full bg-[#D4AF37]"></span>
                     <p class="text-[10px] text-white tracking-widest uppercase">Official Portal</p>
                     <span class="w-2 h-2 rounded-full bg-[#D4AF37]"></span>
                 </div>
            </div>
        </div>

        <!-- Right Side: Login Form -->
        <div class="w-full lg:w-7/12 bg-white relative flex flex-col justify-center h-full">
            <!-- Mobile Header with Logo (Visible only on mobile) -->
            <div class="lg:hidden absolute top-0 left-0 w-full p-6 flex justify-between items-start bg-linear-to-b from-gray-50 to-white border-b border-gray-100/50">
                 <img src="{{ asset('images/logo-ppid.png') }}" alt="Logo" class="h-12 w-auto">
                 <a href="{{ url('/') }}" class="p-2 bg-gray-100 rounded-full text-gray-600 hover:bg-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                </a>
            </div>

            <div class="p-8 md:p-14 lg:p-16 w-full max-w-lg mx-auto flex flex-col justify-center h-full lg:mt-0 ">
                <div class="mb-8 lg:mb-10 text-center lg:text-left">
                    <h1 class="text-3xl md:text-4xl font-extrabold text-[#1A305E] mb-3 tracking-tight">Selamat Datang</h1>
                    <p class="text-gray-500 font-medium text-lg">Silakan masuk untuk melanjutkan.</p>
                </div>

                <form action="{{ route('login') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <!-- Username -->
                    <div class="space-y-2">
                        <label for="username" class="block text-sm font-bold text-[#1A305E] uppercase tracking-wider ml-1">Username</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400 group-focus-within:text-[#1A305E] transition-colors" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" name="username" id="username" 
                                class="block w-full pl-11 pr-4 py-4 border-2 border-gray-200 rounded-xl bg-gray-50/50 text-gray-900 placeholder-gray-400 focus:outline-none focus:bg-white focus:border-[#1A305E] focus:ring-4 focus:ring-[#1A305E]/10 transition-all duration-200 ease-out font-medium" 
                                placeholder="Masukkan username Anda" required autofocus>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="space-y-2">
                        <label for="password" class="block text-sm font-bold text-[#1A305E] uppercase tracking-wider ml-1">Password</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400 group-focus-within:text-[#1A305E] transition-colors" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="password" name="password" id="password" 
                                class="block w-full pl-11 pr-12 py-4 border-2 border-gray-200 rounded-xl bg-gray-50/50 text-gray-900 placeholder-gray-400 focus:outline-none focus:bg-white focus:border-[#1A305E] focus:ring-4 focus:ring-[#1A305E]/10 transition-all duration-200 ease-out font-medium" 
                                placeholder="Masukkan password Anda" required>
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center cursor-pointer">
                                <svg class="h-6 w-6 text-gray-400 hover:text-[#1A305E] transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Simplified Captcha for "Elegant" look -->
                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-[#1A305E] uppercase tracking-wider ml-1">Keamanan</label>
                        <div class="flex gap-3">
                            <div class="w-5/12 bg-linear-to-r from-gray-100 to-gray-200 rounded-xl flex items-center justify-between px-4 py-3 border border-gray-300 select-none shadow-inner">
                                <span class="text-xl font-mono font-black text-gray-700 tracking-[0.2em] italic" id="captcha-code">E4Y7L</span>
                                <button type="button" class="text-gray-500 hover:text-[#1A305E] p-1 rounded-full hover:bg-gray-200 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12a9 9 0 0 0-9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/><path d="M3 12a9 9 0 0 0 9 9 9.75 9.75 0 0 0 6.74-2.74L21 16"/><path d="M16 16l5 5v-5"/></svg>
                                </button>
                            </div>
                            <input type="text" 
                                class="w-7/12 px-4 py-3 border-2 border-gray-200 rounded-xl bg-gray-50/50 placeholder-gray-400 focus:outline-none focus:bg-white focus:border-[#1A305E] focus:ring-4 focus:ring-[#1A305E]/10 transition-all font-medium" 
                                placeholder="Kode Captcha">
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-2">
                        <label class="flex items-center cursor-pointer group">
                            <input id="remember" name="remember" type="checkbox" class="w-5 h-5 text-[#1A305E] bg-gray-100 border-gray-300 rounded focus:ring-[#1A305E] focus:ring-2 transition duration-150 ease-in-out">
                            <span class="ml-3 block text-sm text-gray-600 font-medium group-hover:text-[#1A305E] transition-colors">Ingat Saya</span>
                        </label>
                        <a href="#" class="text-sm font-bold text-[#1A305E] hover:text-[#D4AF37] transition-colors hover:underline underline-offset-4">Lupa Password?</a>
                    </div>

                    <button type="submit" class="w-full flex justify-center py-4 px-6 border border-transparent rounded-xl shadow-lg text-base font-bold text-white bg-linear-to-r from-[#1A305E] to-[#2c3e50] hover:from-[#122143] hover:to-[#1A305E] focus:outline-none focus:ring-4 focus:ring-[#1A305E]/30 transform hover:-translate-y-1 hover:shadow-xl transition-all duration-300">
                        MASUK SEKARANG
                    </button>
                    
                    <!-- Footer Information Mobile Only (Simplified) -->
                     <div class="lg:hidden mt-8 text-center border-t border-gray-100 pt-6">
                        <p class="text-xs text-gray-400">&copy; {{ date('Y') }} PPID Provinsi Sulawesi Selatan</p>
                    </div>

                </form>
            </div>
            
             <!-- Bottom Contact Info (Desktop) -->
            <div class="hidden lg:block absolute bottom-2 w-full text-center px-8 ">
                 <p class="text-xs text-gray-400 font-medium">
                    &copy; {{ date('Y') }} Pemerintah Provinsi Sulawesi Selatan.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
