<section class="py-8 md:py-16 bg-white dark:bg-slate-900 font-['Plus_Jakarta_Sans']" x-data="{ active: null }">
    <div class="container mx-auto px-4">
        {{-- Section Header --}}
        <div class="text-center mb-12 md:mb-16 max-w-3xl mx-auto" data-aos="fade-down">
            <div class="inline-flex items-center gap-2 mb-4 px-5 py-2.5 bg-white dark:bg-white/10 border border-[#D4AF37]/30 dark:border-[#D4AF37]/20 rounded-full shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-[#D4AF37]">
                    <circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" x2="12" y1="17" y2="17"/>
                </svg>
                <span class="text-[#1A305E] dark:text-gray-200 text-xs md:text-sm font-bold tracking-wide uppercase">{{ __('messages.faq.badge') }}</span>
            </div>
            <h2 class="text-2xl sm:text-3xl md:text-5xl font-bold text-[#1A305E] dark:text-white mb-4 leading-tight tracking-tight">{{ __('messages.faq.title') }}</h2>
            <p class="text-base md:text-lg text-[#4A5568] dark:text-gray-400">{{ __('messages.faq.subtitle') }}</p>
        </div>

        <div class="max-w-4xl mx-auto space-y-4">
            @php
                $faqs = [
                    [
                        'q' => 'messages.faq.q1', 
                        'a' => 'messages.faq.a1'
                    ],
                    [
                        'q' => 'messages.faq.q2', 
                        'a' => 'messages.faq.a2'
                    ],
                    [
                        'q' => 'messages.faq.q3', 
                        'a' => 'messages.faq.a3'
                    ],
                ];
            @endphp

            @foreach($faqs as $index => $faq)
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-gray-200 dark:border-slate-700 overflow-hidden transition-all duration-300"
                 data-aos="fade-up" data-aos-delay="{{ $index * 50 }}"
                 :class="active === {{ $index }} ? 'ring-2 ring-[#D4AF37]/20 border-[#D4AF37] shadow-lg' : 'hover:border-[#D4AF37]/50'">
                
                <button @click="active = (active === {{ $index }} ? null : {{ $index }})" 
                        class="w-full flex items-center justify-between p-5 md:p-6 text-left focus:outline-none group">
                    <span class="text-base md:text-lg font-bold text-[#1A305E] dark:text-white leading-snug pr-4 group-hover:text-[#D4AF37] transition-colors">
                        {{ __($faq['q']) }}
                    </span>
                    <div class="flex-shrink-0 w-8 h-8 rounded-full bg-[#1A305E]/5 dark:bg-white/10 flex items-center justify-center group-hover:bg-[#1A305E] dark:group-hover:bg-[#D4AF37] group-hover:text-white dark:group-hover:text-[#1A305E] transition-all">
                        <svg :class="active === {{ $index }} ? 'rotate-180' : ''" class="w-5 h-5 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path d="m6 9 6 6 6-6"/>
                        </svg>
                    </div>
                </button>

                <div x-show="active === {{ $index }}" 
                     x-collapse 
                     x-cloak
                     class="px-5 pb-6 md:px-6 md:pb-8 pt-0">
                    <div class="h-px w-full bg-gray-100 dark:bg-slate-600 mb-4"></div>
                    <p class="text-sm md:text-base text-[#4A5568] dark:text-slate-300 leading-relaxed">
                        {{ __($faq['a']) }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>