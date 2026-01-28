<x-layout>
    <x-header />

    {{-- Breadcrumb + Title Section --}}
    <div class="bg-white dark:bg-slate-800 border-b border-gray-200 dark:border-slate-700 font-['Plus_Jakarta_Sans']">
        <div class="container mx-auto px-4 py-8">
            {{-- Breadcrumb --}}
            <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300 mb-4">
                <a href="/" class="hover:text-[#1A305E] dark:text-white transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                </a>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-gray-400"><path d="m9 18 6-6-6-6"/></svg>
                <span class="text-[#1A305E] dark:text-white font-medium">Layanan</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-gray-400"><path d="m9 18 6-6-6-6"/></svg>
                <span class="text-[#1A305E] dark:text-white font-bold">Permohonan Informasi</span>
            </div>
          
            {{-- Title --}}
            <div class="flex items-end justify-between">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold text-[#1A305E] dark:text-white mb-2">
                        Permohonan Informasi
                    </h1>
                    <p class="text-gray-600 dark:text-gray-300">
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
    <main class="py-12 md:py-16 bg-gray-50 dark:bg-slate-900 font-['Plus_Jakarta_Sans']">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto">
                
                {{-- Form Container --}}
                <div x-data="{ successModalOpen: @if(session('success')) true @else false @endif }" 
                    class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-gray-200 dark:border-slate-700 p-8 md:p-10 relative">
                    <div class="text-center mb-10">
                        <div class="w-16 h-16 bg-[#1A305E]/5 text-[#1A305E] dark:text-white rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" x2="8" y1="13" y2="13"/><line x1="16" x2="8" y1="17" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                        </div>
                        <h2 class="text-2xl font-bold text-[#1A305E] dark:text-white mb-2">
                            Formulir Permohonan Informasi
                        </h2>
                        <p class="text-gray-600 dark:text-gray-300">
                            Silakan lengkapi formulir di bawah ini dengan data yang benar
                        </p>
                    </div>

                    {{-- Success Modal --}}
                    <div x-show="successModalOpen" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
                        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                            <div x-show="successModalOpen" @click="successModalOpen = false" 
                                class="fixed inset-0 transition-opacity" aria-hidden="true">
                                <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm opacity-100"></div>
                            </div>

                            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                            <div x-show="successModalOpen"
                                class="inline-block align-bottom bg-white dark:bg-slate-800 rounded-[2rem] text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-sm sm:w-full relative">
                                
                                <!-- Modal Content -->
                                <div class="px-8 pt-10 pb-8 relative z-10 flex flex-col items-center text-center">
                                    
                                    <!-- Icon Wrapper with Blob Background -->
                                    <div class="relative w-28 h-28 mb-6 flex items-center justify-center transform hover:scale-105 transition-transform duration-300">
                                        <!-- Blob SVG -->
                                        <svg viewBox="0 0 200 200" class="absolute inset-0 w-full h-full drop-shadow-2xl" xmlns="http://www.w3.org/2000/svg">
                                            <defs>
                                                <linearGradient id="blobGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                                    <stop offset="0%" style="stop-color:#1A305E;stop-opacity:1" /> <!-- Primary Dark Blue -->
                                                    <stop offset="100%" style="stop-color:#3B82F6;stop-opacity:1" /> <!-- Blue 500 -->
                                                </linearGradient>
                                            </defs>
                                            <path fill="url(#blobGradient)" d="M44.7,-76.4C58.9,-69.2,71.8,-59.1,81.6,-46.6C91.4,-34.1,98.1,-19.2,95.8,-4.9C93.5,9.4,82.2,23.1,70.8,34.1C59.4,45.1,47.9,53.4,36.1,60.8C24.3,68.2,12.2,74.7,-1.2,76.8C-14.6,78.9,-29.2,76.6,-42.6,69.9C-56,63.2,-68.2,52.1,-76.6,38.6C-85,25.1,-89.6,9.2,-86.6,-5.3C-83.6,-19.8,-73,-32.9,-62,-44.6C-51,-56.3,-39.6,-66.6,-26.8,-74.7C-14,-82.8,0.2,-88.7,14.6,-88.7C29,-88.7,46.1,-82.8,58.7,-73.4L44.7,-76.4Z" transform="translate(100 100) scale(1.1)" />
                                        </svg>
                                        
                                        <!-- Check Icon -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white relative z-10 filter drop-shadow-md" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>

                                    <!-- Title -->
                                    <h3 class="text-3xl font-black text-slate-800 dark:text-white mb-3 tracking-tight">Yey, Berhasil!</h3>
                                    
                                    <!-- Message -->
                                    <p class="text-slate-500 dark:text-slate-400 text-base font-medium leading-relaxed mb-1">
                                        {{ session('success') ?? 'Permohonan Anda berhasil dikirim.' }}
                                    </p>
                                    <p class="text-slate-400 dark:text-slate-500 text-sm mb-10">
                                        Kami akan segera memprosesnya.
                                    </p>

                                    <!-- Buttons -->
                                    <div class="flex gap-4 w-full">
                                        <button @click="successModalOpen = false"
                                            class="flex-1 px-5 py-3.5 rounded-2xl bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-200 font-bold text-sm tracking-wide hover:bg-slate-300 dark:hover:bg-slate-600 transition-all active:scale-95">
                                            Tutup
                                        </button>
                                        <button @click="successModalOpen = false"
                                            class="flex-1 px-5 py-3.5 rounded-2xl text-white font-bold text-sm tracking-wide shadow-xl shadow-blue-500/30 transition-all transform hover:scale-105 active:scale-95 bg-gradient-to-r from-[#1A305E] to-blue-600 hover:to-blue-500">
                                            Mantap!
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @if(session('error'))
                        <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('layanan.permohonan-informasi.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                        @csrf
                        {{-- Personal Data --}}
                        <div class="space-y-6">
                            <h3 class="text-lg font-bold text-[#1A305E] dark:text-white flex items-center gap-2 border-b border-gray-100 pb-2">
                                <span class="w-8 h-8 rounded-full bg-[#D4AF37] text-white flex items-center justify-center text-sm">1</span>
                                Data Pribadi
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Nama Lengkap <span class="text-red-500">*</span></label>
                                    <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Masukkan nama sesuai KTP" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] transition-all outline-none bg-gray-50 dark:bg-slate-900 focus:bg-white dark:bg-slate-800" required />
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">No. KTP (NIK) <span class="text-red-500">*</span></label>
                                    <input type="text" name="nik" value="{{ old('nik') }}" placeholder="16 digit NIK" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] transition-all outline-none bg-gray-50 dark:bg-slate-900 focus:bg-white dark:bg-slate-800" required />
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700">Nomor KK (Opsional)</label>
                                    <input type="text" name="no_kk" value="{{ old('no_kk') }}" placeholder="Nomor Kartu Keluarga" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] transition-all outline-none bg-gray-50 dark:bg-slate-900 focus:bg-white dark:bg-slate-800" />
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Email <span class="text-red-500">*</span></label>
                                    <input type="email" name="email" value="{{ old('email') }}" placeholder="contoh@email.com" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] transition-all outline-none bg-gray-50 dark:bg-slate-900 focus:bg-white dark:bg-slate-800" required />
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">No. HP / WhatsApp <span class="text-red-500">*</span></label>
                                    <input type="text" name="no_hp" value="{{ old('no_hp') }}" placeholder="08xxxxxxxxxx" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] transition-all outline-none bg-gray-50 dark:bg-slate-900 focus:bg-white dark:bg-slate-800" required />
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Alamat <span class="text-red-500">*</span></label>
                                    <textarea name="alamat" rows="1" placeholder="Alamat lengkap domisili" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] transition-all outline-none bg-gray-50 dark:bg-slate-900 focus:bg-white dark:bg-slate-800 resize-none" required>{{ old('alamat') }}</textarea>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- Alamat moved to grid above --}}
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Pekerjaan <span class="text-red-500">*</span></label>
                                    <input type="text" name="pekerjaan" value="{{ old('pekerjaan') }}" placeholder="Pekerjaan saat ini" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] transition-all outline-none bg-gray-50 dark:bg-slate-900 focus:bg-white dark:bg-slate-800" required />
                                </div>
                            </div>
                        </div>

                        {{-- Upload Content --}}
                        <div class="space-y-6">
                            <h3 class="text-lg font-bold text-[#1A305E] dark:text-white flex items-center gap-2 border-b border-gray-100 pb-2">
                                <span class="w-8 h-8 rounded-full bg-[#D4AF37] text-white flex items-center justify-center text-sm">2</span>
                                Dokumen Pendukung
                            </h3>
                             <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Upload Foto KTP <span class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <input type="file" name="foto_ktp" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#1A305E]/10 file:text-[#1A305E] dark:text-white hover:file:bg-[#1A305E]/20 cursor-pointer border border-gray-300 rounded-lg" required />
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">Format: JPG, JPEG, PNG (Max. 5MB)</p>
                                </div>
                            </div>
                        </div>


                        {{-- Information Details --}}
                        <div class="space-y-6">
                             <h3 class="text-lg font-bold text-[#1A305E] dark:text-white flex items-center gap-2 border-b border-gray-100 pb-2">
                                <span class="w-8 h-8 rounded-full bg-[#D4AF37] text-white flex items-center justify-center text-sm">3</span>
                                Detail Informasi
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700">Nomor Pengeluaran (Badan Hukum)</label>
                                    <input type="text" name="nmr_pengesahan" value="{{ old('nmr_pengesahan') }}" placeholder="Jika mewakili badan hukum" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] transition-all outline-none bg-gray-50 dark:bg-slate-900 focus:bg-white dark:bg-slate-800" />
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Tujuan Penggunaan Informasi <span class="text-red-500">*</span></label>
                                    <input type="text" name="tujuan" value="{{ old('tujuan') }}" placeholder="Jelaskan tujuan permohonan" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] transition-all outline-none bg-gray-50 dark:bg-slate-900 focus:bg-white dark:bg-slate-800" required />
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Rincian Informasi Yang Dibutuhkan <span class="text-red-500">*</span></label>
                                <textarea name="rincian" rows="4" placeholder="Deskripsikan informasi yang Anda butuhkan secara detail" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1A305E] focus:border-[#1A305E] transition-all outline-none bg-gray-50 dark:bg-slate-900 focus:bg-white dark:bg-slate-800 resize-none" required>{{ old('rincian') }}</textarea>
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
