@props(['variant' => 'primary', 'size' => 'md'])

@php
    $baseStyles = "inline-flex items-center justify-center font-medium transition-all rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2";
    
    $variants = [
        'primary' => 'bg-violet-600 text-white hover:bg-violet-700 focus:ring-violet-500 shadow-sm',
        'secondary' => 'bg-white text-violet-600 border border-violet-600 hover:bg-violet-50 focus:ring-violet-500',
        'outline' => 'bg-transparent text-white border border-white hover:bg-white/10',
    ];

    $sizes = [
        'sm' => 'px-3 py-1.5 text-xs',
        'md' => 'px-5 py-2.5 text-sm',
        'lg' => 'px-8 py-3 text-base',
    ];
@endphp

<button {{ $attributes->merge(['class' => "$baseStyles {$variants[$variant]} {$sizes[$size]}"]) }}>
    {{ $slot }}
</button>