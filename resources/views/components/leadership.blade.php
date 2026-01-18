<section class="py-12 md:py-24 bg-gradient-to-br from-violet-50 via-purple-50/50 to-white relative overflow-hidden font-['Plus_Jakarta_Sans']">
    {{-- Decorative Blur - Responsif (Dikecilkan di mobile) --}}
    <div class="absolute top-0 right-0 w-64 h-64 bg-violet-200 rounded-full blur-3xl opacity-20 -translate-y-1/2 translate-x-1/2"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-purple-200 rounded-full blur-3xl opacity-20 translate-y-1/2 -translate-x-1/2"></div>

    <div class="container mx-auto px-4 relative z-10">
        {{-- Section Header - Tipografi Adaptif --}}
        <div class="text-center mb-12 md:mb-16">
            <h2 class="text-3xl md:text-5xl font-bold text-gray-900 mb-4 tracking-tight leading-tight">
                Gubernur & Wakil Gubernur
            </h2>
            <p class="text-base md:text-lg text-gray-600 max-w-2xl mx-auto">
                Kepemimpinan yang berdedikasi untuk kemajuan dan transparansi informasi di Sulawesi Selatan
            </p>
        </div>

        {{-- Grid: 1 Kolom (Mobile) -> 2 Kolom (Tablet/Desktop) --}}
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8 max-w-5xl mx-auto">
            @php
                $leaders = [
                    [
                        'name' => 'Andi Sudirman Sulaiman',
                        'pos' => 'Gubernur Sulawesi Selatan',
                        'img' => 'gubernur.jpg',
                        'quote' => 'Transparansi dan akuntabilitas adalah kunci utama dalam membangun kepercayaan publik terhadap pemerintahan.',
                        'badge' => 'GUBERNUR'
                    ],
                    [
                        'name' => 'Fatmawati Rusdi',
                        'pos' => 'Wakil Gubernur Sulawesi Selatan',
                        'img' => 'wakil-gubernur.jpg',
                        'quote' => 'Kami berkomitmen penuh untuk memberikan pelayanan informasi publik yang berkualitas dan mudah diakses.',
                        'badge' => 'WAKIL GUBERNUR'
                    ]
                ];
            @endphp

            @foreach($leaders as $l)
            <div class="group bg-white rounded-[2rem] shadow-xl border border-gray-100 p-6 md:p-8 transition-all duration-500 hover:border-violet-300 hover:shadow-violet-100 flex flex-col items-center">
                {{-- Top Accent Line --}}
                <div class="h-2 w-full bg-gradient-to-r from-violet-600 to-purple-600 rounded-t-full absolute top-0 left-0 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                
                {{-- Profile Image --}}
                <div class="relative w-32 h-32 md:w-40 md:h-40 mb-6">
                    <div class="absolute inset-0 bg-gradient-to-br from-violet-400 to-purple-600 rounded-full opacity-20 blur-xl group-hover:opacity-40 transition-opacity"></div>
                    <div class="relative w-full h-full rounded-full overflow-hidden border-4 border-white shadow-2xl group-hover:scale-105 transition-transform duration-500">
                        <img src="{{ asset('images/' . $l['img']) }}" class="w-full h-full object-cover" alt="{{ $l['name'] }}">
                    </div>
                </div>

                {{-- Bio --}}
                <div class="text-center mb-6">
                    <span class="inline-block px-3 py-1 bg-violet-100 text-violet-700 text-[10px] font-bold tracking-widest uppercase rounded-full mb-3">
                        {{ $l['badge'] }}
                    </span>
                    <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-1 tracking-tight">{{ $l['name'] }}</h3>
                    <p class="text-sm md:text-base text-violet-600 font-semibold uppercase tracking-wide">{{ $l['pos'] }}</p>
                </div>

                {{-- Quote --}}
                <div class="mt-auto relative w-full">
                    <svg class="absolute -top-3 -left-2 w-8 h-8 text-violet-100" fill="currentColor" viewBox="0 0 32 32"><path d="M10 8v8H6v6h6v-6h-2V8h2zm12 0v8h-4v6h6v-6h-2V8h2z"/></svg>
                    <div class="bg-gray-50 rounded-2xl p-5 md:p-6 italic text-sm md:text-base text-gray-700 leading-relaxed border border-gray-100 group-hover:bg-violet-50/50 transition-colors">
                        "{{ $l['quote'] }}"
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>