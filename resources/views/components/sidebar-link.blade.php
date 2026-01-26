{{-- resources/views/components/sidebar-link.blade.php --}}
@props(['active', 'label', 'href' => '#', 'badge' => null])

@php
    $activeClasses = 'bg-[#D4AF37] text-[#1A305E] shadow-lg shadow-[#D4AF37]/20';
    $inactiveClasses = 'text-slate-400 hover:text-white hover:bg-white/5';
    
    $classes = ($active ?? false) ? $activeClasses : $inactiveClasses;
    // Icon color handling
    $iconColor = ($active ?? false) ? 'text-[#1A305E]' : 'text-slate-400 group-hover:text-white';
@endphp

<li>
    <a wire:navigate href="{{ $href }}" 
       {{ $attributes->except('class') }}
       class="relative flex items-center py-3 text-sm font-semibold transition-all duration-200 overflow-hidden whitespace-nowrap rounded-xl mx-3 group {{ $classes }}"
       :class="sidebarOpen ? 'px-4 justify-start' : 'px-0 justify-center h-12 w-12 mx-auto'"
       @if($active) style="view-transition-name: active-sidebar-indicator;" @endif
    >
        
        <div class="w-6 h-6 shrink-0 transition-colors duration-200 {{ $iconColor }}"
             :class="sidebarOpen ? 'mr-3' : 'mr-0'">
            {{ $slot }}
        </div>

        <span class="relative z-10 transition-opacity duration-300 delay-100"
              x-show="sidebarOpen"
              x-transition:enter="transition ease-out duration-100"
              x-transition:enter-start="opacity-0"
              x-transition:enter-end="opacity-100"
        >
            {{ __($label) }}
        </span>

        @if($badge)
            <span class="ml-auto bg-[#D4AF37] text-[#1A305E] py-0.5 px-2 rounded-full text-[10px] font-bold relative z-10"
                  x-show="sidebarOpen">
                {{ $badge }}
            </span>
        @endif
    </a>
</li>