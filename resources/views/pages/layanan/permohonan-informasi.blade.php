<x-layout>
    <x-header />

    {{-- Breadcrumb + Title Section --}}
    <div class="bg-white border-b border-gray-200 font-['Plus_Jakarta_Sans']">
        <div class="container mx-auto px-4 py-8">
            {{-- Breadcrumb --}}
            <div class="flex items-center gap-2 text-sm text-gray-600 mb-4">
                <a href="/" class="hover:text-[#1A305E] transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                </a>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-gray-400"><path d="m9 18 6-6-6-6"/></svg>
                <span class="text-[#1A305E] font-medium">Layanan</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-gray-400"><path d="m9 18 6-6-6-6"/></svg>
                <span class="text-[#1A305E] font-bold">Permohonan Informasi</span>
            </div>
          
            {{-- Title --}}
            <div class="flex items-end justify-between">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold text-[#1A305E] mb-2">
                        Permohonan Informasi
                    </h1>
                    <p class="text-gray-600">
                        Ajukan permohonan informasi publik
                    </p>
                </div>
                <div class="hidden md:block">
                    <div class="w-24 h-1.5 bg-gradient-to-r from-[#1A305E] to-[#D4AF37] rounded-full"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content --}}
    <main class="py-12 md:py-16 bg-gray-50 font-['Plus_Jakarta_Sans']">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto">
                
                {{-- Form Container --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8 md:p-10">
                    <div class="text-center mb-10">
                        <div class="w-16 h-16 bg-[#1A305E]/5 text-[#1A305E] rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" x2="8" y1="13" y2="13"/><line x1="16" x2="8" y1="17" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                        </div>
                        <h2 class="text-2xl font-bold text-[#1A305E] mb-2">
                            Formulir Permohonan Informasi
                        </h2>
                        <p class="text-gray-600">
                            Silakan lengkapi formulir di bawah ini dengan data yang benar
                        </p>
                    </div>

                    <form class="space-y-8">
                        {{-- Personal Data --}}
                        <div class="space-y-6">
                            <h3 class="text-lg font-bold text-[#1A305E] flex items-center gap-2 border-b border-gray-100 pb-2">
                                <span class="w-8 h-8 rounded-full bg-[#D4AF37] text-white flex items-center justify-center text-sm">1</span>
                                Data Pribadi
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700">Nama Lengkap</label>
                                    <input type="text" placeholder="Masukkan nama sesuai KTP" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] transition-all outline-none bg-gray-50 focus:bg-white" />
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700">No. KTP (NIK)</label>
                                    <input type="text" placeholder="16 digit NIK" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] transition-all outline-none bg-gray-50 focus:bg-white" />
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700">Nomor KK</label>
                                    <input type="text" placeholder="Nomor Kartu Keluarga" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] transition-all outline-none bg-gray-50 focus:bg-white" />
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700">Email</label>
                                    <input type="email" placeholder="contoh@email.com" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] transition-all outline-none bg-gray-50 focus:bg-white" />
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700">Alamat</label>
                                    <textarea rows="3" placeholder="Alamat lengkap domisili" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] transition-all outline-none bg-gray-50 focus:bg-white resize-none"></textarea>
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700">Pekerjaan</label>
                                    <input type="text" placeholder="Pekerjaan saat ini" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] transition-all outline-none bg-gray-50 focus:bg-white" />
                                </div>
                            </div>
                        </div>

                        {{-- Upload Content --}}
                        <div class="space-y-6">
                            <h3 class="text-lg font-bold text-[#1A305E] flex items-center gap-2 border-b border-gray-100 pb-2">
                                <span class="w-8 h-8 rounded-full bg-[#D4AF37] text-white flex items-center justify-center text-sm">2</span>
                                Dokumen Pendukung
                            </h3>
                             <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700">Upload Foto KTP</label>
                                    <div class="relative">
                                        <input type="file" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#1A305E]/10 file:text-[#1A305E] hover:file:bg-[#1A305E]/20 cursor-pointer border border-gray-300 rounded-lg" />
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">Format: JPG, JPEG, PNG (Max. 5MB)</p>
                                </div>
                                 {{-- Placeholder for Upload KK if needed, but not in user request explicitly, keeping design balanced --}}
                            </div>
                        </div>


                        {{-- Information Details --}}
                        <div class="space-y-6">
                             <h3 class="text-lg font-bold text-[#1A305E] flex items-center gap-2 border-b border-gray-100 pb-2">
                                <span class="w-8 h-8 rounded-full bg-[#D4AF37] text-white flex items-center justify-center text-sm">3</span>
                                Detail Informasi
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700">Nomor Pengeluaran (Badan Hukum)</label>
                                    <input type="text" placeholder="Jika mewakili badan hukum" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] transition-all outline-none bg-gray-50 focus:bg-white" />
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700">Tujuan Penggunaan Informasi</label>
                                    <input type="text" placeholder="Jelaskan tujuan permohonan" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] transition-all outline-none bg-gray-50 focus:bg-white" />
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">Rincian Informasi Yang Dibutuhkan</label>
                                <textarea rows="4" placeholder="Deskripsikan informasi yang Anda butuhkan secara detail" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] transition-all outline-none bg-gray-50 focus:bg-white resize-none"></textarea>
                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="pt-6 flex justify-end">
                            <button type="submit" class="px-8 py-3.5 bg-[#1A305E] text-white font-bold rounded-lg hover:bg-[#1A305E]/90 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" x2="11" y1="2" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                                Kirim Permohonan
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </main>

    <x-footer />
</x-layout>
