<section 
    x-data="{ scroll: 0 }" 
    @scroll.window="scroll = window.pageYOffset"
    class="py-12 md:py-24 bg-[#fafafa] relative overflow-hidden font-['Plus_Jakarta_Sans']">
    {{-- Decorative Elements dangan Parallax --}}
    <div class="absolute top-10 left-0 w-48 h-48 md:top-20 md:left-10 md:w-72 md:h-72 bg-[#1A305E]/5 rounded-full blur-3xl opacity-20 transition-transform duration-75" :style="`transform: translateY(${scroll * 0.1}px)`"></div>
    <div class="absolute bottom-10 right-0 w-48 h-48 md:bottom-20 md:right-10 md:w-72 md:h-72 bg-[#D4AF37]/5 rounded-full blur-3xl opacity-20 transition-transform duration-75" :style="`transform: translateY(${scroll * -0.1}px)`"></div>

    <div class="container mx-auto px-6 md:px-4 relative z-10">
        {{-- Section Header --}}
        <div class="text-center mb-12 md:mb-16 max-w-3xl mx-auto" data-aos="fade-down">
            <div class="inline-flex items-center gap-2 mb-4 px-4 py-2 md:px-5 md:py-2.5 bg-white border border-[#D4AF37]/30 rounded-full shadow-sm">
                <div class="w-2 h-2 bg-[#D4AF37] rounded-full animate-pulse"></div>
                <span class="text-[#1A305E] text-xs md:text-sm font-bold tracking-wide uppercase">{{ __('messages.timeline.badge') }}</span>
            </div>
            <h2 class="text-2xl sm:text-3xl md:text-5xl font-bold text-[#1A305E] mb-4 leading-tight">{{ __('messages.timeline.title') }}</h2>
            <p class="text-base md:text-xl text-[#4A5568] leading-relaxed">{{ __('messages.timeline.subtitle') }}</p>
        </div>

        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 md:gap-8 relative">
                
                {{-- Connecting Line --}}
                <div class="hidden md:block absolute top-16 left-0 right-0 h-1 bg-gradient-to-r from-[#1A305E]/10 via-[#D4AF37]/20 to-[#1A305E]/10" style="width: calc(100% - 8rem); left: 4rem;"></div>

                @php
                    $steps = [
                        [
                            'n' => '1', 
                            'title' => 'messages.timeline.step_1_title', 
                            'desc' => 'messages.timeline.step_1_desc', 
                            'dur' => 'Instant', 
                            'col' => 'from-[#1A305E] to-[#2a4a8b]',
                            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" /></svg>'
                        ],
                        [
                            'n' => '2', 
                            'title' => 'messages.timeline.step_2_title', 
                            'desc' => 'messages.timeline.step_2_desc', 
                            'dur' => '1-2 Hari', 
                            'col' => 'from-[#D4AF37] to-[#eac548]',
                            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751A11.959 11.959 0 0 1 12 2.714Z" /></svg>'
                        ],
                        [
                            'n' => '3', 
                            'title' => 'messages.timeline.step_3_title', 
                            'desc' => 'messages.timeline.step_3_desc', 
                            'dur' => '3-7 Hari', 
                            'col' => 'from-[#1A305E] to-[#2a4a8b]',
                            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12a7.5 7.5 0 1 1 15 0 7.5 7.5 0 0 1-15 0Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9" /></svg>'
                        ],
                        [
                            'n' => '4', 
                            'title' => 'messages.timeline.step_4_title', 
                            'desc' => 'messages.timeline.step_4_desc', 
                            'dur' => 'messages.timeline.step_4_duration', 
                            'col' => 'from-[#D4AF37] to-[#eac548]',
                            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" /></svg>'
                        ],
                    ];
                @endphp

                @foreach($steps as $index => $s)
                <div class="relative" data-aos="fade-up" data-aos-delay="{{ $index * 200 }}">
                    <div class="bg-white rounded-3xl p-6 md:p-8 shadow-sm hover:shadow-[0_20px_50px_-10px_rgba(26,48,94,0.15)] transition-all duration-300 border border-gray-100 hover:border-[#D4AF37]/30 group hover:-translate-y-2">
                        {{-- Number Badge --}}
                        <div class="absolute -top-3 -left-3 md:-top-4 md:-left-4 w-10 h-10 md:w-12 md:h-12 bg-gradient-to-br {{ $s['col'] }} rounded-2xl flex items-center justify-center shadow-lg z-10 text-white font-bold text-lg md:text-xl">
                            {{ $s['n'] }}
                        </div>
                        
                        {{-- Icon --}}
                        <div class="w-14 h-14 md:w-16 md:h-16 bg-gradient-to-br {{ $s['col'] }} rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-md text-white">
                            <div class="w-7 h-7 md:w-8 md:h-8">
                                {!! $s['icon'] !!}
                            </div>
                        </div>

                        <h3 class="text-lg md:text-xl font-bold text-[#1A305E] mb-3">{{ __($s['title']) }}</h3>
                        <p class="text-sm md:text-base text-[#4A5568] leading-relaxed mb-4">{{ __($s['desc']) }}</p>
                        
                        <div class="inline-flex items-center gap-2 px-4 py-2 bg-gray-50 rounded-full border border-gray-100">
                            <svg class="w-4 h-4 text-[#D4AF37]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span class="text-xs md:text-sm font-semibold text-[#1A305E]">{{ $s['dur'] }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Total Duration --}}
            <div class="mt-12 text-center" data-aos="zoom-in">
                <div class="inline-flex flex-col sm:flex-row items-center gap-3 px-6 py-4 md:px-8 bg-white rounded-2xl shadow-lg border border-[#D4AF37]/30">
                    <div class="flex items-center gap-3">
                        <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                        <p class="text-sm md:text-base text-[#4A5568]">
                            <strong class="text-[#1A305E]">{{ __('messages.timeline.total_time') }}</strong> 
                            {{ __('messages.timeline.max_days') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>