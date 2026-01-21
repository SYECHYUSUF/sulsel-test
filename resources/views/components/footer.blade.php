<footer class="relative bg-[#1A305E] text-white overflow-hidden font-['Plus_Jakarta_Sans']">
    {{-- 1. Background Image Overlay --}}
    <div class="absolute inset-0 pointer-events-none">
        <img 
            src="https://images.unsplash.com/photo-1761387787737-c850f5db6fa3?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxpbmRvbmVzaWElMjBnb3Zlcm5tZW50JTIwYnVpbGRpbmd8ZW58MXx8fHwxNzY4NTU0NjQwfDA&ixlib=rb-4.1.0&q=80&w=1080" 
            class="w-full h-full object-cover opacity-10" 
            alt="Sulsel Background"
        >
        <div class="absolute inset-0 bg-gradient-to-t from-[#1A305E] via-[#1A305E]/95 to-[#1A305E]/90"></div>
    </div>

    {{-- 2. Dot & Cultural Pattern Overlay --}}
    <div class="absolute inset-0 opacity-10 pointer-events-none" style="background-image: radial-gradient(circle, rgba(212, 175, 55, 0.3) 1px, transparent 1px); background-size: 20px 20px;"></div>
    
    <div class="container mx-auto px-6 md:px-4 py-12 md:py-16 relative z-10" data-aos="fade-up">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-10 lg:gap-12">
            
            {{-- Brand Section --}}
            <div class="sm:col-span-2 text-center sm:text-left">
                <div class="flex flex-col sm:flex-row items-center gap-3 mb-6">
                    <a href="">
                        <img src="{{ asset('images/ppid-putih.png') }}" class="h-10 md:h-12 w-auto" alt="Logo PPID">
                    </a>
                    <div class="text-center sm:text-left">
                    <h3 class="text-lg md:text-2xl font-bold uppercase tracking-tight text-white">{{ __('messages.header.title_1') }}</h3>
                        <p class="text-xs md:text-sm text-[#D4AF37]">{{ __('messages.header.title_2') }}</p>
                    </div>
                </div>
                <p class="text-gray-300 mb-8 leading-relaxed max-w-md mx-auto sm:mx-0 text-sm md:text-base">
                    {{ __('messages.footer.description') }}
                </p>
                
               {{-- MEDIA SOSIAL --}}
                <div class="flex justify-center sm:justify-start gap-4">
                    @php
                        $socials = [
                            ['name' => 'Facebook', 'link' => '#', 'icon' => '<path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>'],
                            ['name' => 'Twitter', 'link' => '#', 'icon' => '<path d="M4 4l11.733 16h4.267l-11.733 -16z M4 20l6.768 -6.768 M13.232 10.768l6.768 -6.768"></path>'],
                            ['name' => 'Instagram', 'link' => '#', 'icon' => '<rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>'],
                            ['name' => 'YouTube', 'link' => '#', 'icon' => '<path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.42a2.78 2.78 0 0 0-1.94 2C1 8.14 1 12 1 12s0 3.86.46 5.58a2.78 2.78 0 0 0 1.94 2c1.72.42 8.6.42 8.6.42s6.88 0 8.6-.42a2.78 2.78 0 0 0 1.94-2C23 15.86 23 12 23 12s0-3.86-.46-5.58z"></path><polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02"></polygon>']
                        ];
                    @endphp

                    @foreach($socials as $soc)
                        <a href="{{ $soc['link'] }}" title="{{ $soc['name'] }}" class="group relative w-11 h-11 bg-white/5 hover:bg-[#D4AF37] border border-white/10 hover:border-[#D4AF37] rounded-2xl flex items-center justify-center transition-all duration-500 hover:shadow-[0_0_20px_rgba(212,175,55,0.5)] hover:-translate-y-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="relative z-10 text-white/70 group-hover:text-[#1A305E] group-hover:scale-125 group-hover:rotate-12 transition-all duration-500">
                                {!! $soc['icon'] !!}
                            </svg>
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Links Sections --}}
            @php
                $sections = [
                    'messages.header.profile' => ['messages.footer.about_us', 'messages.footer.vision_mission', 'messages.footer.org_structure', 'messages.footer.tasks'],
                    'messages.header.services' => ['messages.footer.info_request', 'messages.footer.objection', 'messages.footer.check_status', 'messages.footer.service_survey'],
                    'messages.header.public_info' => ['messages.footer.latest_news', 'messages.footer.public_info_list', 'messages.footer.activity_gallery', 'messages.footer.contact']
                ];
            @endphp

            @foreach($sections as $title => $links)
            <div class="text-center sm:text-left">
                <h4 class="text-base md:text-lg font-bold mb-6 relative inline-block sm:block text-white">
                    {{ __($title) }}
                    <span class="absolute -bottom-2 left-1/2 -translate-x-1/2 sm:translate-x-0 sm:left-0 w-8 h-1 bg-[#D4AF37] rounded-full"></span>
                </h4>
                <ul class="space-y-3 mt-4">
                    @foreach($links as $link)
                    <li>
                        <a href="#" class="text-gray-400 hover:text-[#D4AF37] transition-colors duration-300 flex items-center justify-center sm:justify-start gap-2 group text-sm md:text-base">
                            <span class="w-1.5 h-1.5 bg-[#D4AF37] rounded-full opacity-0 group-hover:opacity-100 transition-opacity hidden sm:block"></span>
                            {{ __($link) }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endforeach
        </div>

        {{-- Bottom Copyright --}}
        <div class="mt-12 md:mt-16 pt-8 border-t border-white/10 flex flex-col md:flex-row justify-between items-center gap-6 text-[10px] md:text-sm text-gray-500 text-center md:text-left">
            <p>{{ __('messages.footer.rights') }}</p>
            <div class="flex gap-4 md:gap-6">
                <a href="#" class="hover:text-[#D4AF37] transition-colors">{{ __('messages.footer.privacy') }}</a>
                <a href="#" class="hover:text-[#D4AF37] transition-colors">{{ __('messages.footer.terms') }}</a>
            </div>
        </div>
    </div>
</footer>