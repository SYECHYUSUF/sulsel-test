<x-app-layout>
    @section('title', 'Login - PPID Sulsel')

    <div class="min-h-screen relative flex items-center justify-center p-4 lg:p-0 font-sans">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/kantor.jpeg') }}" alt="Kantor Gubernur" class="w-full h-full object-cover object-center opacity-30">
            <div class="absolute inset-0 bg-linear-to-br from-[#1A305E]/95 via-[#1A305E]/85 to-[#122143]/95 mix-blend-multiply"></div>
        </div>

        <div class="relative z-10 w-full max-w-[1100px] h-auto lg:h-[650px] bg-white rounded-3xl shadow-2xl border border-white/40 overflow-hidden flex flex-col lg:flex-row animate-slide-up">
            
            <div class="hidden lg:flex lg:w-5/12 bg-linear-to-b from-[#1A305E] to-[#0f172a] p-12 flex-col justify-between items-center text-center relative overflow-hidden">
                <div class="relative z-10 w-full text-left">
                    <a href="{{ url('/') }}" class="inline-flex items-center text-white/90 hover:text-white transition-all gap-2 font-medium">
                        <span>Kembali ke Beranda</span>
                    </a>
                </div>
                <div class="relative z-10 flex flex-col items-center mt-8">
                    <img src="{{ asset('images/logo-ppid.png') }}" alt="Logo" class="w-40 h-auto mb-6">
                    <h2 class="text-3xl font-bold text-white">PPID Utama<br><span class="text-[#D4AF37]">Sulawesi Selatan</span></h2>
                </div>
                <div class="mt-auto"></div>
            </div>

            <div class="w-full lg:w-7/12 bg-white relative flex flex-col justify-center h-full">
                <div class="p-8 md:p-14 lg:p-16 w-full max-w-lg mx-auto">
                    
                    <div class="mb-8 text-center lg:text-left">
                        <h1 class="text-3xl font-extrabold text-[#1A305E] mb-3">Selamat Datang</h1>
                        <p class="text-gray-500">Silakan masuk untuk melanjutkan.</p>
                    </div>

                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form action="{{ route('login') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <div class="space-y-2">
                            <label for="email" class="block text-sm font-bold text-[#1A305E] uppercase">Email</label>
                            <input name="email" id="email" value="{{ old('email') }}" required autofocus
                                class="block w-full px-4 py-4 border-2 border-gray-200 rounded-xl focus:border-[#1A305E] outline-none">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="space-y-2">
                            <label for="password" class="block text-sm font-bold text-[#1A305E] uppercase">Password</label>
                            <input type="password" name="password" id="password" required
                                class="block w-full px-4 py-4 border-2 border-gray-200 rounded-xl focus:border-[#1A305E] outline-none">
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-between">
                            <label class="flex items-center">
                                <input type="checkbox" name="remember" class="rounded border-gray-300 text-[#1A305E]">
                                <span class="ml-2 text-sm text-gray-600">Ingat Saya</span>
                            </label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-sm font-bold text-[#1A305E]">Lupa Password?</a>
                            @endif
                        </div>

                        <button type="submit" class="w-full py-4 bg-[#1A305E] text-white rounded-xl font-bold shadow-lg hover:bg-[#122143] transition-all">
                            MASUK SEKARANG
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>