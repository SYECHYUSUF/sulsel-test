<x-layout>
    <x-header />

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    <div class="relative" x-data="{
        loading: false,
        error: '',
        pengajuan: {{ isset($pengajuan) ? $pengajuan->toJson() : '[]' }},
        email: '{{ request('email') ?? '' }}',
        statusFilter: '{{ request('status') ?? '' }}',
        
        get filteredPengajuan() {
            if (!this.statusFilter) return this.pengajuan;
            
            return this.pengajuan.filter(item => {
                if (this.statusFilter === 'belum_direspon') {
                    return item.display_status_code === 'belum_direspon';
                }
                return item.status === this.statusFilter;
            });
        },
        
        async searchPengajuan() {
            if (!this.email) return;

            this.loading = true;
            this.error = '';
            
            try {
                const response = await fetch('{{ route('layanan.pengajuan-keberatan.check-status') }}', {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ 
                        email: this.email,
                        status: this.statusFilter 
                    })
                });
                
                const data = await response.json();
                
                if (response.ok && data.success) {
                    this.pengajuan = data.data;
                    this.error = '';
                    // Scroll otomatis ke hasil
                    setTimeout(() => {
                        document.getElementById('hasil-pencarian')?.scrollIntoView({ behavior: 'smooth' });
                    }, 100);
                } else {
                    this.pengajuan = [];
                    this.error = data.message || 'Tidak ada pengajuan keberatan ditemukan dengan email tersebut.';
                }
            } catch (error) {
                this.pengajuan = [];
                this.error = 'Terjadi kesalahan koneksi. Silakan coba lagi.';
                console.error('Error:', error);
            } finally {
                this.loading = false;
            }
        }
    }">

        {{-- Hero Section --}}
        <section
            class="relative bg-gradient-to-br from-ppid-primary via-[#2a4a7c] to-ppid-primary text-white overflow-hidden pb-32 md:pb-40">
            <div class="container mx-auto px-4 sm:px-6 relative z-10 text-center pt-16 md:pt-24">
                {{-- Judul --}}
                <h1
                    class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-extrabold mb-6 leading-tight tracking-tight">
                    <span class="bg-gradient-to-r from-white via-blue-100 to-white bg-clip-text text-transparent">
                        Cek Status Pengajuan
                    </span>
                </h1>

                {{-- Subtitle --}}
                <p
                    class="text-lg sm:text-xl md:text-2xl text-blue-100 leading-relaxed max-w-4xl mx-auto font-medium mb-12 md:mb-16">
                    Lacak perkembangan pengajuan keberatan Anda secara real-time
                </p>
            </div>

            {{-- Wave Divider --}}
            <div class="absolute bottom-0 left-0 right-0">
                <svg class="w-full h-auto" viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg"
                    preserveAspectRatio="none">
                    <path
                        d="M0 120L60 105C120 90 240 60 360 45C480 30 600 30 720 37.5C840 45 960 60 1080 67.5C1200 75 1320 75 1380 75L1440 75V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z"
                        fill="white" class="dark:fill-slate-900" />
                </svg>
            </div>
        </section>

        {{-- Email Input Section with Overlapping Effect --}}
        <section class="relative -mt-24 md:-mt-32 pb-16">
            <div class="container mx-auto px-4 sm:px-6 relative z-20">
                <div class="max-w-4xl mx-auto">
                    <div
                        class="bg-gradient-to-br from-white via-slate-50 to-blue-50/30 dark:from-slate-800 dark:via-slate-800 dark:to-slate-900 rounded-[2.5rem] shadow-2xl p-8 md:p-14 border-2 border-ppid-primary/10 dark:border-blue-500/30">

                        <div class="text-center mb-10">
                            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-ppid-primary dark:text-white mb-4">
                                Masukkan Email Anda
                            </h2>
                            <p class="text-slate-600 dark:text-slate-400">Gunakan email yang sama saat mengajukan
                                pengajuan keberatan</p>
                        </div>

                        <form @submit.prevent="searchPengajuan" class="max-w-2xl mx-auto">
                            <div class="mb-8">
                                <label class="block text-lg font-semibold text-ppid-primary dark:text-white mb-3">
                                    Email Pemohon
                                </label>
                                <div class="relative group">
                                    <input type="email" x-model="email" required
                                        class="w-full px-6 py-5 text-xl rounded-2xl border-2 border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 focus:ring-4 focus:ring-ppid-accent/30 focus:border-ppid-primary transition-all duration-300"
                                        placeholder="contoh: nama@email.com">
                                </div>
                            </div>

                            <!-- Filter Status -->
                            <div class="mb-8">
                                <label class="block text-lg font-semibold text-ppid-primary dark:text-white mb-3">
                                    Filter Status (Opsional)
                                </label>
                                <div class="relative">
                                    <select x-model="statusFilter"
                                        @change="if(email && pengajuan.length > 0) searchPengajuan()"
                                        class="w-full px-6 py-5 text-xl rounded-2xl border-2 border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 focus:ring-4 focus:ring-ppid-accent/30 focus:border-ppid-primary transition-all duration-300 appearance-none cursor-pointer">
                                        <option value="">Semua Status</option>
                                        <option value="belum_direspon">Belum Direspon</option>
                                        <option value="p">Dalam Proses</option>
                                        <option value="y">Disetujui</option>
                                        <option value="t">Ditolak</option>
                                        <option value="a">Dijawab</option>
                                    </select>
                                    <div
                                        class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none text-ppid-primary dark:text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <div x-show="error" x-transition
                                class="mb-8 p-5 bg-red-50 dark:bg-red-900/30 border-2 border-red-300 dark:border-red-700 rounded-2xl">
                                <p class="text-red-700 dark:text-red-300 font-semibold flex items-center gap-3">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    <span x-text="error"></span>
                                </p>
                            </div>

                            <button type="submit" :disabled="loading"
                                class="w-full bg-gradient-to-r from-ppid-primary to-[#2a4a7c] hover:from-[#152749] hover:to-[#1f3a65] text-white text-xl md:text-2xl font-bold py-6 px-8 rounded-2xl transition-all transform hover:scale-[1.02] shadow-xl flex items-center justify-center gap-4 disabled:opacity-50">
                                <svg x-show="loading" class="animate-spin w-7 h-7" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                <span x-text="loading ? 'Mencari...' : 'Cek Status Pengajuan Saya'"></span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        {{-- Results Section --}}
        <section id="hasil-pencarian" x-show="pengajuan.length > 0" x-cloak
            class="py-12 md:py-20 bg-slate-50 dark:bg-slate-900">
            <div class="container mx-auto px-4 sm:px-6">
                <div class="text-center mb-12">
                    <div
                        class="inline-flex flex-col sm:flex-row items-center gap-4 bg-white dark:bg-slate-800 px-8 py-5 rounded-2xl shadow-lg border-2 border-ppid-primary/10">
                        <h2 class="text-2xl sm:text-3xl font-bold text-ppid-primary dark:text-white">
                            Riwayat Pengajuan Keberatan
                        </h2>
                        <span class="bg-ppid-accent text-white px-4 py-1 rounded-full text-sm font-bold"
                            x-text="filteredPengajuan.length + ' Data'"></span>
                    </div>
                </div>

                <div class="space-y-10 max-w-7xl mx-auto">
                    <template x-for="item in filteredPengajuan" :key="item.id_pengajuan">
                        <div
                            class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg border-2 border-slate-100 dark:border-slate-700 overflow-hidden">

                            {{-- Card Header --}}
                            <div
                                class="p-6 bg-slate-50 dark:bg-slate-700/30 border-b-2 border-slate-100 dark:border-slate-700 flex flex-wrap justify-between items-center gap-4">
                                <div class="flex items-center gap-4">
                                    <div class="p-3 bg-ppid-primary rounded-xl shadow-md">
                                        <svg class="w-7 h-7 text-ppid-accent" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-lg font-bold text-slate-900 dark:text-white"
                                            x-text="item.no_pendaftaran"></div>
                                        <div class="text-sm text-slate-500"
                                            x-text="new Date(item.created_at).toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' })">
                                        </div>
                                    </div>
                                </div>

                                <span class="px-5 py-2 rounded-xl text-sm font-bold text-white shadow-md" :class="{
                                    'bg-red-500': item.display_status_code == 'belum_direspon',
                                    'bg-amber-500': item.status == 'p',
                                    'bg-emerald-600': item.status == 'y',
                                    'bg-rose-600': item.status == 't',
                                    'bg-indigo-600': item.status == 'a'
                                }" x-text="item.status_label_display"></span>
                            </div>

                            {{-- Card Body --}}
                            <div class="p-8 grid lg:grid-cols-2 gap-8">
                                {{-- Left: Details --}}
                                <div>
                                    <label
                                        class="flex items-center gap-2 text-xs font-bold text-ppid-accent uppercase tracking-wider mb-3">
                                        <span>Nama Pemohon</span>
                                    </label>
                                    <p class="text-lg font-bold text-ppid-primary dark:text-white leading-relaxed mb-6"
                                        x-text="item.nama_pemohon"></p>

                                    <label
                                        class="flex items-center gap-2 text-xs font-bold text-ppid-accent uppercase tracking-wider mb-3">
                                        <span>Kasus Posisi</span>
                                    </label>
                                    <p class="text-base text-slate-700 dark:text-slate-300 leading-relaxed whitespace-pre-line"
                                        x-text="item.kasus"></p>
                                </div>

                                {{-- Right: Response --}}
                                <div class="space-y-6">
                                    <div>
                                        <label
                                            class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3 block">Tanggapan
                                            Admin</label>
                                        <div
                                            class="bg-slate-50 dark:bg-slate-900 rounded-2xl p-6 border-2 border-slate-100 dark:border-slate-700 min-h-[100px]">
                                            {{-- Conditional Response Templates --}}
                                            <template x-if="item.status == 'p'">
                                                <p class="text-slate-600 italic">Menunggu review dari admin...</p>
                                            </template>

                                            <template x-if="item.feedback && item.status != 'p'">
                                                <p class="text-slate-800 dark:text-slate-200 whitespace-pre-line"
                                                    x-text="item.feedback"></p>
                                            </template>

                                            <template x-if="item.status == 't'">
                                                <div class="text-red-600 font-medium">
                                                    <p class="font-bold mb-1">Pengajuan Ditolak</p>
                                                    <p class="text-sm"
                                                        x-text="item.feedback || 'Silakan hubungi admin untuk informasi lebih lanjut.'">
                                                    </p>
                                                </div>
                                            </template>

                                            <template x-if="!item.feedback && item.status != 'p' && item.status != 't'">
                                                <p class="text-slate-400 italic">Belum ada tanggapan resmi.</p>
                                            </template>

                                            {{-- Tanggal Feedback --}}
                                            <template x-if="item.tgl_feedback">
                                                <div class="mt-4 pt-4 border-t border-slate-200 dark:border-slate-700">
                                                    <p class="text-xs text-slate-500">
                                                        Dijawab pada: <span
                                                            x-text="new Date(item.tgl_feedback).toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' })"></span>
                                                        <template x-if="item.feedback_by">
                                                            <span> oleh <span class="font-semibold"
                                                                    x-text="item.feedback_by.name"></span></span>
                                                        </template>
                                                    </p>
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </section>

        <x-footer />
</x-layout>