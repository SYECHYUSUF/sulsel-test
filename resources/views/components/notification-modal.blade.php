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
                'icon' => 'M5 13l4 4L19 7', // Checkmark
                'default_title' => 'Berhasil!'
            ];
            break;
    }

    // Fallback titles for others
    if (!isset($colors['default_title'])) {
         switch ($theme) {
            case 'error': $colors['default_title'] = 'Gagal!'; break;
            case 'warning': $colors['default_title'] = 'Peringatan!'; break;
            case 'info': $colors['default_title'] = 'Informasi'; break;
            default: $colors['default_title'] = 'Notifikasi'; break;
         }
    }

    // Define trigger variable for Alpine
    $trigger = 'show';
@endphp

<div x-data="{ show: {{ $show ? 'true' : 'false' }} }" x-show="show" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
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
                
                {{-- Icon Wrapper with Dynamic Gradient Blob --}}
                <div class="relative w-28 h-28 mb-6 flex items-center justify-center transform hover:scale-105 transition-transform duration-300">
                    <svg viewBox="0 0 200 200" class="absolute inset-0 w-full h-full drop-shadow-2xl" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="blobGradient-{{ $theme }}" x1="0%" y1="0%" x2="100%" y2="100%">
                                {{-- Kita pecah class gradient untuk stop color secara manual agak sulit di SVG, 
                                     jadi kita gunakan CSS class pada path fill="url(#...)" atau manipulasi class wrapper.
                                     
                                     Solusi Cerdas: Kita gunakan class text pada wrapper div parent, lalu gunakan currentColor pada SVG stop,
                                     tapi karena props $theme['gradient'] adalah class tailwind background, kita gunakan pendekatan CSS inline sederhana untuk demo ini
                                     atau membiarkan struktur original tapi mengganti ID gradient agar unik.
                                --}}
                            </linearGradient>
                            {{-- Quick fix untuk gradient dinamis via Tailwind classes di parent SVG tidak support langsung ke defs stop-color.
                                 Kita gunakan fill="currentColor" pada path dan set text color di div pembungkus, 
                                 ATAU kita gunakan mask.
                                 
                                 Namun untuk menjaga desain "Blob" yang cantik, saya akan gunakan class Tailwind background pada Path secara langsung via class binding? Tidak bisa di SVG tag.
                                 
                                 Solusi Terbaik: Saya hardcode gradient di HTML component ini menggunakan variable $theme['gradient'] 
                                 pada div pembungkus blob, dan menggunakan mask-image atau sekadar div bulat.
                                 
                                 Tapi mari kita gunakan kembali SVG blob original dengan teknik class binding pada Path jika memungkinkan, 
                                 atau simplifikasi:
                            --}}
                        </defs>
                        {{-- Render Blob dengan warna solid gradient via CSS class di Path tidak valid. 
                             Kita ganti strategi: Gunakan Div Absolute dengan border-radius custom (Blob CSS) atau tetap SVG tapi styling manual.
                             Untuk kemudahan & keindahan, saya set Path fill ke 'url(#gradient)' dan definisikan gradient statis per status di bawah.
                        --}}
                        
                            <linearGradient id="grad_success" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" class="text-ppid-primary" stop-color="currentColor" />
                                <stop offset="100%" stop-color="#3B82F6" />
                            </linearGradient>
                            <linearGradient id="grad_error" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" stop-color="#DC2626" />
                                <stop offset="100%" stop-color="#F43F5E" />
                            </linearGradient>
                            <linearGradient id="grad_warning" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" stop-color="#F59E0B" />
                                <stop offset="100%" stop-color="#EA580C" />
                            </linearGradient>
                            <linearGradient id="grad_info" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" stop-color="#0EA5E9" />
                                <stop offset="100%" stop-color="#6366F1" />
                            </linearGradient>

                            <path fill="url(#grad_{{ $theme }})" d="M44.7,-76.4C58.9,-69.2,71.8,-59.1,81.6,-46.6C91.4,-34.1,98.1,-19.2,95.8,-4.9C93.5,9.4,82.2,23.1,70.8,34.1C59.4,45.1,47.9,53.4,36.1,60.8C24.3,68.2,12.2,74.7,-1.2,76.8C-14.6,78.9,-29.2,76.6,-42.6,69.9C-56,63.2,-68.2,52.1,-76.6,38.6C-85,25.1,-89.6,9.2,-86.6,-5.3C-83.6,-19.8,-73,-32.9,-62,-44.6C-51,-56.3,-39.6,-66.6,-26.8,-74.7C-14,-82.8,0.2,-88.7,14.6,-88.7C29,-88.7,46.1,-82.8,58.7,-73.4L44.7,-76.4Z" transform="translate(100 100) scale(1.1)" />
                    </svg>
                    
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white relative z-10 filter drop-shadow-md" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $colors['icon'] }}" />
                    </svg>
                </div>

                <h3 class="text-3xl font-black text-slate-800 dark:text-white mb-3 tracking-tight">
                    {{ $title ?? $colors['default_title'] }}
                </h3>
                
                <p class="text-slate-500 dark:text-slate-400 text-base font-medium leading-relaxed mb-8">
                    {{ $description ?? 'Proses telah selesai dilakukan.' }}
                </p>

                <div class="flex gap-4 w-full">
                    <button @click="{{ $trigger }} = false"
                        class="flex-1 px-5 py-3.5 rounded-2xl bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-200 font-bold text-sm tracking-wide hover:bg-slate-300 dark:hover:bg-slate-600 transition-all active:scale-95">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>