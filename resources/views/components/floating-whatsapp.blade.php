<div x-data="{ isOpen: false }" class="relative font-['Plus_Jakarta_Sans']">
    <button
        @click="isOpen = !isOpen"
        class="fixed bottom-6 right-6 z-50 w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white rounded-full shadow-2xl hover:shadow-green-500/50 transition-all duration-300 flex items-center justify-center group hover:scale-110"
        aria-label="WhatsApp Help"
    >
        <template x-if="isOpen">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
        </template>
        <template x-if="!isOpen">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="group-hover:scale-110 transition-transform"><path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"/></svg>
        </template>
        
        <div x-show="!isOpen">
            <span class="absolute inset-0 rounded-full bg-green-500 animate-ping opacity-75"></span>
            <span class="absolute inset-0 rounded-full bg-green-500 animate-pulse"></span>
        </div>
    </button>

    <div 
        x-show="isOpen" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform translate-y-5"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform translate-y-5"
        class="fixed bottom-24 right-6 z-50 w-80 bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-200"
        style="display: none;"
    >
        <div class="bg-gradient-to-r from-green-500 to-green-600 p-6 text-white">
            <div class="flex items-center gap-3 mb-2">
                <div class="relative">
                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-green-600"><path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"/></svg>
                    </div>
                    <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-400 border-2 border-white rounded-full"></div>
                </div>
                <div>
                    <h4 class="font-bold text-lg">PPID Sulsel</h4>
                    <p class="text-xs text-white/90">Siap membantu Anda</p>
                </div>
            </div>
        </div>

        <div class="p-6 bg-gray-50">
            <div class="bg-white rounded-2xl p-4 shadow-sm mb-4 border border-gray-100">
                <p class="text-sm text-gray-700 leading-relaxed mb-3">
                    👋 Halo! Selamat datang di layanan bantuan PPID Sulawesi Selatan.
                </p>
                <p class="text-sm text-gray-700 leading-relaxed">
                    Ada yang bisa kami bantu?
                </p>
            </div>

            <a
              href="https://wa.me/6281234567890?text=Halo%20PPID%20Sulawesi%20Selatan,%20saya%20butuh%20bantuan%20mengenai%20informasi%20publik"
              target="_blank"
              rel="noopener noreferrer"
              class="block w-full bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white text-center px-6 py-4 rounded-2xl font-bold transition-all shadow-lg hover:shadow-xl text-base"
            >
              Mulai Chat WhatsApp
            </a>
        </div>

        <div class="px-6 pb-4 bg-gray-50 text-center">
            <p class="text-[10px] text-gray-500 uppercase tracking-widest font-bold">
                Jam Operasional
            </p>
            <p class="text-xs text-gray-600">
                Senin - Jumat, 08:00 - 16:00 WITA
            </p>
        </div>
    </div>
</div>