@props([
    'trigger',                  // Nama variabel AlpineJS untuk show/hide (Wajib)
    'status' => 'success',      // Options: 'success', 'error', 'info'
    'title' => null,            // Opsional, jika null akan pakai default based on status
    'description' => null,      // Opsional
])

@php
    // Konfigurasi Tampilan Berdasarkan Status
    switch ($status) {
        case 'error':
            $theme = [
                'gradient' => 'from-red-600 to-rose-400', // Warna Blob Merah
                'btn_primary' => 'from-red-600 to-rose-500 hover:to-rose-400',
                'btn_shadow' => 'shadow-red-500/30',
                'default_title' => 'Gagal!',
                'icon' => 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z' // X Circle
            ];
            break;
        case 'info':
            $theme = [
                'gradient' => 'from-sky-500 to-indigo-500', // Warna Blob Biru Langit
                'btn_primary' => 'from-sky-500 to-indigo-500 hover:to-indigo-400',
                'btn_shadow' => 'shadow-sky-500/30',
                'default_title' => 'Informasi',
                'icon' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z' // Info Circle
            ];
            break;
        default: // success
            $theme = [
                'gradient' => 'from-[#1A305E] to-blue-500', // Warna Blob Original (Biru Tua)
                'btn_primary' => 'from-[#1A305E] to-blue-600 hover:to-blue-500',
                'btn_shadow' => 'shadow-blue-500/30',
                'default_title' => 'Berhasil!',
                'icon' => 'M5 13l4 4L19 7' // Check
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
                
                {{-- Icon Wrapper with Dynamic Gradient Blob --}}
                <div class="relative w-28 h-28 mb-6 flex items-center justify-center transform hover:scale-105 transition-transform duration-300">
                    <svg viewBox="0 0 200 200" class="absolute inset-0 w-full h-full drop-shadow-2xl" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="blobGradient-{{ $status }}" x1="0%" y1="0%" x2="100%" y2="100%">
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
                            <stop offset="0%" stop-color="#1A305E" />
                            <stop offset="100%" stop-color="#3B82F6" />
                        </linearGradient>
                        <linearGradient id="grad_error" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" stop-color="#DC2626" />
                            <stop offset="100%" stop-color="#F43F5E" />
                        </linearGradient>
                        <linearGradient id="grad_info" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" stop-color="#0EA5E9" />
                            <stop offset="100%" stop-color="#6366F1" />
                        </linearGradient>

                        <path fill="url(#grad_{{ $status }})" d="M44.7,-76.4C58.9,-69.2,71.8,-59.1,81.6,-46.6C91.4,-34.1,98.1,-19.2,95.8,-4.9C93.5,9.4,82.2,23.1,70.8,34.1C59.4,45.1,47.9,53.4,36.1,60.8C24.3,68.2,12.2,74.7,-1.2,76.8C-14.6,78.9,-29.2,76.6,-42.6,69.9C-56,63.2,-68.2,52.1,-76.6,38.6C-85,25.1,-89.6,9.2,-86.6,-5.3C-83.6,-19.8,-73,-32.9,-62,-44.6C-51,-56.3,-39.6,-66.6,-26.8,-74.7C-14,-82.8,0.2,-88.7,14.6,-88.7C29,-88.7,46.1,-82.8,58.7,-73.4L44.7,-76.4Z" transform="translate(100 100) scale(1.1)" />
                    </svg>
                    
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white relative z-10 filter drop-shadow-md" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $theme['icon'] }}" />
                    </svg>
                </div>

                <h3 class="text-3xl font-black text-slate-800 dark:text-white mb-3 tracking-tight">
                    {{ $title ?? $theme['default_title'] }}
                </h3>
                
                <p class="text-slate-500 dark:text-slate-400 text-base font-medium leading-relaxed mb-8">
                    {{ $description ?? 'Proses telah selesai dilakukan.' }}
                </p>

                <div class="flex gap-4 w-full">
                    <button @click="{{ $trigger }} = false"
                        class="flex-1 px-5 py-3.5 rounded-2xl bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-200 font-bold text-sm tracking-wide hover:bg-slate-300 dark:hover:bg-slate-600 transition-all active:scale-95">
                        Tutup
                    </button>
                    
                    {{-- Tombol Primary Dynamic --}}
                    <button @click="{{ $trigger }} = false"
                        class="flex-1 px-5 py-3.5 rounded-2xl text-white font-bold text-sm tracking-wide shadow-xl transition-all transform hover:scale-105 active:scale-95 bg-gradient-to-r {{ $theme['btn_primary'] }} {{ $theme['btn_shadow'] }}">
                        {{ $status === 'error' ? 'Coba Lagi' : 'Oke Siap!' }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>