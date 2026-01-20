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
                <span class="text-[#1A305E] font-bold">Pengajuan Keberatan</span>
            </div>
          
            {{-- Title --}}
            <div class="flex items-end justify-between">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold text-[#1A305E] mb-2">
                        Pengajuan Keberatan
                    </h1>
                    <p class="text-gray-600">
                        Ajukan keberatan atas pelayanan informasi publik
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>
                        </div>
                        <h2 class="text-2xl font-bold text-[#1A305E] mb-2">
                            Formulir Pengajuan Keberatan
                        </h2>
                        <p class="text-gray-600">
                            Silakan lengkapi data keberatan Anda
                        </p>
                    </div>

                    <form class="space-y-8">
                        
                        {{-- Pengirim --}}
                        <div class="bg-[#1A305E]/5 p-6 rounded-xl border border-[#1A305E]/10">
                            <label class="block text-sm font-bold text-[#1A305E] mb-3">
                                Pengirim Keberatan
                            </label>
                            <div class="flex flex-col sm:flex-row gap-6">
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <div class="relative flex items-center justify-center w-5 h-5">
                                        <input type="radio" name="pengirim" value="pemohon" class="peer appearance-none w-5 h-5 border-2 border-gray-400 rounded-full checked:border-[#D4AF37] checked:bg-[#D4AF37] transition-all" checked />
                                        <div class="absolute w-2.5 h-2.5 bg-white rounded-full opacity-0 peer-checked:opacity-100 transition-opacity"></div>
                                    </div>
                                    <span class="text-gray-700 font-medium group-hover:text-[#1A305E]">Pemohon Informasi Publik</span>
                                </label>
                                <label class="flex items-center gap-3 cursor-pointer group">
                                     <div class="relative flex items-center justify-center w-5 h-5">
                                        <input type="radio" name="pengirim" value="kuasa" class="peer appearance-none w-5 h-5 border-2 border-gray-400 rounded-full checked:border-[#D4AF37] checked:bg-[#D4AF37] transition-all" />
                                        <div class="absolute w-2.5 h-2.5 bg-white rounded-full opacity-0 peer-checked:opacity-100 transition-opacity"></div>
                                    </div>
                                    <span class="text-gray-700 font-medium group-hover:text-[#1A305E]">Kuasa Pemohon Informasi Publik</span>
                                </label>
                            </div>
                        </div>

                        {{-- Identitas --}}
                        <div class="space-y-6">
                             <h3 class="text-lg font-bold text-[#1A305E] flex items-center gap-2 border-b border-gray-100 pb-2">
                                <span class="w-8 h-8 rounded-full bg-[#D4AF37] text-white flex items-center justify-center text-sm">1</span>
                                Identitas Pemohon
                            </h3>

                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">Nama Pemohon Informasi</label>
                                <input type="text" placeholder="Masukkan nama lengkap" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] transition-all outline-none bg-gray-50 focus:bg-white" />
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700">Jenis Kelamin</label>
                                    <select class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] transition-all outline-none bg-gray-50 focus:bg-white">
                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                        <option value="laki-laki">Laki-laki</option>
                                        <option value="perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700">Tanggal Lahir</label>
                                    <input type="date" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] transition-all outline-none bg-gray-50 focus:bg-white" />
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700">NIK (Nomor Induk Kependudukan)</label>
                                    <input type="text" placeholder="16 digit NIK" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] transition-all outline-none bg-gray-50 focus:bg-white" />
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700">No. KK / No. Pengesahan</label>
                                    <input type="text" placeholder="No. KK / Akte Pendirian" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] transition-all outline-none bg-gray-50 focus:bg-white" />
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700">Nomor HP / Telepon</label>
                                    <input type="tel" placeholder="08xxxxxxxxxx" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] transition-all outline-none bg-gray-50 focus:bg-white" />
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700">Email</label>
                                    <input type="email" placeholder="email@contoh.com" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] transition-all outline-none bg-gray-50 focus:bg-white" />
                                </div>
                            </div>
                        </div>

                         {{-- Identitas Kuasa (Optional/Separated) --}}
                         <div class="space-y-6">
                             <h3 class="text-lg font-bold text-[#1A305E] flex items-center gap-2 border-b border-gray-100 pb-2">
                                <span class="w-8 h-8 rounded-full bg-[#D4AF37] text-white flex items-center justify-center text-sm">2</span>
                                Identitas Kuasa Pemohon
                            </h3>
                             <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">Identitas Kuasa (Nama)</label>
                                <input type="text" placeholder="Nama Kuasa (jika ada)" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] transition-all outline-none bg-gray-50 focus:bg-white" />
                            </div>
                             <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">Alamat Lengkap</label>
                                <textarea rows="3" placeholder="Alamat lengkap kuasa" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] transition-all outline-none bg-gray-50 focus:bg-white resize-none"></textarea>
                            </div>
                             <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">Pekerjaan / Jabatan</label>
                                <input type="text" placeholder="Pekerjaan kuasa" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] transition-all outline-none bg-gray-50 focus:bg-white" />
                            </div>
                        </div>

                        {{-- Alasan --}}
                        <div class="space-y-6">
                            <h3 class="text-lg font-bold text-[#1A305E] flex items-center gap-2 border-b border-gray-100 pb-2">
                                <span class="w-8 h-8 rounded-full bg-[#D4AF37] text-white flex items-center justify-center text-sm">3</span>
                                Alasan Keberatan
                            </h3>
                            
                            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-r-lg mb-4">
                                <p class="text-sm text-blue-800 font-medium mb-2">Berdasarkan UU No.14 Tahun 2008 Pasal 35 ayat (1), alasan keberatan dapat berupa:</p>
                                <ul class="list-disc list-inside text-xs text-blue-700 space-y-1">
                                    <li>Penolakan berdasarkan alasan pengecualian (Pasal 17).</li>
                                    <li>Tidak disediakannya informasi berkala (Pasal 9).</li>
                                    <li>Permintaan informasi tidak ditanggapi.</li>
                                    <li>Permintaan informasi ditanggapi tidak sebagaimana diminta.</li>
                                    <li>Tidak dipenuhinya permintaan informasi.</li>
                                    <li>Pengenaan biaya yang tidak wajar.</li>
                                    <li>Penyampaian informasi melebihi waktu yang ditentukan.</li>
                                </ul>
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">Deskripsi Alasan Keberatan</label>
                                <textarea rows="6" placeholder="Jelaskan alasan keberatan Anda secara rinci..." class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] transition-all outline-none bg-gray-50 focus:bg-white resize-none"></textarea>
                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="pt-6 flex justify-end">
                             <button type="submit" class="px-8 py-3.5 bg-[#1A305E] text-white font-bold rounded-lg hover:bg-[#1A305E]/90 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg>
                                Kirim Keberatan
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </main>

    <x-footer />
</x-layout>
