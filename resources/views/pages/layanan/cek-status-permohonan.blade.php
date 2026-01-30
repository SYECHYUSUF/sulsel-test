<x-layout>
    <x-header />

    <style>
        [x-cloak] { display: none !important; }
    </style>

    <div class="relative" x-data="{
        loading: false,
        error: '',
        permohonan: {{ isset($permohonan) ? $permohonan->toJson() : '[]' }},
        email: '{{ request('email') ?? '' }}',
        
        async searchPermohonan() {
            if (!this.email) return;

            this.loading = true;
            this.error = '';
            
            try {
                const response = await fetch('{{ route('layanan.cek-status-permohonan') }}', {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ email: this.email })
                });
                
                const data = await response.json();
                
                if (response.ok && data.success) {
                    this.permohonan = data.data;
                    this.error = '';
                    // Scroll otomatis ke hasil
                    setTimeout(() => {
                        document.getElementById('hasil-pencarian')?.scrollIntoView({ behavior: 'smooth' });
                    }, 100);
                } else {
                    this.permohonan = [];
                    this.error = data.message || 'Tidak ada permohonan ditemukan dengan email tersebut.';
                }
            } catch (error) {
                this.permohonan = [];
                this.error = 'Terjadi kesalahan koneksi. Silakan coba lagi.';
                console.error('Error:', error);
            } finally {
                this.loading = false;
            }
        }
    }">
    
    {{-- Hero Section Tanpa Icon --}}
    <section class="relative bg-gradient-to-br from-[#1A305E] via-[#2a4a7c] to-[#1A305E] text-white overflow-hidden pb-32 md:pb-40">
        <div class="container mx-auto px-4 sm:px-6 relative z-10 text-center pt-16 md:pt-24">
            {{-- Judul --}}
            <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-extrabold mb-6 leading-tight tracking-tight">
                <span class="bg-gradient-to-r from-white via-blue-100 to-white bg-clip-text text-transparent">
                    Cek Status Permohonan
                </span>
            </h1>
            
            {{-- Subtitle --}}
            <p class="text-lg sm:text-xl md:text-2xl text-blue-100 leading-relaxed max-w-4xl mx-auto font-medium mb-12 md:mb-16">
                Lacak perkembangan permohonan informasi Anda secara <span class="text-[#D4AF37] font-bold">real-time</span>
            </p>
        </div>
        
        {{-- Wave Divider --}}
        <div class="absolute bottom-0 left-0 right-0">
            <svg class="w-full h-auto" viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                <path d="M0 120L60 105C120 90 240 60 360 45C480 30 600 30 720 37.5C840 45 960 60 1080 67.5C1200 75 1320 75 1380 75L1440 75V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="white" class="dark:fill-slate-900"/>
            </svg>
        </div>
    </section>

    {{-- Email Input Section with Overlapping Effect --}}
    <section class="relative -mt-24 md:-mt-32 pb-16">
        <div class="container mx-auto px-4 sm:px-6 relative z-20">
            <div class="max-w-4xl mx-auto">
                <div class="bg-gradient-to-br from-white via-slate-50 to-blue-50/30 dark:from-slate-800 dark:via-slate-800 dark:to-slate-900 rounded-[2.5rem] shadow-2xl p-8 md:p-14 border-2 border-[#1A305E]/10 dark:border-blue-500/30">
                    
                    <div class="text-center mb-10">
                        <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-[#1A305E] dark:text-white mb-4">
                            Masukkan Email Anda
                        </h2>
                        <p class="text-slate-600 dark:text-slate-400">Gunakan email yang sama saat mengajukan permohonan informasi</p>
                    </div>

                    <form @submit.prevent="searchPermohonan" class="max-w-2xl mx-auto">
                        <div class="mb-8">
                            <div class="relative group">
                                <input type="email" x-model="email" required
                                    class="w-full px-6 py-5 text-xl rounded-2xl border-2 border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 focus:ring-4 focus:ring-[#D4AF37]/30 focus:border-[#1A305E] transition-all duration-300"
                                    placeholder="contoh: nama@email.com">
                            </div>
                        </div>
                        
                        <div x-show="error" x-transition class="mb-8 p-5 bg-red-50 dark:bg-red-900/30 border-2 border-red-300 dark:border-red-700 rounded-2xl">
                            <p class="text-red-700 dark:text-red-300 font-semibold flex items-center gap-3">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                                <span x-text="error"></span>
                            </p>
                        </div>

                        <button type="submit" :disabled="loading" class="w-full bg-gradient-to-r from-[#1A305E] to-[#2a4a7c] hover:from-[#152749] hover:to-[#1f3a65] text-white text-xl md:text-2xl font-bold py-6 px-8 rounded-2xl transition-all transform hover:scale-[1.02] shadow-xl flex items-center justify-center gap-4 disabled:opacity-50">
                            <svg x-show="loading" class="animate-spin w-7 h-7" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span x-text="loading ? 'Mencari...' : 'Cek Status Permohonan Saya'"></span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{-- Results Section --}}
    <section id="hasil-pencarian" x-show="permohonan.length > 0" x-cloak class="py-12 md:py-20 bg-slate-50 dark:bg-slate-900">
        <div class="container mx-auto px-4 sm:px-6">
            <div class="text-center mb-12">
                <div class="inline-flex flex-col sm:flex-row items-center gap-4 bg-white dark:bg-slate-800 px-8 py-5 rounded-2xl shadow-lg border-2 border-[#1A305E]/10">
                    <h2 class="text-2xl sm:text-3xl font-bold text-[#1A305E] dark:text-white">
                        Riwayat Permohonan
                    </h2>
                    <span class="bg-[#D4AF37] text-white px-4 py-1 rounded-full text-sm font-bold" x-text="permohonan.length + ' Data'"></span>
                </div>
            </div>
            
            <div class="space-y-10 max-w-7xl mx-auto">
                <template x-for="item in permohonan" :key="item.id_permohonan">
                    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg border-2 border-slate-100 dark:border-slate-700 overflow-hidden">
                        
                        {{-- Card Header --}}
                        <div class="p-6 bg-slate-50 dark:bg-slate-700/30 border-b-2 border-slate-100 dark:border-slate-700 flex flex-wrap justify-between items-center gap-4">
                            <div class="flex items-center gap-4">
                                <div class="p-3 bg-[#1A305E] rounded-xl shadow-md">
                                    <svg class="w-7 h-7 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                </div>
                                <div>
                                    <div class="text-lg font-bold text-slate-900 dark:text-white" x-text="item.email"></div>
                                    <div class="text-sm text-slate-500" x-text="new Date(item.created_at).toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' })"></div>
                                </div>
                            </div>
                            
                            <span class="px-5 py-2 rounded-xl text-sm font-bold text-white shadow-md" 
                                :class="{
                                    'bg-amber-500': item.status == 0,
                                    'bg-emerald-600': item.status == 1 || item.status == 2,
                                    'bg-rose-600': item.status == 3,
                                    'bg-slate-500': item.status == 4,
                                    'bg-indigo-600': item.status == 5
                                }" x-text="item.status_label"></span>
                        </div>

                        {{-- Card Body --}}
                        <div class="p-8 grid lg:grid-cols-2 gap-8">
                            {{-- Left: Details --}}
                            <div>
                                <label class="flex items-center gap-2 text-xs font-bold text-[#D4AF37] uppercase tracking-wider mb-3">
                                    <span>Perihal Permohonan</span>
                                </label>
                                <p class="text-lg font-bold text-[#1A305E] dark:text-white leading-relaxed" x-text="item.rincian"></p>
                            </div>

                            {{-- Only show these sections if NOT disposisi status --}}
                            <template x-if="item.status != 5">
                                {{-- Right: Response & Handler --}}
                                <div class="space-y-6">
                                    <div class="bg-gradient-to-br from-[#1A305E] to-[#2a4a7c] rounded-2xl p-5 text-white shadow-lg">
                                        <p class="text-xs font-bold text-[#D4AF37] uppercase mb-1">Ditangani Oleh</p>
                                        <p class="text-lg font-bold" x-text="item.skpd ? item.skpd.nm_skpd : 'Admin PPID Sulsel'"></p>
                                    </div>

                                    <div>
                                        <label class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3 block">Respon / Jawaban</label>
                                        <div class="bg-slate-50 dark:bg-slate-900 rounded-2xl p-6 border-2 border-slate-100 dark:border-slate-700 min-h-[100px]">
                                            {{-- Conditional Response Templates --}}
                                            <template x-if="item.status == 0">
                                                <p class="text-slate-600 italic">Menunggu verifikasi admin...</p>
                                            </template>
                                            
                                            <template x-if="item.jawaban && item.status != 0">
                                                <p class="text-slate-800 dark:text-slate-200 whitespace-pre-line" x-text="item.jawaban"></p>
                                            </template>

                                            <template x-if="item.status == 3">
                                                <div class="text-red-600 font-medium">
                                                    <p class="font-bold mb-1">Permohonan Ditolak</p>
                                                    <p class="text-sm" x-text="item.alasan"></p>
                                                </div>
                                            </template>

                                            <template x-if="!item.jawaban && item.status != 0 && item.status != 3">
                                                <p class="text-slate-400 italic">Belum ada respon resmi.</p>
                                            </template>

                                            {{-- File Download --}}
                                            <template x-if="item.file">
                                                <div class="mt-4 pt-4 border-t border-slate-200">
                                                    <a :href="`/storage/${item.file}`" target="_blank" 
                                                        class="inline-flex items-center gap-2 text-[#1A305E] dark:text-[#D4AF37] font-bold hover:underline">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                                        Download Dokumen Lampiran
                                                    </a>
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                </div>
                            </template>

                                {{-- SKPD Disposisi Tracking (Public View) --}}
                                <template x-if="item.disposisi && item.disposisi.length > 0">
                                    <div class="mt-6 pt-6 border-slate-200 dark:border-slate-700">
                                        <label class="text-xs font-bold text-[#D4AF37] uppercase tracking-wider mb-4 block">
                                            Tracking Disposisi SKPD
                                        </label>
                                        <div class="space-y-4">
                                            <template x-for="(disp, index) in item.disposisi" :key="index">
                                                <div class="bg-slate-100 dark:bg-slate-900 rounded-2xl p-5 border-2 border-slate-200 dark:border-slate-700">
                                                    <div class="flex justify-between items-start mb-3">
                                                        <div>
                                                            <h5 class="font-bold text-[#1A305E] dark:text-white" x-text="disp.skpd ? disp.skpd.nm_skpd : 'SKPD'"></h5>
                                                            <p class="text-xs text-slate-500 mt-1">
                                                                Disposisi: <span x-text="new Date(disp.created_at).toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' })"></span>
                                                            </p>
                                                        </div>
                                                        <span class="px-3 py-1 rounded-full text-xs font-bold"
                                                            :class="{
                                                                'bg-yellow-100 text-yellow-800': disp.status === 'pending',
                                                                'bg-blue-100 text-blue-800': disp.status === 'diproses',
                                                                'bg-green-100 text-green-800': disp.status === 'selesai',
                                                                'bg-red-100 text-red-800': disp.status === 'ditolak'
                                                            }"
                                                            x-text="disp.status.charAt(0).toUpperCase() + disp.status.slice(1)">
                                                        </span>
                                                    </div>

                                                    {{-- Catatan Disposisi --}}
                                                    <template x-if="disp.catatan_disposisi">
                                                        <div class="bg-blue-50 dark:bg-blue-900/30 border border-blue-200 dark:border-blue-800 rounded-xl p-3 mb-3">
                                                            <p class="text-xs font-semibold text-blue-800 dark:text-blue-300 mb-1">Catatan Admin:</p>
                                                            <p class="text-sm text-blue-700 dark:text-blue-200" x-text="disp.catatan_disposisi"></p>
                                                        </div>
                                                    </template>
                                                    
                                                    {{-- Respon SKPD --}}
                                                    <template x-if="disp.respon && disp.respon.length > 0">
                                                        <div>
                                                            <template x-for="(resp, respIndex) in disp.respon" :key="respIndex">
                                                                <div class="bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-xl p-4 mb-2">
                                                                    <p class="text-xs font-semibold text-green-800 dark:text-green-300 mb-2">
                                                                        Respon SKPD (<span x-text="new Date(resp.responded_at).toLocaleDateString('id-ID', { year: 'numeric', month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit' })"></span>):
                                                                    </p>
                                                                    <p class="text-sm text-slate-700 dark:text-slate-200 whitespace-pre-line" x-text="resp.respon"></p>
                                                                    
                                                                    <template x-if="resp.file">
                                                                        <a :href="`/storage/${resp.file}`" target="_blank"
                                                                            class="inline-flex items-center gap-2 text-green-600 dark:text-green-400 font-bold hover:underline mt-3 text-sm">
                                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                                            </svg>
                                                                            Download Lampiran Respon
                                                                        </a>
                                                                    </template>
                                                                </div>
                                                            </template>
                                                        </div>
                                                    </template>

                                                    <template x-if="!disp.respon || disp.respon.length === 0">
                                                        <p class="text-slate-500 dark:text-slate-400 italic text-sm">Belum ada respon dari SKPD ini.</p>
                                                    </template>
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </section>

    <x-footer />
</x-layout>