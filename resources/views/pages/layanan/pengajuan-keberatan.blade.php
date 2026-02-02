<x-layout>
    <x-header />

    {{-- Content Wrapper --}}
    <div class="relative w-full bg-slate-50 min-h-[calc(100vh-200px)]">
        
        <div class="container mx-auto px-4 py-8 md:py-12">
            
            <!-- Breadcrumb & Header Section (Standard Style) -->
            <div class="mb-10">
                <!-- Breadcrumb -->
                <nav class="flex items-center gap-2 text-sm text-gray-500 mb-4 font-['Plus_Jakarta_Sans']">
                    <a href="/" class="hover:text-[#D1001F] transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    </a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-400"><path d="m9 18 6-6-6-6"/></svg>
                    <span>Layanan</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-400"><path d="m9 18 6-6-6-6"/></svg>
                    <span class="font-semibold text-[#1A305E]">Pengajuan Keberatan</span>
                </nav>

                <!-- Title & Accent -->
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 border-b border-gray-200 pb-6">
                    <div>
                        <h1 class="text-3xl md:text-4xl font-extrabold text-[#1A305E] font-['Plus_Jakarta_Sans'] mb-2">
                            Pengajuan Keberatan
                        </h1>
                        <p class="text-gray-500 text-lg font-medium font-['Plus_Jakarta_Sans']">
                            Ajukan keberatan atas pelayanan informasi publik
                        </p>
                    </div>
                    <!-- Gold Accent Line -->
                    <div class="hidden md:block w-24 h-1.5 bg-gradient-to-r from-[#D4AF37] to-[#F3E5AB] rounded-full"></div>
                </div>
            </div>

            <!-- Main Form Card -->
            <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden font-['Plus_Jakarta_Sans'] relative" x-data="{ showGuide: false }">
                

                <!-- Form Heading (Clean Style) -->
                <div class="pt-10 pb-6 px-6 text-center">
                    <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center mx-auto mb-4 text-[#1A305E]">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    </div>
                    <h2 class="text-2xl md:text-3xl font-bold text-[#1A305E] mb-2">Formulir Pengajuan Keberatan</h2>
                    <p class="text-slate-500">Silakan lengkapi data keberatan Anda</p>
                </div>

                <!-- Form Content -->
                <div class="px-6 pb-8 md:px-10 md:pb-12">
                    
                    @if(session('success'))
                        <div class="mb-8 bg-green-50 border border-green-200 rounded-lg p-4 flex gap-4">
                            <div class="text-green-500 flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                            </div>
                            <div>
                                <h3 class="text-green-800 font-semibold mb-1">Berhasil!</h3>
                                <p class="text-green-700 text-sm">{{ session('success') }}</p>
                                <!-- View Status Button -->
                                <div class="mt-3">
                                    <a href="{{ route('layanan.pengajuan-keberatan.check-status') }}" class="inline-flex items-center text-sm font-medium text-green-700 hover:text-green-800 underline">
                                        Cek Status Pengajuan &rarr;
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    <!-- Classification Tabs (Static for Visual) -->
                    <div class="flex justify-center items-center border-b border-gray-200 mb-8 overflow-x-auto">
                         <button class="px-6 py-3 text-[#D1001F] border-b-2 border-[#D1001F] font-semibold text-sm focus:outline-none flex items-center gap-2 whitespace-nowrap">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" /></svg>
                            Pengajuan Keberatan
                         </button>
                    
                    </div>



                    <form action="{{ route('layanan.pengajuan-keberatan.store') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        {{-- Honeypot field for bot detection (hidden, must remain empty) --}}
                        <div style="position: absolute; left: -9999px; opacity: 0;" aria-hidden="true">
                            <input type="text" name="website" tabindex="-1" autocomplete="off" />
                        </div>
                        {{-- Timestamp for bot detection --}}
                        <input type="hidden" name="_form_timestamp" value="{{ time() }}" />
                        
                        <!-- Core Form Fields -->
                        <div class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor Pendaftaran Pengajuan Keberatan</label>
                                    <input type="text" name="no_pendaftaran" value="{{ old('no_pendaftaran') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#D1001F] focus:ring focus:ring-[#D1001F]/20 py-3 px-4" placeholder="Masukkan nomor pendaftaran...">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tujuan Penggunaan Informasi</label>
                                    <input type="text" name="tujuan" value="{{ old('tujuan') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#D1001F] focus:ring focus:ring-[#D1001F]/20 py-3 px-4" placeholder="Contoh: Penelitian Skripsi...">
                                </div>
                            </div>

                            <!-- Identitas Pemohon -->
                            <div class="pt-4 border-t border-gray-100">
                                <h3 class="text-lg font-bold text-gray-800 mb-4">Identitas Pemohon</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                                        <input type="text" name="nama_pemohon" value="{{ old('nama_pemohon') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#D1001F] focus:ring focus:ring-[#D1001F]/20 py-3 px-4">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                                        <input type="email" name="email_pemohon" value="{{ old('email_pemohon') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#D1001F] focus:ring focus:ring-[#D1001F]/20 py-3 px-4">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor Telepon / WhatsApp</label>
                                        <input type="text" name="no_telp_pemohon" value="{{ old('no_telp_pemohon') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#D1001F] focus:ring focus:ring-[#D1001F]/20 py-3 px-4" placeholder="08xxxxxxxxxx">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Pekerjaan <span class="text-red-500">*</span></label>
                                        <select name="pekerjaan_pemohon" class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#D1001F] focus:ring focus:ring-[#D1001F]/20 py-3 px-4" required>
                                            <option value="">-- Pilih Pekerjaan --</option>
                                            @foreach($masterPekerjaan as $pekerjaan)
                                                <option value="{{ $pekerjaan->nama_pekerjaan }}" {{ old('pekerjaan_pemohon') == $pekerjaan->nama_pekerjaan ? 'selected' : '' }}>
                                                    {{ $pekerjaan->nama_pekerjaan }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Lengkap</label>
                                        <textarea name="alamat_pemohon" rows="2" class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#D1001F] focus:ring focus:ring-[#D1001F]/20 py-3 px-4">{{ old('alamat_pemohon') }}</textarea>
                                    </div>
                                    <!-- Hidden Fields for compatibility if needed or user fills them -->
                                    <input type="hidden" name="address_pemohon" value="-">
                                    <input type="hidden" name="apt_pemohon" value="-">
                                    <input type="hidden" name="city_pemohon" value="-">
                                    <input type="hidden" name="state_pemohon" value="-">
                                </div>
                            </div>

                            <!-- Kasus Posisi -->
                            <div class="pt-4 border-t border-gray-100">
                                 <label class="block text-sm font-semibold text-gray-700 mb-2">Kasus Posisi</label>
                                 <textarea name="kasus" rows="4" class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#D1001F] focus:ring focus:ring-[#D1001F]/20 py-3 px-4" placeholder="Jelaskan secara singkat kasus posisi atau alasan keberatan anda...">{{ old('kasus') }}</textarea>
                            </div>

                            <!-- Alasan Keberatan Section (Checkboxes) -->
                            <div class="pt-4 border-t border-gray-100">
                                <label class="block text-sm font-semibold text-gray-700 mb-4">Alasan Keberatan (Pilih yang sesuai)</label>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                    @forelse($alasanPengajuans as $alasan)
                                    <label class="relative flex items-start p-3 border rounded-lg hover:bg-slate-50 cursor-pointer group transition-all">
                                        <div class="flex items-center h-5">
                                            <input type="checkbox" name="alasan[]" value="{{ $alasan->alasan }}" class="h-4 w-4 text-[#D1001F] border-gray-300 rounded focus:ring-[#D1001F]">
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <span class="font-medium text-gray-700 group-hover:text-gray-900">{{ $alasan->alasan }}</span>
                                        </div>
                                    </label>
                                    @empty
                                    <div class="col-span-2 text-center py-4 text-gray-500">
                                        <p>Belum ada data alasan pengajuan. Silakan hubungi administrator.</p>
                                    </div>
                                    @endforelse
                                </div>
                            </div>


                            <!-- Checkbox Identitas Kuasa (Optional) -->
                            <div x-data="{ showKuasa: false }" class="pt-4 border-t border-gray-100">
                                 <label class="inline-flex items-center">
                                    <input type="checkbox" x-model="showKuasa" class="rounded border-gray-300 text-[#D1001F] shadow-sm focus:border-[#D1001F] focus:ring focus:ring-[#D1001F]/20">
                                    <span class="ml-2 text-sm text-gray-600">Diwakilkan oleh Kuasa? (Opsional)</span>
                                </label>
                                
                                <div x-show="showKuasa" x-transition class="mt-4 p-4 bg-gray-50 rounded-lg space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Kuasa</label>
                                        <input type="text" name="nama_kuasa" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D1001F] focus:ring focus:ring-[#D1001F]/20">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Alamat Kuasa</label>
                                        <input type="text" name="alamat_kuasa" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D1001F] focus:ring focus:ring-[#D1001F]/20">
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Nomor Telepon Kuasa</label>
                                            <input type="text" name="no_telp_kuasa" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D1001F] focus:ring focus:ring-[#D1001F]/20">
                                        </div>
                                    </div>
                                    <!-- Hidden Fields -->
                                    <input type="hidden" name="address_kuasa" value="-">
                                    <input type="hidden" name="apt_kuasa" value="-">
                                    <input type="hidden" name="city_kuasa" value="-">
                                    <input type="hidden" name="state_kuasa" value="-">
                                </div>
                            </div>

                        </div>

                        <!-- Submit Button -->
                        <div class="pt-6">
                            <button type="submit" class="w-full flex justify-center py-4 px-4 border border-transparent rounded-lg shadow-sm text-lg font-bold text-white bg-[#D1001F] hover:bg-[#b0001a] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#D1001F] transition-all transform hover:scale-[1.01]">
                                KIRIM PENGAJUAN
                            </button>
                        </div>

                        <div class="mt-8 text-center border-t pt-6">
                             <p class="text-sm text-gray-600 mb-4">Sudah pernah mengajukan keberatan?</p>
                             <a href="{{ route('layanan.pengajuan-keberatan.check-status') }}" class="inline-flex items-center justify-center px-6 py-2 border border-slate-300 shadow-sm text-sm font-medium rounded-lg text-slate-700 bg-white hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5 text-slate-500" viewBox="0 0 20 20" fill="currentColor"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z" /><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" /></svg>
                                Tinjau / Cek Status Pengajuan
                             </a>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Bottom Logos (Optional aesthetic touch) -->
            <div class="mt-12 flex justify-center gap-6 opacity-60 grayscale hover:grayscale-0 transition-all">
            </div>

        </div>

        <!-- Guide Modal (Panduan) -->
        <div x-show="showGuide" style="display: none;" class="fixed inset-0 z-[100] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                 <div x-show="showGuide" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity" aria-hidden="true" @click="showGuide = false"></div>
                 <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                 <div x-show="showGuide" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-3xl w-full">
                    
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 relative">
                        <button @click="showGuide = false" class="absolute top-4 right-4 text-gray-400 hover:text-gray-500">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                        
                        <div class="text-center sm:text-left">
                            <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center justify-center sm:justify-start gap-2">
                                 <span class="bg-[#D1001F] text-white p-1 rounded">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                                 </span>
                                 Panduan Pengisian Pengajuan
                            </h3>
                            
                            <div class="prose prose-red max-w-none text-gray-600 space-y-4">
                                <div class="bg-red-50 p-4 rounded-lg flex gap-4 items-start">
                                    <div class="font-bold text-[#D1001F] text-xl">1</div>
                                    <div>
                                        <h4 class="font-bold text-gray-800">Siapkan Nomor Pendaftaran</h4>
                                        <p class="text-sm mt-1">Pastikan Anda memiliki Nomor Pendaftaran dari Pengajuan Keberatan sebelumnya yang ingin Anda ajukan keberatan.</p>
                                    </div>
                                </div>
                                
                                 <div class="bg-red-50 p-4 rounded-lg flex gap-4 items-start">
                                    <div class="font-bold text-[#D1001F] text-xl">2</div>
                                    <div>
                                        <h4 class="font-bold text-gray-800">Isi Data Diri Lengkap</h4>
                                        <p class="text-sm mt-1">Lengkapi data diri sesuai KTP. Email dan Nomor Telepon/WA sangat penting untuk komunikasi balasan.</p>
                                    </div>
                                </div>

                                 <div class="bg-red-50 p-4 rounded-lg flex gap-4 items-start">
                                    <div class="font-bold text-[#D1001F] text-xl">3</div>
                                    <div>
                                        <h4 class="font-bold text-gray-800">Pilih Metode Respon</h4>
                                        <p class="text-sm mt-1">Pilih apakah Anda ingin dihubungi via <b>WhatsApp</b> (Lebih Cepat) atau memantau via <b>Website</b>.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-[#D1001F] text-base font-medium text-white hover:bg-[#b0001a] focus:outline-none sm:ml-3 sm:w-auto sm:text-sm" @click="showGuide = false">
                            Saya Mengerti, Lanjutkan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <x-footer />
</x-layout>