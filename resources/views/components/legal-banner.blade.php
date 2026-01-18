<section class="py-12 md:py-20 bg-gradient-to-br from-violet-900 via-purple-900 to-violet-800 relative overflow-hidden font-['Plus_Jakarta_Sans']">
    {{-- Decorative Cultural Pattern Overlay --}}
    <div class="absolute inset-0 opacity-10 pointer-events-none" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cpath d=\'M54.627 0l.83.828-1.415 1.415L51.8 0h2.827zM5.373 0l-.83.828L5.96 2.243 8.2 0H5.374zM48.97 0l3.657 3.657-1.414 1.414L46.143 0h2.828zM11.03 0L7.372 3.657 8.787 5.07 13.857 0H11.03zm32.284 0L49.8 6.485 48.384 7.9l-7.9-7.9h2.83zM16.686 0L10.2 6.485 11.616 7.9l7.9-7.9h-2.83zm20.97 0l9.315 9.314-1.414 1.414L34.828 0h2.83zM22.344 0L13.03 9.314l1.414 1.414L25.172 0h-2.83zM32 0l12.142 12.142-1.414 1.414L30 .828 17.272 13.556 15.858 12.14 28 0zm0 0\' fill=\'%23ffffff\' fill-opacity=\'1\' fill-rule=\'evenodd\'/%3E%3C/svg%3E')"></div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-5xl mx-auto">
            {{-- Header Section: Stack on Mobile, Row on Small Screens up --}}
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-10 text-center sm:text-left">
                <div class="w-16 h-16 bg-white/10 backdrop-blur-sm rounded-2xl flex items-center justify-center text-white flex-shrink-0 shadow-lg border border-white/10">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m16 16 3-8 3 8c-.87.65-1.92 1-3 1s-2.13-.35-3-1Z"/><path d="m2 16 3-8 3 8c-.87.65-1.92 1-3 1s-2.13-.35-3-1Z"/><path d="M7 21h10"/><path d="M12 3v18"/></svg>
                </div>
                <div class="text-white">
                    <h3 class="text-2xl md:text-3xl font-bold mb-1 tracking-tight">Dasar Hukum & Regulasi</h3>
                    <p class="text-sm md:text-base text-white/80">Layanan PPID berdasarkan peraturan perundang-undangan</p>
                </div>
            </div>

            {{-- Grid Section: 1 col (Mobile) -> 2 cols (Tablet) -> 3 cols (Desktop) --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @php
                    $laws = [
                        ['law' => 'UU No. 14 Tahun 2008', 'title' => 'Keterbukaan Informasi Publik'],
                        ['law' => 'PP No. 61 Tahun 2010', 'title' => 'Pelaksanaan UU KIP'],
                        ['law' => 'Perpres No. 33 Tahun 2020', 'title' => 'Standar Harga Satuan'],
                    ];
                @endphp
                @foreach($laws as $l)
                <div class="bg-white/10 backdrop-blur-md hover:bg-white/20 rounded-2xl p-6 border border-white/20 hover:border-white/40 transition-all duration-300 flex items-start gap-4 group">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="text-white mt-1 group-hover:scale-110 transition-transform"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    <div class="text-white">
                        <p class="text-xs font-bold opacity-80 uppercase tracking-widest mb-1">{{ $l['law'] }}</p>
                        <p class="text-base font-semibold leading-tight">{{ $l['title'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            
            {{-- Bottom Disclaimer: Responsive Width and Line Height --}}
            <div class="mt-10 md:mt-12 text-center max-w-3xl mx-auto px-4">
                <p class="text-sm md:text-base text-white/70 leading-relaxed font-medium">
                    Komitmen kami untuk memberikan layanan informasi publik yang transparan, akuntabel, dan sesuai dengan ketentuan hukum yang berlaku di wilayah Provinsi Sulawesi Selatan.
                </p>
            </div>
        </div>
    </div>
</section>