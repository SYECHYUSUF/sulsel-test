<x-layout>
    <x-header />

    <style>
        [x-cloak] { display: none !important; }
    </style>

    <div class="relative" x-data="{
        type: '{{ $type ?? 'permohonan' }}',
        loading: false,
        error: '',
        results: [],
        email: '{{ request('email') ?? '' }}',
        
        async searchStatus() {
            if (!this.email) return;

            this.loading = true;
            this.error = '';
            
            try {
                const response = await fetch('{{ route('layanan.cek-status.check') }}', {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ 
                        email: this.email,
                        type: this.type
                    })
                });
                
                const data = await response.json();
                
                if (response.ok && data.success) {
                    this.results = data.data;
                    this.error = '';
                    // Scroll otomatis ke hasil
                    setTimeout(() => {
                        document.getElementById('hasil-pencarian')?.scrollIntoView({ behavior: 'smooth' });
                    }, 100);
                } else {
                    this.results = [];
                    this.error = data.message || `Tidak ada ${this.type === 'permohonan' ? 'permohonan' : 'pengajuan keberatan'} ditemukan dengan email tersebut.`;
                }
            } catch (error) {
                this.results = [];
                this.error = 'Terjadi kesalahan koneksi. Silakan coba lagi.';
                console.error('Error:', error);
            } finally {
                this.loading = false;
            }
        },
        
        resetForm() {
            this.results = [];
            this.error = '';
        }
    }">

        {{-- Hero Section --}}
        <section class="relative bg-gradient-to-br from-ppid-primary via-ppid-primary-light to-ppid-primary text-white overflow-hidden pb-32 md:pb-40">
            <div class="container mx-auto px-4 sm:px-6 relative z-10 text-center pt-16 md:pt-24">
                {{-- Judul --}}
                <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-extrabold mb-6 leading-tight tracking-tight">
                    <span class="bg-gradient-to-r from-white via-blue-100 to-white bg-clip-text text-transparent">
                        Cek Status
                    </span>
                </h1>
                
                {{-- Subtitle --}}
                <p class="text-lg sm:text-xl md:text-2xl text-blue-100 leading-relaxed max-w-4xl mx-auto font-medium mb-12 md:mb-16">
                    Lacak perkembangan permohonan informasi dan pengajuan keberatan Anda secara real-time
                </p>
            </div>
            
            {{-- Wave Divider --}}
            <div class="absolute bottom-0 left-0 right-0">
                <svg class="w-full h-auto" viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                    <path d="M0 120L60 105C120 90 240 60 360 45C480 30 600 30 720 37.5C840 45 960 60 1080 67.5C1200 75 1320 75 1380 75L1440 75V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="white" class="dark:fill-slate-900"/>
                </svg>
            </div>
        </section>

        {{-- Form Section with Overlapping Effect --}}
        <section class="relative -mt-24 md:-mt-32 pb-16">
            <div class="container mx-auto px-4 sm:px-6 relative z-20">
                <div class="max-w-4xl mx-auto">
                    <div class="bg-gradient-to-br from-white via-slate-50 to-blue-50/30 dark:from-slate-800 dark:via-slate-800 dark:to-slate-900 rounded-[2.5rem] shadow-2xl p-8 md:p-14 border-2 border-ppid-primary/10 dark:border-blue-500/30">
                        
                        <div class="text-center mb-10">
                            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-ppid-primary dark:text-white mb-4">
                                Pilih Jenis Layanan
                            </h2>
                            <p class="text-slate-600 dark:text-slate-400">Pilih jenis layanan yang ingin Anda cek statusnya</p>
                        </div>

                        {{-- Request Type Selector --}}
                        <div class="mb-10">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <button type="button" @click="type = 'permohonan'; resetForm()"
                                    :class="type === 'permohonan' ? 'bg-gradient-to-r from-ppid-primary to-ppid-primary-light text-white shadow-xl scale-105' : 'bg-white dark:bg-slate-700 text-slate-700 dark:text-slate-300 hover:shadow-lg'"
                                    class="relative p-6 rounded-2xl border-2 transition-all duration-300 group"
                                    :class="type === 'permohonan' ? 'border-ppid-accent' : 'border-transparent'">
                                    <div class="flex items-center gap-4">
                                        <div class="p-3 rounded-xl transition-colors" :class="type === 'permohonan' ? 'bg-white/10' : 'bg-slate-100 dark:bg-slate-600'">
                                            <svg class="w-8 h-8 transition-colors" :class="type === 'permohonan' ? 'text-ppid-accent' : 'text-ppid-primary dark:text-slate-300'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                        </div>
                                        <div class="text-left">
                                            <div class="font-bold text-lg mb-1">Permohonan Informasi</div>
                                            <div class="text-sm opacity-90">Cek status permohonan informasi publik</div>
                                        </div>
                                    </div>
                                    <div x-show="type === 'permohonan'" class="absolute top-3 right-3">
                                        <svg class="w-6 h-6 text-ppid-accent" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                </button>

                                <button type="button" @click="type = 'keberatan'; resetForm()"
                                    :class="type === 'keberatan' ? 'bg-gradient-to-r from-ppid-primary to-ppid-primary-light text-white shadow-xl scale-105' : 'bg-white dark:bg-slate-700 text-slate-700 dark:text-slate-300 hover:shadow-lg'"
                                    class="relative p-6 rounded-2xl border-2 transition-all duration-300 group"
                                    :class="type === 'keberatan' ? 'border-ppid-accent' : 'border-transparent'">
                                    <div class="flex items-center gap-4">
                                        <div class="p-3 rounded-xl transition-colors" :class="type === 'keberatan' ? 'bg-white/10' : 'bg-slate-100 dark:bg-slate-600'">
                                            <svg class="w-8 h-8 transition-colors" :class="type === 'keberatan' ? 'text-ppid-accent' : 'text-ppid-primary dark:text-slate-300'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                            </svg>
                                        </div>
                                        <div class="text-left">
                                            <div class="font-bold text-lg mb-1">Pengajuan Keberatan</div>
                                            <div class="text-sm opacity-90">Cek status pengajuan keberatan</div>
                                        </div>
                                    </div>
                                    <div x-show="type === 'keberatan'" class="absolute top-3 right-3">
                                        <svg class="w-6 h-6 text-ppid-accent" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                </button>
                            </div>
                        </div>

                        <form @submit.prevent="searchStatus" class="max-w-2xl mx-auto">
                            <div class="mb-8">
                                <label class="block text-lg font-semibold text-ppid-primary dark:text-white mb-3">
                                    Email <span x-text="type === 'permohonan' ? 'Pemohon' : 'Pengaju'"></span>
                                </label>
                                <div class="relative group">
                                    <input type="email" x-model="email" required
                                        class="w-full px-6 py-5 text-xl rounded-2xl border-2 border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 focus:ring-4 focus:ring-ppid-accent/30 focus:border-ppid-primary transition-all duration-300"
                                        placeholder="contoh: nama@email.com">
                                </div>
                            </div>
                            
                            <div x-show="error" x-transition class="mb-8 p-5 bg-red-50 dark:bg-red-900/30 border-2 border-red-300 dark:border-red-700 rounded-2xl">
                                <p class="text-red-700 dark:text-red-300 font-semibold flex items-center gap-3">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                                    <span x-text="error"></span>
                                </p>
                            </div>

                            <button type="submit" :disabled="loading" class="w-full bg-gradient-to-r from-ppid-primary to-ppid-primary-light hover:from-ppid-primary-hover hover:to-ppid-primary text-white text-xl md:text-2xl font-bold py-6 px-8 rounded-2xl transition-all transform hover:scale-[1.02] shadow-xl flex items-center justify-center gap-4 disabled:opacity-50">
                                <svg x-show="loading" class="animate-spin w-7 h-7" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span x-text="loading ? 'Mencari...' : 'Cek Status Saya'"></span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        {{-- Results Section --}}
        <section id="hasil-pencarian" x-show="results.length > 0" x-cloak class="py-12 md:py-20 bg-slate-50 dark:bg-slate-900">
            <div class="container mx-auto px-4 sm:px-6">
                <div class="text-center mb-12">
                    <div class="inline-flex flex-col sm:flex-row items-center gap-4 bg-white dark:bg-slate-800 px-8 py-5 rounded-2xl shadow-lg border-2 border-ppid-primary/10">
                        <h2 class="text-2xl sm:text-3xl font-bold text-ppid-primary dark:text-white">
                            <span x-text="type === 'permohonan' ? 'Riwayat Permohonan Informasi' : 'Riwayat Pengajuan Keberatan'"></span>
                        </h2>
                        <span class="bg-ppid-accent text-white px-4 py-1 rounded-full text-sm font-bold" x-text="results.length + ' Data'"></span>
                    </div>
                </div>
                
                <div class="space-y-10 max-w-7xl mx-auto">
                    {{-- Permohonan Informasi Results --}}
                    <template x-if="type === 'permohonan'">
                        <div>
                            <template x-for="item in results" :key="item.id_permohonan">
                                @include('pages.layanan.partials.permohonan-result-card')
                            </template>
                        </div>
                    </template>

                    {{-- Pengajuan Keberatan Results --}}
                    <template x-if="type === 'keberatan'">
                        <div>
                            <template x-for="item in results" :key="item.id_pengajuan">
                                @include('pages.layanan.partials.keberatan-result-card')
                            </template>
                        </div>
                    </template>
                </div>
            </div>
        </section>

    </div>

    <x-footer />
</x-layout>
