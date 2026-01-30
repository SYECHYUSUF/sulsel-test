@props([
    'trigger',                  
    'title' => 'Apakah Anda Yakin?',
    'description' => 'Tindakan ini tidak dapat dibatalkan.',
    'theme' => 'danger',        // Options: 'danger', 'warning', 'primary'
    'confirmText' => 'Ya, Lanjutkan',
    'cancelText' => 'Batal',
    'url' => '#',               // Action URL untuk form
    'method' => 'DELETE',       // Method spoofing: DELETE, PUT, POST
])

@php
    switch ($theme) {
        case 'warning':
            $colors = [
                'gradient' => 'from-amber-400 to-orange-500',
                'btn_primary' => 'from-amber-500 to-orange-600 hover:to-orange-500',
                'btn_shadow' => 'shadow-orange-500/30',
                'icon' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z' // Warning Triangle
            ];
            break;
        case 'primary':
            $colors = [
                'gradient' => 'from-[#1A305E] to-blue-500',
                'btn_primary' => 'from-[#1A305E] to-blue-600 hover:to-blue-500',
                'btn_shadow' => 'shadow-blue-500/30',
                'icon' => 'M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z' // Question Mark
            ];
            break;
        default: // danger
            $colors = [
                'gradient' => 'from-red-500 to-rose-600',
                'btn_primary' => 'from-red-600 to-rose-700 hover:to-rose-600',
                'btn_shadow' => 'shadow-red-500/30',
                'icon' => 'M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16' // Trash / Danger
            ];
            break;
    }
@endphp

<div x-show="{{ $trigger }}" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        
        {{-- Backdrop --}}
        <div x-show="{{ $trigger }}" @click="{{ $trigger }} = false" 
            class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm opacity-100"></div>
        </div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        {{-- Modal Panel --}}
        <div x-show="{{ $trigger }}"
            class="inline-block align-bottom bg-white dark:bg-slate-800 rounded-[2rem] text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-sm sm:w-full relative">
            
            <div class="px-8 pt-10 pb-8 relative z-10 flex flex-col items-center text-center">
                
                {{-- Icon Wrapper --}}
                <div class="relative w-24 h-24 mb-6 flex items-center justify-center transform hover:scale-105 transition-transform duration-300">
                    <svg viewBox="0 0 200 200" class="absolute inset-0 w-full h-full drop-shadow-xl" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="grad_{{ $theme }}" x1="0%" y1="0%" x2="100%" y2="100%">
                                {{-- Fallback for static rendering, actual colors handled by wrapper classes or CSS injection if needed. 
                                     Here we rely on predefined IDs for simplicity --}}
                                @if($theme == 'danger')
                                    <stop offset="0%" stop-color="#EF4444" /> <stop offset="100%" stop-color="#BE123C" />
                                @elseif($theme == 'warning')
                                    <stop offset="0%" stop-color="#F59E0B" /> <stop offset="100%" stop-color="#EA580C" />
                                @else
                                    <stop offset="0%" stop-color="#1A305E" /> <stop offset="100%" stop-color="#3B82F6" />
                                @endif
                            </linearGradient>
                        </defs>
                        <path fill="url(#grad_{{ $theme }})" d="M41.8,-71.3C54.7,-64.9,66.1,-54.6,75.4,-42.1C84.7,-29.6,91.9,-14.8,90.2,-0.9C88.6,12.9,78.1,25.8,67.4,36.9C56.7,48,45.8,57.2,33.5,63.9C21.2,70.6,7.5,74.7,-5.7,73.8C-18.9,72.9,-31.7,66.9,-44.1,60.2C-56.5,53.5,-68.5,46,-76.3,34.9C-84.1,23.8,-87.7,9.1,-84.8,-4.2C-81.9,-17.5,-72.5,-29.3,-62.4,-39.7C-52.3,-50.1,-41.5,-59.1,-29.6,-66.1C-17.7,-73.2,-4.7,-78.3,4.2,-79C13.1,-79.7,26.2,-76,33.1,-72.3L41.8,-71.3Z" transform="translate(100 100) scale(1.1)" />
                    </svg>
                    
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white relative z-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $colors['icon'] }}" />
                    </svg>
                </div>

                <h3 class="text-2xl font-black text-slate-800 dark:text-white mb-2 tracking-tight">
                    {{ $title }}
                </h3>
                
                <p class="text-slate-500 dark:text-slate-400 text-sm font-medium leading-relaxed mb-8">
                    {{ $description }}
                </p>

                <div class="flex gap-3 w-full">
                    <button @click="{{ $trigger }} = false" type="button"
                        class="flex-1 px-4 py-3 rounded-xl bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 font-bold text-sm hover:bg-slate-200 dark:hover:bg-slate-600 transition-all">
                        {{ $cancelText }}
                    </button>
                    
                    {{-- Form Submission for Actions --}}
                    @if($url !== '#')
                        <form action="{{ $url }}" method="POST" class="flex-1">
                            @csrf
                            @method($method)
                            <button type="submit"
                                class="w-full px-4 py-3 rounded-xl text-white font-bold text-sm shadow-lg transition-all transform hover:scale-105 active:scale-95 bg-gradient-to-r {{ $colors['btn_primary'] }} {{ $colors['btn_shadow'] }}">
                                {{ $confirmText }}
                            </button>
                        </form>
                    @else
                        {{-- Generic Button (if handled via JS/Alpine elsewhere) --}}
                        <button @click="$dispatch('confirm'); {{ $trigger }} = false"
                            class="flex-1 px-4 py-3 rounded-xl text-white font-bold text-sm shadow-lg transition-all transform hover:scale-105 active:scale-95 bg-gradient-to-r {{ $colors['btn_primary'] }} {{ $colors['btn_shadow'] }}">
                            {{ $confirmText }}
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>