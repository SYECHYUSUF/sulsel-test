<div class="py-16 relative overflow-hidden bg-slate-50 dark:bg-slate-900 transition-colors duration-300">
    <!-- Decorative Background Elements -->
    <div class="absolute top-0 left-0 w-96 h-96 bg-ppid-primary/5 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2 pointer-events-none"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-ppid-accent/5 rounded-full blur-3xl translate-x-1/2 translate-y-1/2 pointer-events-none"></div>

    <div class="container mx-auto px-4 md:px-8 mb-12 text-center relative z-10" data-aos="fade-up">
        <h2 class="text-3xl md:text-5xl font-extrabold mb-4 bg-clip-text text-transparent bg-gradient-to-r from-ppid-primary via-ppid-primary-light to-ppid-primary-dark">
            Layanan Terpadu
        </h2>
        <p class="text-slate-600 dark:text-slate-400 text-lg max-w-2xl mx-auto">
            Akses cepat ke berbagai layanan digital pemerintah provinsi untuk kemudahan dan transparansi publik.
        </p>
    </div>

    <!-- Carousel Container -->
    <div class="relative w-full max-w-7xl mx-auto overflow-hidden group py-4">
        <!-- Gradient Masks -->
        <div class="absolute inset-y-0 left-0 w-16 md:w-32 bg-gradient-to-r from-slate-50 dark:from-slate-900 to-transparent z-20 pointer-events-none"></div>
        <div class="absolute inset-y-0 right-0 w-16 md:w-32 bg-gradient-to-l from-slate-50 dark:from-slate-900 to-transparent z-20 pointer-events-none"></div>

        <!-- Scrolling Wrapper -->
        <div class="flex w-max animate-marquee hover:[animation-play-state:paused]">
            
            {{-- Loop items multiple times for smooth infinite scroll --}}
            @for ($i = 0; $i < 6; $i++)
                
                {{-- ITEM 1: PILAR --}}
                <a href="https://pilarpersandian.sulselprov.go.id/web/" target="_blank" 
                   class="group/card relative flex items-center gap-5 bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 shadow-lg hover:shadow-xl hover:-translate-y-1 rounded-2xl p-5 mx-4 w-72 md:w-80 transition-all duration-300 overflow-hidden">
                    <div class="absolute top-0 right-0 w-16 h-16 bg-gradient-to-br from-blue-500/10 to-transparent rounded-bl-full -mr-4 -mt-4 transition-all group-hover/card:scale-150"></div>
                    
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-50 to-blue-100 dark:from-slate-700 dark:to-slate-600 flex items-center justify-center flex-shrink-0 shadow-inner group-hover/card:scale-110 transition-transform duration-300 relative z-10">
                        <img src="https://pilarpersandian.sulselprov.go.id/assets/img/logo.png" alt="PILAR Logo" class="w-10 h-10 object-contain drop-shadow-sm" onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name=P&background=0D8ABC&color=fff&size=64';">
                    </div>
                    <div class="relative z-10">
                        <h3 class="font-bold text-slate-800 dark:text-slate-100 text-lg group-hover/card:text-blue-600 dark:group-hover/card:text-blue-400 transition-colors">PILAR</h3>
                        <p class="text-slate-500 dark:text-slate-400 text-sm">Keamanan Informasi</p>
                    </div>
                </a>

                {{-- ITEM 2: Lapor --}}
                <a href="https://www.lapor.go.id/" target="_blank" 
                   class="group/card relative flex items-center gap-5 bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 shadow-lg hover:shadow-xl hover:-translate-y-1 rounded-2xl p-5 mx-4 w-72 md:w-80 transition-all duration-300 overflow-hidden">
                   <div class="absolute top-0 right-0 w-16 h-16 bg-gradient-to-br from-red-500/10 to-transparent rounded-bl-full -mr-4 -mt-4 transition-all group-hover/card:scale-150"></div>

                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-red-50 to-red-100 dark:from-slate-700 dark:to-slate-600 flex items-center justify-center flex-shrink-0 shadow-inner group-hover/card:scale-110 transition-transform duration-300 relative z-10">
                         <img src="https://www.lapor.go.id/themes/lapor/assets/images/logo.png" alt="Lapor Logo" class="w-10 h-auto object-contain drop-shadow-sm" onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name=L&background=ef4444&color=fff&size=64';">
                    </div>
                    <div class="relative z-10">
                        <h3 class="font-bold text-slate-800 dark:text-slate-100 text-lg group-hover/card:text-red-600 dark:group-hover/card:text-red-400 transition-colors">Lapor!</h3>
                        <p class="text-slate-500 dark:text-slate-400 text-sm">Layanan Aspirasi</p>
                    </div>
                </a>

                {{-- ITEM 3: Satu Data --}}
                <a href="https://satudata.sulselprov.go.id/dataset" target="_blank" 
                   class="group/card relative flex items-center gap-5 bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 shadow-lg hover:shadow-xl hover:-translate-y-1 rounded-2xl p-5 mx-4 w-72 md:w-80 transition-all duration-300 overflow-hidden">
                   <div class="absolute top-0 right-0 w-16 h-16 bg-gradient-to-br from-orange-500/10 to-transparent rounded-bl-full -mr-4 -mt-4 transition-all group-hover/card:scale-150"></div>

                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-orange-50 to-orange-100 dark:from-slate-700 dark:to-slate-600 flex items-center justify-center flex-shrink-0 shadow-inner group-hover/card:scale-110 transition-transform duration-300 relative z-10">
                        <img src="https://satudata.sulselprov.go.id/assets/portal/images/logo-opendata.png" alt="Satu Data Logo" class="w-10 h-10 object-contain drop-shadow-sm" onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name=SD&background=f97316&color=fff&size=64';">
                    </div>
                    <div class="relative z-10">
                        <h3 class="font-bold text-slate-800 dark:text-slate-100 text-lg group-hover/card:text-orange-600 dark:group-hover/card:text-orange-400 transition-colors">Satu Data</h3>
                        <p class="text-slate-500 dark:text-slate-400 text-sm">Portal Data Terbuka</p>
                    </div>
                </a>

                {{-- ITEM 4: PPID --}}
                <a href="https://ppid.sulselprov.go.id/" target="_blank" 
                   class="group/card relative flex items-center gap-5 bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 shadow-lg hover:shadow-xl hover:-translate-y-1 rounded-2xl p-5 mx-4 w-72 md:w-80 transition-all duration-300 overflow-hidden">
                   <div class="absolute top-0 right-0 w-16 h-16 bg-gradient-to-br from-ppid-primary/10 to-transparent rounded-bl-full -mr-4 -mt-4 transition-all group-hover/card:scale-150"></div>

                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-slate-50 to-pink-50 dark:from-slate-700 dark:to-slate-600 flex items-center justify-center flex-shrink-0 shadow-inner group-hover/card:scale-110 transition-transform duration-300 relative z-10">
                        <img src="{{ asset('images/logo-ppid.png') }}" alt="PPID Logo" class="w-10 h-10 object-contain drop-shadow-sm" onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name=PPID&background=800020&color=fff&size=64';">
                    </div>
                    <div class="relative z-10">
                        <h3 class="font-bold text-slate-800 dark:text-slate-100 text-lg group-hover/card:text-ppid-primary dark:group-hover/card:text-pink-400 transition-colors">PPID</h3>
                        <p class="text-slate-500 dark:text-slate-400 text-sm">Informasi Publik</p>
                    </div>
                </a>

            @endfor
        </div>
    </div>
</div>

<style>
    @keyframes marquee {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
    .animate-marquee {
        animation: marquee 60s linear infinite; /* Slower, smoother animation */
    }
</style>
