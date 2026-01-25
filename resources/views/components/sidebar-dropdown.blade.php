@props(['active' => false, 'label', 'icon'])

{{-- Ubah x-data agar 'open' selalu bernilai false saat inisialisasi --}}
<li x-data="{ open: false }" class="relative">
    {{-- Tombol Induk --}}
    <button @click="open = !open" 
        class="flex items-center w-full py-3.5 text-sm font-medium"
        :class="sidebarOpen ? 'ml-4 px-6 pr-10' : 'ml-0 px-0 justify-center'">
        
        <div class="w-5 h-5 flex-shrink-0"
            {{-- Ikon tetap berwarna emas jika 'active' adalah true, meski dropdown tertutup --}}
            :class="[
                sidebarOpen ? 'mr-3' : 'mr-0',
                ({{ $active ? 'true' : 'false' }} || open) ? 'text-[#D4AF37]' : 'text-slate-400 group-hover:text-[#D4AF37]'
            ]">
            {{ $icon }}
        </div>

        <template x-if="sidebarOpen">
            <div class="flex items-center flex-1">
                <span class="flex-1 text-left whitespace-nowrap" 
                      :class="{{ $active ? 'true' : 'false' }} ? 'text-white' : 'text-slate-300 group-hover:text-white'">
                    {{ $label }}
                </span>

                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" 
                    class="w-4 h-4 transition-transform duration-200 text-slate-400"
                    :class="open ? 'rotate-180' : ''">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </div>
        </template>
    </button>

    {{-- Daftar Menu Anak --}}
    <ul x-show="open && sidebarOpen" 
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        class="pb-2">
        {{ $slot }}
    </ul>
</li>