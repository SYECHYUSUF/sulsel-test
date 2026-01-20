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
                <span class="text-[#1A305E] font-medium">Layanan</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-gray-400"><path d="m9 18 6-6-6-6"/></svg>
                <span class="text-[#1A305E] font-medium">Pengajuan Keberatan</span>
            </div>
          
            {{-- Title --}}
            <div class="flex items-end justify-between">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold text-[#1A305E] mb-2">
                        Pengajuan Keberatan Informasi
                    </h1>
                    <p class="text-gray-600">
                        Formulir pengajuan keberatan atas permohonan informasi
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
            <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
                
                <div class="mb-8 border-b border-gray-100 pb-6">
                    <h2 class="text-xl font-bold text-[#1A305E] mb-2">Formulir Keberatan</h2>
                    <p class="text-gray-600 text-sm">Silakan lengkapi data di bawah ini untuk mengajukan keberatan.</p>
                </div>

                <form class="space-y-6">
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">Kode Permohonan</label>
                        <input type="text" placeholder="Masukkan kode permohonan informasi" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] transition-all outline-none" />
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">NIK (Nomor Induk Kependudukan)</label>
                         <input type="text" placeholder="Masukkan 16 digit NIK" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] transition-all outline-none" />
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">Alasan Keberatan</label>
                        <textarea rows="5" placeholder="Jelaskan alasan keberatan Anda" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] transition-all outline-none"></textarea>
                    </div>

                    <div class="pt-4">
                        <button type="button" class="w-full md:w-auto px-8 py-3 bg-[#1A305E] text-white font-semibold rounded-lg hover:bg-[#1A305E]/90 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            Kirim Keberatan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </main>

    <x-footer />
</x-layout>
