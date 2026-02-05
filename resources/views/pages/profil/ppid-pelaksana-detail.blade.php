<x-layout>
    <x-header />

    <div class="min-h-screen bg-gray-50 dark:bg-slate-900 pb-20 relative overflow-x-hidden">
        
        {{-- Hero Header with Pattern --}}
        <div class="relative bg-ppid-primary h-[400px] overflow-hidden">
            {{-- Modern Geometric Pattern Overlay --}}
            <div class="absolute inset-0 opacity-10">
                <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                    <pattern id="motif" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse">
                        <path d="M0 40L40 0H20L0 20M40 40V20L20 40" class="stroke-ppid-accent" stroke-width="2" fill="none"/>
                    </pattern>
                    <rect width="100%" height="100%" fill="url(#motif)"/>
                </svg>
            </div>
            
            {{-- Gradient Overlay --}}
            <div class="absolute inset-0 bg-gradient-to-b from-ppid-primary/80 via-ppid-primary/90 to-ppid-primary"></div>

            {{-- Breadcrumb & Title Area --}}
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-center">
                {{-- Breadcrumb --}}
                <nav class="inline-flex items-center space-x-2 text-sm text-gray-300 mb-6 bg-white/5 backdrop-blur-sm px-4 py-2 rounded-full border border-white/10">
                    <a href="/" class="hover:text-ppid-accent transition-colors">Beranda</a>
                    <span class="text-gray-500">/</span>
                    <a href="/ppid-pelaksana" class="hover:text-ppid-accent transition-colors">PPID Pelaksana</a>
                    <span class="text-gray-500">/</span>
                    <span class="text-ppid-accent font-medium">Detail</span>
                </nav>
                
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white tracking-tight mb-3">
                    Profil <span class="text-ppid-accent">SKPD</span>
                </h1>
                <p class="text-gray-200 text-base md:text-lg max-w-2xl mx-auto leading-relaxed">
                    Informasi detail mengenai Pejabat Pengelola Informasi dan Dokumentasi Pelaksana
                </p>
            </div>
        </div>

        {{-- Floating Profile Card --}}
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-40 z-10">
            <div class="bg-white dark:bg-slate-800 rounded-[2.5rem] shadow-2xl overflow-hidden border border-gray-100 dark:border-slate-700 backdrop-blur-xl">
                <div class="p-10 md:p-14 relative overflow-hidden">
                    {{-- Decorative Blur - Simplified --}}
                    <div class="absolute top-0 right-0 w-48 h-48 bg-ppid-accent/5 rounded-full blur-2xl -mr-24 -mt-24 pointer-events-none"></div>

                    <div class="flex flex-col md:flex-row gap-8 items-center md:items-center relative z-10">
                        {{-- Logo --}}
                        <div class="flex-shrink-0 relative">
                            <!-- Removed blur effect for cleaner look -->
                            <div class="relative w-32 h-32 md:w-40 md:h-40 bg-white dark:bg-slate-700 rounded-3xl flex items-center justify-center shadow-xl border-2 border-gray-100 dark:border-slate-600">
                                <img src="{{ $skpd->logo ? asset('storage/logo-skpd/' . $skpd->logo) : asset('images/logo-sulsel.png') }}" 
                                     alt="Logo {{ $skpd->nm_skpd }}" 
                                     class="w-28 h-28 md:w-32 md:h-32 object-contain p-2">
                            </div>
                        </div>

                        {{-- Info --}}
                        <div class="flex-1 text-center md:text-left">
                            <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-gradient-to-r from-ppid-accent/15 to-ppid-accent/5 text-[#C4941F] rounded-full text-xs font-bold mb-4 border border-ppid-accent/30">
                                <span class="w-2 h-2 rounded-full bg-ppid-accent"></span>
                                PPID PELAKSANA PROVINSI SULSEL
                            </div>
                            <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-ppid-primary dark:text-white mb-5 leading-tight">
                                {{ $skpd->nm_skpd }}
                            </h2>
                            <div class="flex flex-wrap gap-4 justify-center md:justify-start">
                                @if($skpd->alamat)
                                <div class="flex items-center gap-2 text-gray-600 dark:text-gray-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-ppid-accent flex-shrink-0"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                                    <span class="text-base line-clamp-1 text-left">{{ $skpd->alamat }}</span>
                                </div>
                                @endif
                                @if($skpd->website || $skpd->situs)
                                <a href="{{ $skpd->website ?? $skpd->situs }}" target="_blank" class="flex items-center gap-2 text-gray-600 hover:text-ppid-primary dark:text-gray-300 dark:hover:text-ppid-accent transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-ppid-accent flex-shrink-0"><circle cx="12" cy="12" r="10"/><line x1="2" x2="22" y1="12" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1 4-10z"/></svg>
                                    <span class="text-base font-medium">Kunjungi Website</span>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Main Content Grid --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                {{-- Left Content (2 Cols) --}}
                <div class="lg:col-span-2 space-y-10">
                    
                    {{-- Leadership Cards - Split --}}
                    @if($skpd->kadis || $skpd->sek)
                    <section>
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-12 h-12 rounded-xl bg-ppid-primary flex items-center justify-center text-white shadow-lg shadow-ppid-primary/20">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                            </div>
                            <h3 class="text-2xl md:text-3xl font-bold text-ppid-primary dark:text-white">Pimpinan SKPD</h3>
                        </div>

                        <div class="grid md:grid-cols-2 gap-6">
                            @if($skpd->kadis)
                            <div class="bg-white dark:bg-slate-800 rounded-2xl p-8 border border-gray-100 dark:border-slate-700 shadow-lg hover:shadow-xl transition-shadow relative overflow-hidden group">
                                <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-ppid-primary/3 to-ppid-accent/3 rounded-bl-[3rem] transition-transform group-hover:scale-110"></div>
                                <p class="text-sm font-bold uppercase tracking-wider text-ppid-accent mb-3">Kepala Dinas</p>
                                <h4 class="text-xl md:text-2xl font-bold text-ppid-primary dark:text-white leading-relaxed">{{ $skpd->kadis }}</h4>
                            </div>
                            @endif

                            @if($skpd->sek)
                            <div class="bg-white dark:bg-slate-800 rounded-2xl p-8 border border-gray-100 dark:border-slate-700 shadow-lg hover:shadow-xl transition-shadow relative overflow-hidden group">
                                <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-ppid-primary/3 to-ppid-accent/3 rounded-bl-[3rem] transition-transform group-hover:scale-110"></div>
                                <p class="text-sm font-bold uppercase tracking-wider text-ppid-accent mb-3">Sekretaris</p>
                                <h4 class="text-xl md:text-2xl font-bold text-ppid-primary dark:text-white leading-relaxed">{{ $skpd->sek }}</h4>
                            </div>
                            @endif
                        </div>
                    </section>
                    @endif

                    {{-- Visi Misi Section --}}
                    @if($skpd->visimisi && $skpd->visimisi !== '')
                    <section class="bg-white dark:bg-slate-800 rounded-3xl p-8 shadow-lg border border-gray-100 dark:border-slate-700 relative overflow-hidden">
                        {{-- Decorative --}}
                        <div class="absolute top-0 left-0 w-1.5 h-full bg-gradient-to-b from-ppid-primary to-ppid-accent"></div>
                        
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-10 h-10 rounded-lg bg-ppid-accent/10 flex items-center justify-center text-ppid-accent">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                            </div>
                            <h3 class="text-2xl md:text-3xl font-bold text-ppid-primary dark:text-white">Visi & Misi</h3>
                        </div>

                        <div class="prose prose-lg prose-slate dark:prose-invert max-w-none">
                            <div class="text-gray-700 dark:text-gray-200 text-base md:text-lg leading-relaxed content-html">
                                {!! $skpd->visimisi !!}
                            </div>
                        </div>
                    </section>
                    @endif

                    {{-- Content Tabs/Accordion Group --}}
                    <div class="space-y-6">
                         {{-- Tupoksi --}}
                        @if($skpd->tupoksi && $skpd->tupoksi !== '' && $skpd->tupoksi !== 'data.php')
                        <div class="bg-white dark:bg-slate-800 rounded-3xl p-8 shadow-lg border border-gray-100 dark:border-slate-700">
                             <div class="flex items-center gap-4 mb-6">
                                <div class="w-10 h-10 rounded-lg bg-ppid-primary/10 flex items-center justify-center text-ppid-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/></svg>
                                </div>
                                <h3 class="text-2xl md:text-3xl font-bold text-ppid-primary dark:text-white">Tugas Pokok & Fungsi</h3>
                            </div>
                            <div class="prose prose-lg prose-slate dark:prose-invert max-w-none">
                                <div class="text-gray-700 dark:text-gray-200 text-base md:text-lg leading-relaxed content-html">
                                    {!! $skpd->tupoksi !!}
                                </div>
                            </div>
                        </div>
                        @endif

                        {{-- Tujuan --}}
                        @if($skpd->tujuan && $skpd->tujuan !== '')
                        <div class="bg-white dark:bg-slate-800 rounded-3xl p-8 shadow-lg border border-gray-100 dark:border-slate-700">
                             <div class="flex items-center gap-4 mb-6">
                                <div class="w-10 h-10 rounded-lg bg-ppid-primary/10 flex items-center justify-center text-ppid-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                </div>
                                <h3 class="text-2xl md:text-3xl font-bold text-ppid-primary dark:text-white">Tujuan</h3>
                            </div>
                            <div class="prose prose-lg prose-slate dark:prose-invert max-w-none">
                                <div class="text-gray-700 dark:text-gray-200 text-base md:text-lg leading-relaxed content-html">
                                    {!! $skpd->tujuan !!}
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Right Sidebar (1 Col) --}}
                <div class="lg:col-span-1">
                    {{-- Sticky Contact Card --}}
                    <div class="lg:sticky lg:top-24">
                        <div class="bg-gradient-to-br from-ppid-primary to-[#2d4a8f] rounded-[2rem] p-8 text-white shadow-2xl relative overflow-hidden">
                            {{-- Pattern Overlay --}}
                            <div class="absolute inset-0 opacity-10">
                                <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="100%" cy="0" r="100" class="fill-ppid-accent" />
                                    <circle cx="0" cy="100%" r="80" class="fill-ppid-accent" />
                                </svg>
                            </div>

                            <h3 class="text-xl font-bold mb-6 flex items-center gap-2 relative z-10">
                                <span class="w-8 h-8 rounded-lg bg-white/20 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                </span>
                                Kontak Kami
                            </h3>

                            <div class="space-y-6 relative z-10">
                                {{-- Phone --}}
                                @if($skpd->no_tlp)
                                <div>
                                    <p class="text-white/70 text-sm uppercase font-bold tracking-wider mb-1.5">Telepon</p>
                                    <a href="tel:{{ $skpd->no_tlp }}" class="text-xl font-bold hover:text-ppid-accent transition-colors">{{ $skpd->no_tlp }}</a>
                                </div>
                                @endif

                                {{-- Email --}}
                                @if($skpd->email)
                                <div>
                                    <p class="text-white/70 text-sm uppercase font-bold tracking-wider mb-1.5">Email</p>
                                    <a href="mailto:{{ $skpd->email }}" class="text-lg font-medium break-all hover:text-ppid-accent transition-colors">{{ $skpd->email }}</a>
                                </div>
                                @endif
                                
                                {{-- Address --}}
                                @if($skpd->alamat)
                                <div>
                                    <p class="text-white/70 text-sm uppercase font-bold tracking-wider mb-1.5">Alamat</p>
                                    <p class="text-base leading-relaxed text-white/95">{{ $skpd->alamat }}</p>
                                </div>
                                @endif
                            </div>

                            {{-- Divider --}}
                            <div class="h-px bg-white/20 my-8"></div>

                            {{-- Back Button --}}
                            <a href="/ppid-pelaksana" class="block w-full bg-ppid-accent hover:bg-[#bfa035] text-ppid-primary text-center py-4 rounded-xl font-bold transition-all duration-300 shadow-lg transform hover:-translate-y-1">
                                Kembali ke Daftar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <button id="scrollToTopBtn" class="fixed bottom-8 right-8 bg-ppid-primary text-white p-4 rounded-full shadow-2xl opacity-0 translate-y-10 transition-all duration-300 z-50 hover:bg-[#2d4a8f]">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m18 15-6-6-6 6"/></svg>
    </button>


    <script>
        // Scroll to Top Button Logic
        const scrollBtn = document.getElementById('scrollToTopBtn');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                scrollBtn.classList.remove('opacity-0', 'translate-y-10');
            } else {
                scrollBtn.classList.add('opacity-0', 'translate-y-10');
            }
        });
        scrollBtn.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    </script>
</x-layout>
