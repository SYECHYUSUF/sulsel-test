@props([
    'show' => false,
    'message' => '',
    'theme' => 'success',  // Options: 'success', 'error', 'warning', 'info'
    'autoClose' => true,
    'duration' => 8000,
])

@php
    switch ($theme) {
        case 'error':
            $colors = [
                'gradient' => 'from-red-500 to-rose-600',
                'bg' => 'rgba(239, 68, 68, 0.15) 0%, rgba(220, 38, 38, 0.10) 100%',
                'border' => 'rgba(239, 68, 68, 0.3)',
                'overlay' => 'from-red-500/10 via-transparent to-rose-500/10',
                'icon_bg' => 'from-red-500 to-rose-600',
                'text' => 'text-red-900 dark:text-red-100',
                'icon_color' => 'text-red-600 dark:text-red-400',
                'icon' => 'M6 18L18 6M6 6l12 12' // X icon
            ];
            break;
        case 'warning':
            $colors = [
                'gradient' => 'from-amber-500 to-orange-600',
                'bg' => 'rgba(251, 146, 60, 0.15) 0%, rgba(249, 115, 22, 0.10) 100%',
                'border' => 'rgba(251, 146, 60, 0.3)',
                'overlay' => 'from-amber-500/10 via-transparent to-orange-500/10',
                'icon_bg' => 'from-amber-500 to-orange-600',
                'text' => 'text-amber-900 dark:text-amber-100',
                'icon_color' => 'text-amber-600 dark:text-amber-400',
                'icon' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z' // Triangle warning
            ];
            break;
        case 'info':
            $colors = [
                'gradient' => 'from-blue-500 to-indigo-600',
                'bg' => 'rgba(59, 130, 246, 0.15) 0%, rgba(79, 70, 229, 0.10) 100%',
                'border' => 'rgba(59, 130, 246, 0.3)',
                'overlay' => 'from-blue-500/10 via-transparent to-indigo-500/10',
                'icon_bg' => 'from-blue-500 to-indigo-600',
                'text' => 'text-blue-900 dark:text-blue-100',
                'icon_color' => 'text-blue-600 dark:text-blue-400',
                'icon' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z' // Info circle
            ];
            break;
        default: // success
            $colors = [
                'gradient' => 'from-emerald-500 to-green-600',
                'bg' => 'rgba(16, 185, 129, 0.15) 0%, rgba(5, 150, 105, 0.10) 100%',
                'border' => 'rgba(16, 185, 129, 0.3)',
                'overlay' => 'from-emerald-500/10 via-transparent to-green-500/10',
                'icon_bg' => 'from-emerald-500 to-green-600',
                'text' => 'text-emerald-900 dark:text-emerald-100',
                'icon_color' => 'text-emerald-600 dark:text-emerald-400',
                'icon' => 'M5 13l4 4L19 7' // Checkmark
            ];
            break;
    }
@endphp

@if($show || session($theme) || session('success') || session('error'))
    <div x-data="{ 
            show: {{ $show ? 'true' : 'false' }} || {{ session($theme) || session('success') || session('error') ? 'true' : 'false' }},
            autoClose: {{ $autoClose ? 'true' : 'false' }},
            duration: {{ $duration }}
         }" 
         x-show="show" 
         x-init="if (autoClose) { setTimeout(() => show = false, duration) }"
         x-transition:enter="transition ease-out duration-500"
         x-transition:enter-start="opacity-0 transform scale-90 translate-y-4"
         x-transition:enter-end="opacity-100 transform scale-100 translate-y-0"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100 transform scale-100"
         x-transition:leave-end="opacity-0 transform scale-95"
         class="mb-8 relative overflow-hidden rounded-2xl shadow-2xl"
         style="background: linear-gradient(135deg, {{ $colors['bg'] }}); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border: 1px solid {{ $colors['border'] }};">
        
        <!-- Gradient overlay -->
        <div class="absolute inset-0 bg-gradient-to-r {{ $colors['overlay'] }}"></div>
        
        <!-- Content -->
        <div class="relative p-6 flex items-start gap-4">
            <!-- Icon -->
            <div class="flex-shrink-0">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br {{ $colors['icon_bg'] }} flex items-center justify-center shadow-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $colors['icon'] }}" />
                    </svg>
                </div>
            </div>
            
            <!-- Message Content -->
            <div class="flex-1 pt-0.5">
                <h3 class="text-xl font-bold {{ $colors['text'] }} mb-2 flex items-center gap-2">
                    <span>{{ $slot->isEmpty() ? ($message ?: session('success') ?: session('error') ?: session($theme)) : '' }}</span>
                    @if($theme === 'success')
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ $colors['icon_color'] }} animate-pulse" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                    @endif
                </h3>
                
                <!-- Additional content from slot -->
                @if(!$slot->isEmpty())
                    <div class="text-sm {{ $colors['text'] }} opacity-90">
                        {{ $slot }}
                    </div>
                @endif
            </div>
            
            <!-- Close Button -->
            <button @click="show = false" 
                    class="flex-shrink-0 text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
@endif