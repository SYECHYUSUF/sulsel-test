<x-layout>
    <x-header />

    {{-- Main Container: Menggunakan min-h-[calc(100vh-150px)] agar di desktop berusaha fit satu layar --}}
    <main class="bg-gray-50 min-h-[calc(100vh-80px)] font-['Plus_Jakarta_Sans'] flex flex-col justify-center py-4 lg:py-0">
        
        <div class="container mx-auto px-4 lg:max-w-7xl h-full">
            
            {{-- 1. BREADCRUMB & TITLE (Compact) --}}
            <div class="mb-4 lg:mb-6 pt-2">
                <nav class="flex text-sm font-medium text-gray-500 mb-2" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-2">
                        <li class="inline-flex items-center">
                            <a href="/" class="hover:text-[#D4AF37] transition-colors flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                                Beranda
                            </a>
                        </li>
                        <li><span class="text-gray-400">/</span></li>
                        <li class="text-[#1A305E] font-bold" aria-current="page">Kontak Kami</li>
                    </ol>
                </nav>
                <h1 class="text-2xl md:text-3xl font-extrabold text-[#1A305E] tracking-tight">Hubungi Kami</h1>
            </div>

            {{-- 2. CONTENT GRID (Fit Screen on Desktop) --}}
            <div class="grid lg:grid-cols-12 gap-4 lg:gap-8 h-auto lg:h-[600px]"> {{-- Fixed height on large screens to avoid scroll --}}
                
                {{-- LEFT COLUMN: INFO & MAP (4 Columns) --}}
                <div class="lg:col-span-4 flex flex-col gap-4 h-full">
                    
                    {{-- Info Card --}}
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 flex-shrink-0">
                        <div class="space-y-4">
                            {{-- Phone --}}
                            <div class="flex items-center gap-3 group">
                                <div class="w-10 h-10 bg-[#1A305E]/10 rounded-full flex items-center justify-center text-[#1A305E] group-hover:bg-[#1A305E] group-hover:text-[#D4AF37] transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase font-semibold">Telepon</p>
                                    <a href="tel:0411453192" class="text-base font-bold text-[#1A305E] hover:underline">(0411) 453192</a>
                                </div>
                            </div>

                            {{-- Email --}}
                            <div class="flex items-center gap-3 group">
                                <div class="w-10 h-10 bg-[#1A305E]/10 rounded-full flex items-center justify-center text-[#1A305E] group-hover:bg-[#1A305E] group-hover:text-[#D4AF37] transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                </div>
                                <div class="overflow-hidden">
                                    <p class="text-xs text-gray-500 uppercase font-semibold">Email</p>
                                    <a href="mailto:ppid@sulawesiprov.go.id" class="text-base font-bold text-[#1A305E] hover:underline truncate block">ppid@sulawesiprov.go.id</a>
                                </div>
                            </div>

                            {{-- Jam --}}
                            <div class="flex items-center gap-3 group">
                                <div class="w-10 h-10 bg-[#1A305E]/10 rounded-full flex items-center justify-center text-[#1A305E] group-hover:bg-[#1A305E] group-hover:text-[#D4AF37] transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase font-semibold">Jam Layanan</p>
                                    <p class="text-sm font-bold text-[#1A305E]">08:00 - 16:00 WITA (Sen-Jum)</p>
                                </div>
                            </div>
                            
                             {{-- Alamat --}}
                             <div class="flex items-start gap-3 group">
                                <div class="w-10 h-10 bg-[#1A305E]/10 rounded-full flex items-center justify-center text-[#1A305E] group-hover:bg-[#1A305E] group-hover:text-[#D4AF37] transition-all flex-shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase font-semibold">Alamat</p>
                                    <p class="text-sm font-medium text-[#1A305E] leading-snug">
                                        Jl. Jenderal Urip Sumoharjo No.269, Makassar
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Map (Fills remaining height on desktop) --}}
                    <div class="bg-gray-200 rounded-xl overflow-hidden shadow-sm border border-gray-200 flex-grow min-h-[200px]">
                         <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3973.743864500984!2d119.43285731476497!3d-5.145163996265785!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbee2c6a0e66041%3A0x67a3221971700685!2sKantor%20Gubernur%20Sulawesi%20Selatan!5e0!3m2!1sid!2sid!4v1679000000000!5m2!1sid!2sid" 
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>

                {{-- RIGHT COLUMN: FORM (8 Columns) --}}
                <div class="lg:col-span-8 flex flex-col h-full">
                    <div class="bg-white rounded-xl shadow-lg border-t-4 border-[#D4AF37] p-6 lg:p-8 flex flex-col h-full justify-between">
                        
                        <div>
                            <h2 class="text-xl font-bold text-[#1A305E] mb-1">Kirim Pesan</h2>
                            <p class="text-sm text-gray-500 mb-6">Silakan isi formulir di bawah untuk menghubungi kami.</p>

                            <form action="#" method="POST" class="space-y-4">
                                @csrf
                                
                                {{-- Row 1: Nama & HP (Grid) --}}
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="name" class="block text-sm font-bold text-[#1A305E] mb-1">Nama Lengkap</label>
                                        <input type="text" id="name" name="name" 
                                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] transition-all text-sm"
                                            placeholder="Nama Anda" required>
                                    </div>
                                    <div>
                                        <label for="phone" class="block text-sm font-bold text-[#1A305E] mb-1">No. WhatsApp / HP</label>
                                        <input type="tel" id="phone" name="phone" 
                                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] transition-all text-sm"
                                            placeholder="08..." required>
                                    </div>
                                </div>

                                {{-- Row 2: Email & Subject (Grid) --}}
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="email" class="block text-sm font-bold text-[#1A305E] mb-1">Email</label>
                                        <input type="email" id="email" name="email" 
                                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] transition-all text-sm"
                                            placeholder="email@anda.com" required>
                                    </div>
                                    <div>
                                        <label for="subject" class="block text-sm font-bold text-[#1A305E] mb-1">Perihal</label>
                                        <select id="subject" name="subject" 
                                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] transition-all text-sm cursor-pointer">
                                            <option value="" disabled selected>Pilih Topik</option>
                                            <option value="permohonan">Permohonan Informasi</option>
                                            <option value="pengaduan">Pengaduan Layanan</option>
                                            <option value="saran">Saran & Masukan</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Row 3: Message --}}
                                <div>
                                    <label for="message" class="block text-sm font-bold text-[#1A305E] mb-1">Isi Pesan</label>
                                    <textarea id="message" name="message" 
                                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] transition-all text-sm h-32 resize-none"
                                        placeholder="Tuliskan pesan Anda dengan jelas di sini..." required></textarea>
                                </div>

                                {{-- Submit Action --}}
                                <div class="pt-2">
                                    <button type="submit" 
                                        class="w-full bg-[#1A305E] hover:bg-[#D4AF37] text-white font-bold py-3 px-6 rounded-lg shadow-md transition-all transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                                        </svg>
                                        Kirim Pesan
                                    </button>
                                </div>
                            </form>
                        </div>
                        
                        {{-- Footer Note in Card --}}
                        <div class="mt-4 pt-4 border-t border-gray-100">
                             <p class="text-xs text-center text-gray-500">
                                Butuh layanan resmi? Gunakan menu <a href="/layanan/permohonan-informasi" class="text-[#1A305E] font-bold hover:text-[#D4AF37] underline">Layanan PPID</a>.
                            </p>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </main>

    <x-footer />
</x-layout>