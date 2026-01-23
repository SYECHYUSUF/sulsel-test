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
        speech: localStorage.getItem('acc-speech') === 'true',
        pause: localStorage.getItem('acc-pause') === 'true',
        cursor: localStorage.getItem('acc-cursor') === 'true',
        mask: localStorage.getItem('acc-mask') === 'true',
        guide: localStorage.getItem('acc-guide') === 'true',
        dark: localStorage.getItem('theme') === 'dark',
        fontSize: parseInt(localStorage.getItem('acc-font-size')) || 16
    },
    speechHandler: null,
    
    {{-- Fungsi Seret (Drag) --}}
    startDragging(e) {
        this.isDragging = true;
        this.hasMoved = false;
        
        const startX = e.type === 'touchstart' ? e.touches[0].clientX : e.clientX;
        const startY = e.type === 'touchstart' ? e.touches[0].clientY : e.clientY;

        const move = (event) => {
            if (!this.isDragging) return;
            const clientX = event.type === 'touchmove' ? event.touches[0].clientX : event.clientX;
            const clientY = event.type === 'touchmove' ? event.touches[0].clientY : event.clientY;
            
            // Calculate distance moved
            const diffX = Math.abs(clientX - startX);
            const diffY = Math.abs(clientY - startY);
            
            // Only consider it a drag if moved more than 5px
            if (diffX > 5 || diffY > 5) {
                this.hasMoved = true;
                this.pos.x = clientX - 28;
                this.pos.y = clientY - 28;
            }
        };
        const stop = () => {
            this.isDragging = false;
            
            if (this.hasMoved) {
                {{-- Snap ke sisi kiri atau kanan --}}
                this.pos.x = (this.pos.x + 28 > window.innerWidth / 2) ? window.innerWidth - 70 : 16;
                {{-- Batasi agar tidak keluar layar atas/bawah --}}
                this.pos.y = Math.max(20, Math.min(window.innerHeight - 80, this.pos.y));
                
                localStorage.setItem('acc-pos-x', this.pos.x);
                localStorage.setItem('acc-pos-y', this.pos.y);
            }
            
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
        // Mengubah ukuran font pada elemen root (html) agar rem unit ikut berubah
        const currentSize = parseFloat(getComputedStyle(document.documentElement).fontSize);
        const newSize = Math.max(12, Math.min(24, currentSize + val));
        document.documentElement.style.fontSize = newSize + 'px';
        localStorage.setItem('acc-font-size', newSize);
    },
    applyToBody() {
        const body = document.body;
        body.classList.toggle('high-contrast', this.settings.contrast);
        body.classList.toggle('monochrome', this.settings.monochrome);
        body.classList.toggle('dyslexic-font', this.settings.dyslexic);
        body.classList.toggle('bold-text', this.settings.bold);
        body.classList.toggle('highlight-links', this.settings.links);
        body.classList.toggle('highlight-titles', this.settings.titles);
        body.classList.toggle('acc-cursor-big', this.settings.cursor);
        body.classList.toggle('acc-mask-mode', this.settings.mask);
        body.classList.toggle('acc-reading-guide', this.settings.guide);
        
        if (this.settings.pause) {
            body.classList.add('reduce-motion');
        } else {
            body.classList.remove('reduce-motion');
        }

        // Dark Mode Logic
        if (this.settings.dark) {
            document.documentElement.classList.add('dark');
            localStorage.setItem('theme', 'dark');
        } else {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('theme', 'light');
        }
        
        // Speech Mode Logic
        if (this.settings.speech) {
            body.classList.add('speech-mode');
            if (!this.speechHandler) {
                this.speechHandler = (e) => {
                    const target = e.target.closest('p, h1, h2, h3, h4, h5, h6, a, button, span, div');
                    if (target && target.innerText) {
                         const text = target.innerText.trim();
                         if (text && text.length < 200) { 
                             window.speechSynthesis.cancel();
                             const utterance = new SpeechSynthesisUtterance(text);
                             utterance.lang = 'id-ID';
                             window.speechSynthesis.speak(utterance);
                         }
                    }
                };
            }
            document.addEventListener('mouseover', this.speechHandler);
        } else {
            body.classList.remove('speech-mode');
            if (this.speechHandler) {
                document.removeEventListener('mouseover', this.speechHandler);
            }
            window.speechSynthesis.cancel();
        }

        // Set Saved Font Size
        if (this.settings.fontSize) {
             document.documentElement.style.fontSize = this.settings.fontSize + 'px';
        }
    },
    reset() {
        this.settings = { 
            contrast: false, 
            monochrome: false, 
            dyslexic: false, 
            bold: false, 
            links: false, 
            titles: false,
            speech: false,
            pause: false,
            cursor: false,
            mask: false,
            guide: false,
            dark: false,
            fontSize: 16 
        };
        localStorage.clear();
        document.documentElement.style.fontSize = '16px'; // Reset font size
        
        if (localStorage.getItem('theme') === 'dark') {
             this.settings.dark = true; 
        }
        this.applyToBody();
    }
}" x-init="applyToBody()" class="relative z-[9999] font-['Plus_Jakarta_Sans']">

    {{-- 1. TOMBOL AKSESIBILITAS (Movable) --}}
    <button 
        x-data="{ hasMoved: false }"
        @mousedown="startDragging($event)" 
        @touchstart="startDragging($event)"
        @click="if(!hasMoved) isOpen = !isOpen"
        class="fixed w-14 h-14 bg-[#1A305E] text-white rounded-full shadow-2xl flex items-center justify-center cursor-move hover:scale-110 active:scale-95 transition-transform z-[9999]"
        :style="'left: ' + pos.x + 'px; top: ' + pos.y + 'px;'"
        aria-label="Aksesibilitas">
        
        {{-- Ikon Universal Access --}}
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-disabled">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <path d="M9 5a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
            <path d="M11 7l0 8l4 0l4 5" />
            <path d="M11 11l5 0" />
            <path d="M7 11.5a5 5 0 1 0 6 7.5" />
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
        
        <div class="bg-[#1A305E] p-5 text-white flex justify-between items-center">
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
                    <button @click="adjustFont(-2)" class="w-10 h-10 bg-white rounded-lg shadow-sm font-bold text-[#1A305E]">-</button>
                    <span x-text="settings.fontSize + 'px'" class="font-bold"></span>
                    <button @click="adjustFont(2)" class="w-10 h-10 bg-white rounded-lg shadow-sm font-bold text-[#1A305E]">+</button>
                </div>
            </div>

            {{-- Fitur Grid --}}
         <div class="grid grid-cols-2 gap-3">
    @php
        $features = [
            ['id' => 'dark', 'label' => 'Mode Gelap', 'icon' => 'M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z'],
            ['id' => 'contrast', 'label' => 'Kontras', 'icon' => 'M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10'],
            ['id' => 'monochrome', 'label' => 'Monokrom', 'icon' => 'M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2Zm0 18a8 8 0 1 1 8-8 8 8 0 0 1-8 8Z'],
            ['id' => 'dyslexic', 'label' => 'Disleksia', 'icon' => 'M4 7V4h16v3M9 20h6M12 4v16'],
            ['id' => 'bold', 'label' => 'Teks Tebal', 'icon' => 'M6 4h8a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6z M6 12h9a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6z'],
            ['id' => 'links', 'label' => 'Garis Link', 'icon' => 'M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71'],
            ['id' => 'titles', 'label' => 'Sorot Judul', 'icon' => 'M6 12h12M6 20h12M6 4h12'],
            ['id' => 'speech', 'label' => 'Mode Suara', 'icon' => 'M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z M19 10v2a7 7 0 0 1-14 0v-2 M12 19v4 M8 23h8'],
            ['id' => 'pause', 'label' => 'Jeda Animasi', 'icon' => 'M10 15v-6 M14 15v-6 M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z'],
            ['id' => 'cursor', 'label' => 'Kursor Besar', 'icon' => 'M3 3l7.07 16.97 2.51-7.39 7.39-2.51L3 3z'],
            ['id' => 'mask', 'label' => 'Masker Baca', 'icon' => 'M2 12h20 M4 6h16 M4 18h16'],
            ['id' => 'guide', 'label' => 'Panduan', 'icon' => 'M12 20h9 M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z']
        ];
    @endphp

    @foreach($features as $f)
    <button @click="toggle('{{ $f['id'] }}')" 
        :class="settings.{{ $f['id'] }} ? 'bg-[#1A305E] text-white shadow-lg shadow-[#1A305E]/20 border-[#1A305E]' : 'bg-gray-50 text-gray-700 hover:bg-[#1A305E]/5 hover:text-[#1A305E] border-transparent hover:border-[#1A305E]/20'"
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