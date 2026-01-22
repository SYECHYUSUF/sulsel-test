{{-- resources/views/components/sidebar-link.blade.php --}}
@props(['active', 'label', 'href' => '#', 'badge' => null])

@php
    // Efek smooth corner (inverted border radius) menggunakan pseudo-elements
    $activeClasses = 'bg-slate-50 text-[#1A305E] rounded-l-full ml-4 shadow-sm ' .
        'before:absolute before:-top-5 before:right-0 before:w-5 before:h-5 before:bg-transparent before:rounded-br-[20px] before:shadow-[10px_10px_0_10px_#f8fafc] ' .
        'after:absolute after:-bottom-5 after:right-0 after:w-5 after:h-5 after:bg-transparent after:rounded-tr-[20px] after:shadow-[10px_-10px_0_10px_#f8fafc]';

    $inactiveClasses = 'text-slate-300 hover:underline mx-4 rounded-lg';

    $classes = ($active ?? false) ? $activeClasses : $inactiveClasses;
    $iconColor = ($active ?? false) ? 'text-[#D4AF37]' : 'text-slate-400';
@endphp

<li>
    <a href="{{ $href }}" 
       {{ $attributes->merge(['class' => "relative flex items-center px-6 py-3.5 text-sm font-medium transition-all duration-200 $classes"]) }}
       {{-- BARIS KUNCI: Memberikan nama transisi hanya jika link aktif --}}
       @if($active) style="view-transition-name: active-sidebar-indicator;" @endif>
        
        <div class="w-5 h-5 mr-3 {{ $iconColor }}">
            {{ $slot }}
        </div>

        <span class="relative z-10">{{ $label }}</span>

        @if($badge)
            <span class="ml-auto bg-[#D4AF37] text-[#1A305E] py-0.5 px-2 rounded-full text-[10px] font-bold relative z-10">
                {{ $badge }}
            </span>
        @endif
    </a>
</li>