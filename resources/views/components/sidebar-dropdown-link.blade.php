{{-- resources/views/components/sidebar-dropdown-link.blade.php --}}
@props(['active', 'label', 'href' => '#'])

@php
    $activeClasses = 'bg-ppid-accent text-ppid-primary shadow-sm shadow-ppid-accent/20';
    $inactiveClasses = 'text-slate-400 hover:text-white hover:bg-white/10';

    $classes = ($active ?? false) ? $activeClasses : $inactiveClasses;
@endphp

<li>
    <a wire:navigate href="{{ $href }}" {{ $attributes->except('class') }}
        class="flex items-center py-2.5 px-4 mx-3 ml-12 text-xs font-semibold transition-all duration-200 rounded-lg group {{ $classes }}">
        <span class="whitespace-nowrap overflow-hidden text-ellipsis">{{ __($label) }}</span>
    </a>
</li>