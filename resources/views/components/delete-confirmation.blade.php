@props(['trigger' => 'showDeleteModal', 'itemName' => 'data ini'])

<div x-show="{{ $trigger }}" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div x-show="{{ $trigger }}" @click="{{ $trigger }} = false" 
            class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm opacity-100"></div>
        </div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div x-show="{{ $trigger }}"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="inline-block align-bottom bg-white dark:bg-slate-800 rounded-[2rem] text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-sm sm:w-full relative">
            
            <!-- Modal Content -->
            <div class="px-8 pt-10 pb-8 relative z-10 flex flex-col items-center text-center">
                
                <!-- Icon Wrapper with Blob Background -->
                <div class="relative w-28 h-28 mb-6 flex items-center justify-center transform hover:scale-105 transition-transform duration-300">
                    <!-- Blob SVG -->
                    <svg viewBox="0 0 200 200" class="absolute inset-0 w-full h-full drop-shadow-2xl" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="deleteBlobGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" style="stop-color:#991B1B;stop-opacity:1" /> <!-- Red 800 -->
                                <stop offset="100%" style="stop-color:#EF4444;stop-opacity:1" /> <!-- Red 500 -->
                            </linearGradient>
                        </defs>
                        <path fill="url(#deleteBlobGradient)" d="M44.7,-76.4C58.9,-69.2,71.8,-59.1,81.6,-46.6C91.4,-34.1,98.1,-19.2,95.8,-4.9C93.5,9.4,82.2,23.1,70.8,34.1C59.4,45.1,47.9,53.4,36.1,60.8C24.3,68.2,12.2,74.7,-1.2,76.8C-14.6,78.9,-29.2,76.6,-42.6,69.9C-56,63.2,-68.2,52.1,-76.6,38.6C-85,25.1,-89.6,9.2,-86.6,-5.3C-83.6,-19.8,-73,-32.9,-62,-44.6C-51,-56.3,-39.6,-66.6,-26.8,-74.7C-14,-82.8,0.2,-88.7,14.6,-88.7C29,-88.7,46.1,-82.8,58.7,-73.4L44.7,-76.4Z" transform="translate(100 100) scale(1.1)" />
                    </svg>
                    
                    <!-- Trash Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white relative z-10 filter drop-shadow-md" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </div>

                <!-- Title -->
                <h3 class="text-3xl font-black text-slate-800 dark:text-white mb-3 tracking-tight">Hapus Data?</h3>
                
                <!-- Message -->
                <p class="text-slate-500 dark:text-slate-400 text-base font-medium leading-relaxed mb-10">
                    {{ $slot }}
                </p>

                <!-- Buttons -->
                <div class="flex gap-4 w-full">
                    <button @click="{{ $trigger }} = false"
                        class="flex-1 px-5 py-3.5 rounded-2xl bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-200 font-bold text-sm tracking-wide hover:bg-slate-300 dark:hover:bg-slate-600 transition-all active:scale-95">
                        Batal
                    </button>
                    <button @click="confirmDelete()"
                        class="flex-1 px-5 py-3.5 rounded-2xl text-white font-bold text-sm tracking-wide shadow-xl shadow-red-500/30 transition-all transform hover:scale-105 active:scale-95 bg-gradient-to-r from-red-700 to-red-500 hover:to-red-400">
                        Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
