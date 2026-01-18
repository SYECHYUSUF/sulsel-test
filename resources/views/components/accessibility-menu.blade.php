<div x-data="{ 
    isOpen: false,
    isDragging: false,
    pos: { 
        x: localStorage.getItem('acc-pos-x') || 24, 
        y: localStorage.getItem('acc-pos-y') || window.innerHeight - 100 
    },
    settings: {
        contrast: localStorage.getItem('acc-contrast') === 'true',
        monochrome: localStorage.getItem('acc-mono') === 'true',
        dyslexic: localStorage.getItem('acc-dys') === 'true',
        bold: localStorage.getItem('acc-bold') === 'true',
        links: localStorage.getItem('acc-links') === 'true',
        titles: localStorage.getItem('acc-titles') === 'true',
        fontSize: parseInt(localStorage.getItem('acc-font-size')) || 16
    },
    
    {{-- Fungsi Seret (Drag) --}}
    startDragging(e) {
        this.isDragging = true;
        const move = (event) => {
            if (!this.isDragging) return;
            const touch = event.type === 'touchmove' ? event.touches[0] : event;
            this.pos.x = touch.clientX - 28;
            this.pos.y = touch.clientY - 28;
        };
        const stop = () => {
            this.isDragging = false;
            {{-- Snap ke sisi kiri atau kanan --}}
            this.pos.x = (this.pos.x + 28 > window.innerWidth / 2) ? window.innerWidth - 70 : 16;
            {{-- Batasi agar tidak keluar layar atas/bawah --}}
            this.pos.y = Math.max(20, Math.min(window.innerHeight - 80, this.pos.y));
            
            localStorage.setItem('acc-pos-x', this.pos.x);
            localStorage.setItem('acc-pos-y', this.pos.y);
            window.removeEventListener('mousemove', move);
            window.removeEventListener('mouseup', stop);
            window.removeEventListener('touchmove', move);
            window.removeEventListener('touchend', stop);
        };
        window.addEventListener('mousemove', move);
        window.addEventListener('mouseup', stop);
        window.addEventListener('touchmove', move);
        window.addEventListener('touchend', stop);
    },

    toggle(key) {
        this.settings[key] = !this.settings[key];
        localStorage.setItem('acc-' + key, this.settings[key]);
        this.applyToBody();
    },
    adjustFont(val) {
        this.settings.fontSize = Math.max(12, Math.min(24, this.settings.fontSize + val));
        localStorage.setItem('acc-font-size', this.settings.fontSize);
        this.applyToBody();
    },
    applyToBody() {
        const body = document.body;
        body.classList.toggle('high-contrast', this.settings.contrast);
        body.classList.toggle('monochrome', this.settings.monochrome);
        body.classList.toggle('dyslexic-font', this.settings.dyslexic);
        body.classList.toggle('bold-text', this.settings.bold);
        body.classList.toggle('highlight-links', this.settings.links);
        body.classList.toggle('highlight-titles', this.settings.titles);
        body.style.fontSize = this.settings.fontSize + 'px';
    },
    reset() {
        this.settings = { contrast: false, monochrome: false, dyslexic: false, bold: false, links: false, titles: false, fontSize: 16 };
        localStorage.clear();
        this.applyToBody();
    }
}" x-init="applyToBody()" class="relative z-[9999] font-['Plus_Jakarta_Sans']">

    {{-- 1. TOMBOL AKSESIBILITAS (Movable) --}}
    <button 
        @mousedown="startDragging($event)" 
        @touchstart="startDragging($event)"
        @click="if(!isDragging) isOpen = !isOpen"
        class="fixed w-14 h-14 bg-violet-600 text-white rounded-full shadow-2xl flex items-center justify-center cursor-move hover:scale-110 active:scale-95 transition-transform z-[9999]"
        :style="'left: ' + pos.x + 'px; top: ' + pos.y + 'px;'"
        aria-label="Aksesibilitas">
        
        {{-- Ikon Orang (Aksesibilitas Universal) --}}
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="4" r="1"/>
            <path d="m18 19 1-7-6 1"/>
            <path d="m5 8 3-3 5.5 3-2.36 3.5"/>
            <path d="M4.24 14.5a5 5 0 0 0 6.88 1.83"/>
            <path d="M14.5 17.5c-2.5 0-2.5-2.5-5-2.5"/>
        </svg>
    </button>

    {{-- 2. PANEL KONTROL (Akan muncul di sebelah tombol) --}}
    <div x-show="isOpen" @click.away="isOpen = false" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-90"
        x-transition:enter-end="opacity-100 scale-100"
        class="fixed w-80 bg-white rounded-[24px] shadow-[0_20px_50px_rgba(0,0,0,0.3)] border border-gray-100 overflow-hidden z-[9998]"
        :style="'top: ' + (pos.y > window.innerHeight / 2 ? pos.y - 420 : pos.y + 70) + 'px; left: ' + (pos.x > window.innerWidth / 2 ? pos.x - 280 : pos.x) + 'px;'"
        style="display: none;">
        
        <div class="bg-violet-600 p-5 text-white flex justify-between items-center">
            <h3 class="font-bold text-lg flex items-center gap-2">Menu Aksesibilitas</h3>
            <button @click="isOpen = false" class="hover:bg-white/20 p-1 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
            </button>
        </div>

        <div class="p-5 space-y-4">
            {{-- Pengaturan Font --}}
            <div>
                <p class="text-[10px] font-black uppercase text-gray-400 mb-2 tracking-widest">Ukuran Tulisan</p>
                <div class="flex items-center justify-between bg-gray-50 p-2 rounded-xl">
                    <button @click="adjustFont(-2)" class="w-10 h-10 bg-white rounded-lg shadow-sm font-bold text-violet-600">-</button>
                    <span x-text="settings.fontSize + 'px'" class="font-bold"></span>
                    <button @click="adjustFont(2)" class="w-10 h-10 bg-white rounded-lg shadow-sm font-bold text-violet-600">+</button>
                </div>
            </div>

            {{-- Fitur Grid --}}
         <div class="grid grid-cols-2 gap-3">
    @php
        $features = [
            ['id' => 'contrast', 'label' => 'Kontras', 'icon' => 'M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10'],
            ['id' => 'monochrome', 'label' => 'Monokrom', 'icon' => 'M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2Zm0 18a8 8 0 1 1 8-8 8 8 0 0 1-8 8Z'],
            ['id' => 'dyslexic', 'label' => 'Disleksia', 'icon' => 'M4 7V4h16v3M9 20h6M12 4v16'],
            ['id' => 'bold', 'label' => 'Teks Tebal', 'icon' => 'M6 4h8a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6z M6 12h9a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6z'],
            ['id' => 'links', 'label' => 'Garis Link', 'icon' => 'M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71'],
            ['id' => 'titles', 'label' => 'Sorot Judul', 'icon' => 'M6 12h12M6 20h12M6 4h12']
        ];
    @endphp

    @foreach($features as $f)
    <button @click="toggle('{{ $f['id'] }}')" 
        :class="settings.{{ $f['id'] }} ? 'bg-violet-600 text-white shadow-lg shadow-violet-200 border-violet-600' : 'bg-gray-50 text-gray-700 hover:bg-violet-50 hover:text-violet-600 border-transparent hover:border-violet-200'"
        class="group flex flex-col items-center justify-center p-3 rounded-2xl transition-all duration-300 border shadow-sm focus:outline-none">
        
        <div class="mb-1.5 transition-all duration-300 group-hover:scale-125 group-active:scale-90">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="{{ $f['icon'] }}"/>
            </svg>
        </div>

        <span class="text-[10px] font-black uppercase tracking-tighter leading-tight">{{ $f['label'] }}</span>
        
        <div x-show="settings.{{ $f['id'] }}" 
             x-transition:enter="transition duration-300"
             x-transition:enter-start="scale-0"
             x-transition:enter-end="scale-100"
             class="absolute top-2 right-2 w-1.5 h-1.5 bg-white rounded-full">
        </div>
    </button>
    @endforeach
</div>

            <button @click="reset()" class="w-full py-3 text-xs font-black uppercase text-red-500 hover:bg-red-50 rounded-xl border border-dashed border-red-200">
                Reset Pengaturan
            </button>
        </div>
    </div>
</div>