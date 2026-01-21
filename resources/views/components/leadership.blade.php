<section 
    x-data="{ scroll: 0 }" 
    @scroll.window="scroll = window.pageYOffset"
    class="relative py-16 md:py-24 bg-[#fafafa] overflow-hidden font-['Plus_Jakarta_Sans']">
    
    {{-- Parallax Background Elements --}}
    <div class="absolute top-0 right-0 w-72 h-72 bg-[#1A305E]/5 rounded-full blur-[100px] opacity-40 -translate-y-1/2 translate-x-1/3 transition-transform duration-75 ease-out"
         :style="`transform: translate(${30 + (scroll * 0.03)}%, ${-30 + (scroll * 0.03)}%)`"></div>
    <div class="absolute bottom-0 left-0 w-72 h-72 bg-[#D4AF37]/10 rounded-full blur-[100px] opacity-40 translate-y-1/2 -translate-x-1/3 transition-transform duration-75 ease-out"
         :style="`transform: translate(${-30 - (scroll * 0.03)}%, ${30 - (scroll * 0.03)}%)`"></div>

    <div class="container mx-auto px-6 relative z-10">
        {{-- Section Header --}}
        <div class="text-center mb-16 md:mb-20" data-aos="fade-down">
            <span class="text-[#D4AF37] font-bold tracking-[0.2em] text-[10px] uppercase mb-3 block">{{ __('messages.leadership.badge') }}</span>
            <h2 class="text-3xl md:text-4xl font-extrabold text-[#1A305E] mb-4 tracking-tight">{{ __('messages.leadership.title') }}</h2>
            <div class="w-12 h-1 bg-[#D4AF37] mx-auto rounded-full"></div>
        </div>

        {{-- Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 md:gap-12 max-w-4xl mx-auto">
            @php
                $leaders = [
                    [
                        'name' => 'messages.leadership.gov_name',
                        'pos' => 'messages.leadership.gov_pos',
                        'img' => 'gubernur.jpg',
                        'badge' => 'messages.leadership.gov_badge'
                    ],
                    [
                        'name' => 'messages.leadership.vice_gov_name',
                        'pos' => 'messages.leadership.vice_gov_pos',
                        'img' => 'wakil-gubernur.jpg',
                        'badge' => 'messages.leadership.vice_gov_badge'
                    ]
                ];
            @endphp

            @foreach($leaders as $index => $l)
            <div data-aos="fade-up" data-aos-delay="{{ $index * 200 }}" class="flex flex-col group">
                
                {{-- 1. Image Card --}}
                <div class="relative aspect-[4/5] w-full rounded-[2.5rem] md:rounded-[3rem] overflow-hidden shadow-[0_10px_30px_rgba(0,0,0,0.04)] border border-gray-100 transition-all duration-700 group-hover:shadow-xl group-hover:shadow-[rgba(26,48,94,0.15)] group-hover:-translate-y-1">
                    
                    {{-- === BARU: List Navy di Atas Card dengan Corner Radius === --}}
                    <div class="absolute top-0 inset-x-0 h-2 bg-[#1A305E] z-40 rounded-t-lg"></div>
                    {{-- ======================================================== --}}

                    <img src="{{ asset('images/' . $l['img']) }}" 
                         class="w-full h-full object-cover object-top transition-transform duration-1000 group-hover:scale-105 pt-1" 
                         alt="{{ $l['name'] }}">

                    {{-- KHUSUS WAGUB: Overlay Gelap Halus --}}
                    @if($l['badge'] == 'messages.leadership.vice_gov_badge')
                        <div class="absolute inset-0 bg-black/20 z-10 transition-opacity group-hover:opacity-30"></div>
                    @endif

                    {{-- Hover Overlay Gradient --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-[#1A305E]/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-20"></div>

                    {{-- SOSMED ICONS: Posisi Bawah Kiri --}}
                    <div class="absolute bottom-6 left-6 z-30 flex gap-2 translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500 ease-out">
                        <a href="#" class="w-9 h-9 bg-white/20 backdrop-blur-md border border-white/30 text-white rounded-xl flex items-center justify-center hover:bg-[#D4AF37] hover:border-[#D4AF37] transition-all transform hover:scale-110">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="#" class="w-9 h-9 bg-white/20 backdrop-blur-md border border-white/30 text-white rounded-xl flex items-center justify-center hover:bg-[#D4AF37] hover:border-[#D4AF37] transition-all transform hover:scale-110">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 1.366.062 2.633.332 3.608 1.282.888.871 1.213 2.083 1.291 3.703.072 1.492.094 1.992.094 5.834s-.022 4.342-.094 5.834c-.078 1.62-.404 2.833-1.291 3.703-.975.95-2.242 1.219-3.608 1.282-1.266.058-1.646.07-4.85.07s-3.584-.012-4.85-.07c-1.366-.062-2.633-.332-3.608-1.282-.888-.871-1.212-2.083-1.291-3.703-.072-1.492-.094-1.992-.094-5.834s.022-4.342.094-5.834c.078-1.62.404-2.833 1.291-3.703.975-.95 2.242-1.219 3.608-1.282 1.266-.058 1.646-.07 4.85-.07zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948s.014 3.667.072 4.947c.2 4.337 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072s3.667-.014 4.947-.072c4.338-.2 6.78-2.618 6.98-6.98.058-1.281.072-1.689.072-4.948s-.014-3.667-.072-4.947c-.2-4.358-2.618-6.78-6.98-6.98-1.28-.058-1.688-.072-4.947-.072zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                    </div>
                </div>

                {{-- 3. Bio Area --}}
                <div class="mt-5 text-center md:text-left md:pl-2">
                    <h3 class="text-lg md:text-xl font-bold text-[#1A305E] mb-0.5 tracking-tight group-hover:text-[#D4AF37] transition-colors">
                        {{ __($l['name']) }}
                    </h3>
                    <p class="text-[10px] md:text-xs text-[#D4AF37] font-bold uppercase tracking-[0.15em]">
                        {{ __($l['pos']) }}
                    </p>
                </div>

            </div>
            @endforeach
        </div>
    </div>
</section>