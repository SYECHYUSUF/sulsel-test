<div x-data="{ 
    isOpen: false,
    isDragging: false,
    hasMoved: false,
    pos: { 
        x: parseInt(localStorage.getItem('acc-pos-x')) || 24, 
        y: parseInt(localStorage.getItem('acc-pos-y')) || window.innerHeight - 100 
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
        fontSize: parseInt(localStorage.getItem('acc-font-size')) || 16,
        // New features
        hideImages: localStorage.getItem('acc-hide-images') === 'true',
        textAlign: localStorage.getItem('acc-text-align') || 'none',
        saturation: localStorage.getItem('acc-saturation') || 'normal',
        textSpacing: localStorage.getItem('acc-text-spacing') === 'true',
        widgetPosition: localStorage.getItem('acc-widget-pos') || 'auto'
    },
    speechHandler: null,
    
    {{-- Drag Functions --}}
    startDragging(e) {
        this.isDragging = true;
        this.hasMoved = false;
        
        const startX = e.type === 'touchstart' ? e.touches[0].clientX : e.clientX;
        const startY = e.type === 'touchstart' ? e.touches[0].clientY : e.clientY;

        const move = (event) => {
            if (!this.isDragging) return;
            
            if (event.type === 'touchmove') {
                event.preventDefault();
            }
            
            const clientX = event.type === 'touchmove' ? event.touches[0].clientX : event.clientX;
            const clientY = event.type === 'touchmove' ? event.touches[0].clientY : event.clientY;
            
            const diffX = Math.abs(clientX - startX);
            const diffY = Math.abs(clientY - startY);
            
            if (diffX > 5 || diffY > 5) {
                this.hasMoved = true;
                this.pos.x = clientX - 28;
                this.pos.y = clientY - 28;
            }
        };
        const stop = () => {
            this.isDragging = false;
            
            if (this.hasMoved) {
                this.pos.x = (this.pos.x + 28 > window.innerWidth / 2) ? window.innerWidth - 70 : 16;
                this.pos.y = Math.max(20, Math.min(window.innerHeight - 80, this.pos.y));
                
                localStorage.setItem('acc-pos-x', this.pos.x);
                localStorage.setItem('acc-pos-y', this.pos.y);
            }
            
            window.removeEventListener('mousemove', move);
            window.removeEventListener('mouseup', stop);
            window.removeEventListener('touchmove', move, { passive: false });
            window.removeEventListener('touchend', stop);
        };
        window.addEventListener('mousemove', move);
        window.addEventListener('mouseup', stop);
        window.addEventListener('touchmove', move, { passive: false });
        window.addEventListener('touchend', stop);
    },

    toggle(key) {
        this.settings[key] = !this.settings[key];
        localStorage.setItem('acc-' + key, this.settings[key]);
        this.applyToBody();
        
        if (key === 'speech') {
            this.initSpeech();
        }
    },
    
    setTextAlign(align) {
        this.settings.textAlign = align;
        localStorage.setItem('acc-text-align', align);
        this.applyToBody();
    },
    
    setSaturation(level) {
        this.settings.saturation = level;
        localStorage.setItem('acc-saturation', level);
        this.applyToBody();
    },
    
    setWidgetPosition(position) {
        this.settings.widgetPosition = position;
        localStorage.setItem('acc-widget-pos', position);
        
        if (position === 'left') {
            this.pos.x = 16;
        } else if (position === 'right') {
            this.pos.x = window.innerWidth - 70;
        } else if (position === 'hidden') {
            this.applyToBody();
        }
        
        localStorage.setItem('acc-pos-x', this.pos.x);
    },
    
    adjustFont(val) {
        const root = document.documentElement;
        let currentSize = this.settings.fontSize;
        const newSize = Math.max(12, Math.min(24, currentSize + val));
        
        this.settings.fontSize = newSize;
        root.style.fontSize = newSize + 'px';
        localStorage.setItem('acc-font-size', newSize);
    },
    
    applyToBody() {
        const body = document.body;
        const doc = document.documentElement;

        // Existing features
        body.classList.toggle('high-contrast', this.settings.contrast);
        body.classList.toggle('monochrome', this.settings.monochrome);
        body.classList.toggle('dyslexic-font', this.settings.dyslexic);
        body.classList.toggle('bold-text', this.settings.bold);
        body.classList.toggle('highlight-links', this.settings.links);
        body.classList.toggle('highlight-titles', this.settings.titles);
        body.classList.toggle('acc-cursor-big', this.settings.cursor);
        body.classList.toggle('acc-mask-mode', this.settings.mask);
        body.classList.toggle('acc-reading-guide', this.settings.guide);
        
        if (this.settings.pause) body.classList.add('reduce-motion');
        else body.classList.remove('reduce-motion');

        // Dark Mode
        if (this.settings.dark) {
            doc.classList.add('dark');
            localStorage.setItem('theme', 'dark');
        } else {
            doc.classList.remove('dark');
            localStorage.setItem('theme', 'light');
        }
        
        // Font Size
        doc.style.fontSize = this.settings.fontSize + 'px';
        
        // NEW FEATURES
        
        // Hide Images
        body.classList.toggle('acc-hide-images', this.settings.hideImages);
        
        // Text Alignment
        body.classList.remove('acc-text-left', 'acc-text-center', 'acc-text-right');
        if (this.settings.textAlign !== 'none') {
            body.classList.add('acc-text-' + this.settings.textAlign);
        }
        
        // Saturation
        body.classList.remove('acc-high-saturation', 'acc-low-saturation');
        if (this.settings.saturation === 'high') {
            body.classList.add('acc-high-saturation');
        } else if (this.settings.saturation === 'low') {
            body.classList.add('acc-low-saturation');
        }
        
        // Text Spacing
        body.classList.toggle('acc-text-spacing', this.settings.textSpacing);
        
        // Widget Position
        body.classList.toggle('acc-widget-hidden', this.settings.widgetPosition === 'hidden');
    },

    initSpeech() {
        if (this.settings.speech) {
            document.body.classList.add('speech-mode');
            this.addSpeechListeners();
        } else {
            document.body.classList.remove('speech-mode');
            this.removeSpeechListeners();
            window.speechSynthesis.cancel();
        }
    },
    
    addSpeechListeners() {
        if (this.speechHandler) return;

        this.speechHandler = (e) => {
            if (!this.settings.speech) return;
            
            window.speechSynthesis.cancel();

            const target = e.target.closest('h1, h2, h3, h4, h5, h6, p, a, span, li, button, input, label');
            if (target && target.innerText && target.innerText.trim().length > 0) {
                const utterance = new SpeechSynthesisUtterance(target.innerText);
                utterance.lang = document.documentElement.lang || 'id-ID';
                utterance.rate = 1;
                window.speechSynthesis.speak(utterance);
            }
        };

        let timer;
        this.realSpeechHandler = (e) => {
             clearTimeout(timer);
             timer = setTimeout(() => {
                 this.speechHandler(e);
             }, 500);
        };
        document.addEventListener('mouseover', this.realSpeechHandler);
    },
    
    removeSpeechListeners() {
        if (this.realSpeechHandler) {
             document.removeEventListener('mouseover', this.realSpeechHandler);
             this.realSpeechHandler = null;
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
            fontSize: 16,
            hideImages: false,
            textAlign: 'none',
            saturation: 'normal',
            textSpacing: false,
            widgetPosition: 'auto'
        };
        localStorage.clear();
        this.applyToBody();
    }
}" x-init="applyToBody(); initSpeech();" class="relative z-[9999] font-['Plus_Jakarta_Sans']" id="accessibility-widget">

    {{-- 1. FLOATING BUTTON (Movable) --}}
    <button 
        @mousedown="startDragging($event)" 
        @touchstart="startDragging($event)"
        @click="if(!hasMoved) isOpen = !isOpen"
        class="fixed w-14 border border-access-border-orange h-14 bg-access-primary text-white rounded-full shadow-2xl flex items-center justify-center cursor-move hover:scale-110 active:scale-95 transition-transform z-[9999]"
        :style="'left: ' + pos.x + 'px; top: ' + pos.y + 'px;'"
        aria-label="{{ __('messages.accessibility.menu_title') }}">
        
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <path d="M9 5a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
            <path d="M11 7l0 8l4 0l4 5" />
            <path d="M11 11l5 0" />
            <path d="M7 11.5a5 5 0 1 0 6 7.5" />
        </svg>
    </button>

    {{-- 2. CONTROL PANEL --}}
    <div x-show="isOpen" @click.away="isOpen = false" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-90"
        x-transition:enter-end="opacity-100 scale-100"
        class="fixed w-96 bg-access-bg rounded-[24px] shadow-[0_20px_50px_rgba(0,0,0,0.3)] border border-access-border overflow-hidden z-[9998] max-h-[90vh] overflow-y-auto custom-scrollbar"
        :style="'top: ' + (pos.y > window.innerHeight / 2 ? pos.y - 520 : pos.y + 70) + 'px; left: ' + (pos.x > window.innerWidth / 2 ? pos.x - 380 : pos.x) + 'px;'"
        style="display: none;">
        
        <div class="bg-access-primary p-5 text-white flex justify-between items-center sticky top-0 z-10">
            <h3 class="font-bold text-lg flex items-center gap-2">{{ __('messages.accessibility.menu_title') }}</h3>
            <button @click="isOpen = false" class="hover:bg-white/20 p-1 rounded-lg transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
            </button>
        </div>

        <div class="p-5 space-y-4">
            {{-- Font Size --}}
            <div>
                <p class="text-[10px] font-black uppercase text-access-text-muted mb-2 tracking-widest">{{ __('messages.accessibility.font_size') }}</p>
                <div class="flex items-center justify-between bg-access-bg-gray p-2 rounded-xl">
                    <button @click="adjustFont(-2)" class="w-10 h-10 bg-white rounded-lg shadow-sm font-bold text-access-primary hover:bg-access-button-hover transition-colors">-</button>
                    <span x-text="settings.fontSize + 'px'" class="font-bold text-access-text"></span>
                    <button @click="adjustFont(2)" class="w-10 h-10 bg-white rounded-lg shadow-sm font-bold text-access-primary hover:bg-access-button-hover transition-colors">+</button>
                </div>
            </div>

            {{-- Features Grid - 3 columns --}}
            <div class="grid grid-cols-3 gap-3">
    @php
        $features = [
            ['id' => 'dark', 'label' => __('messages.accessibility.dark_mode'), 'icon' => 'M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z'],
            ['id' => 'contrast', 'label' => __('messages.accessibility.contrast'), 'icon' => 'M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10'],
            ['id' => 'monochrome', 'label' => __('messages.accessibility.monochrome'), 'icon' => 'M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2Zm0 18a8 8 0 1 1 8-8 8 8 0 0 1-8 8Z'],
            ['id' => 'dyslexic', 'label' => __('messages.accessibility.dyslexic'), 'icon' => 'M4 7V4h16v3M9 20h6M12 4v16'],
            ['id' => 'bold', 'label' => __('messages.accessibility.bold_text'), 'icon' => 'M6 4h8a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6z M6 12h9a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6z'],
            ['id' => 'links', 'label' => __('messages.accessibility.underline_links'), 'icon' => 'M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71'],
            ['id' => 'titles', 'label' => __('messages.accessibility.highlight_titles'), 'icon' => 'M6 12h12M6 20h12M6 4h12'],
            ['id' => 'speech', 'label' => __('messages.accessibility.speech_mode'), 'icon' => 'M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z M19 10v2a7 7 0 0 1-14 0v-2 M12 19v4 M8 23h8'],
            ['id' => 'pause', 'label' => __('messages.accessibility.pause_animation'), 'icon' => 'M10 15v-6 M14 15v-6 M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z'],
            ['id' => 'cursor', 'label' => __('messages.accessibility.big_cursor'), 'icon' => 'M3 3l7.07 16.97 2.51-7.39 7.39-2.51L3 3z'],
            ['id' => 'mask', 'label' => __('messages.accessibility.reading_mask'), 'icon' => 'M2 12h20 M4 6h16 M4 18h16'],
            ['id' => 'guide', 'label' => __('messages.accessibility.reading_guide'), 'icon' => 'M12 20h9 M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z'],
            ['id' => 'hideImages', 'label' => __('messages.accessibility.hide_images'), 'icon' => 'M3 3l18 18M10.584 10.587a2 2 0 0 0 2.828 2.83M9.363 5.365A9.466 9.466 0 0 1 12 5c4 0 7.333 2.333 10 7-1.253 2.09-2.573 3.75-3.96 4.98'],
            ['id' => 'textSpacing', 'label' => __('messages.accessibility.text_spacing'), 'icon' => 'M5 12h14M5 5v14M19 5v14'],
        ];
    @endphp

    @foreach($features as $f)
    <button @click="toggle('{{ $f['id'] }}')" 
        :class="settings.{{ $f['id'] }} ? 'bg-access-primary text-white shadow-lg shadow-access-primary/20 border-access-primary' : 'bg-access-bg-gray text-access-text hover:bg-access-primary/5 hover:text-access-primary border-transparent hover:border-access-primary/20'"
        class="group flex flex-col items-center justify-center p-3 rounded-2xl transition-all duration-300 border shadow-sm focus:outline-none">
        
        <div class="mb-1.5 transition-all duration-300 group-hover:scale-125 group-active:scale-90">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="{{ $f['icon'] }}"/>
            </svg>
        </div>

        <span class="text-[9px] font-black uppercase tracking-tighter leading-tight text-center">{{ $f['label'] }}</span>
        
        <div x-show="settings.{{ $f['id'] }}" 
             x-transition:enter="transition duration-300"
             x-transition:enter-start="scale-0"
             x-transition:enter-end="scale-100"
             class="absolute top-2 right-2 w-1.5 h-1.5 bg-white rounded-full">
        </div>
    </button>
    @endforeach
</div>

            {{-- Text Alignment --}}
            <div>
                <p class="text-[10px] font-black uppercase text-access-text-muted mb-2 tracking-widest">{{ __('messages.accessibility.text_align') }}</p>
                <div class="grid grid-cols-3 gap-2">
                    @foreach(['left' => 'align_left', 'center' => 'align_center', 'right' => 'align_right'] as $align => $label)
                    <button @click="setTextAlign('{{ $align }}')"
                        :class="settings.textAlign === '{{ $align }}' ? 'bg-access-primary text-white' : 'bg-access-bg-gray text-access-text hover:bg-access-button-hover'"
                        class="px-3 py-2 rounded-lg text-xs font-bold transition-colors">
                        {{ __('messages.accessibility.' . $label) }}
                    </button>
                    @endforeach
                </div>
            </div>

            {{-- Saturation --}}
            <div>
                <p class="text-[10px] font-black uppercase text-access-text-muted mb-2 tracking-widest">{{ __('messages.accessibility.saturation') }}</p>
                <div class="grid grid-cols-3 gap-2">
                    @foreach(['normal' => 'normal_saturation', 'high' => 'high_saturation', 'low' => 'low_saturation'] as $level => $label)
                    <button @click="setSaturation('{{ $level }}')"
                        :class="settings.saturation === '{{ $level }}' ? 'bg-access-primary text-white' : 'bg-access-bg-gray text-access-text hover:bg-access-button-hover'"
                        class="px-3 py-2 rounded-lg text-xs font-bold transition-colors">
                        {{ __('messages.accessibility.' . $label) }}
                    </button>
                    @endforeach
                </div>
            </div>

            {{-- Widget Position --}}
            <div>
                <p class="text-[10px] font-black uppercase text-access-text-muted mb-2 tracking-widest">{{ __('messages.accessibility.widget_position') }}</p>
                <div class="grid grid-cols-3 gap-2">
                    @foreach(['left' => 'position_left', 'right' => 'position_right', 'hidden' => 'hide_widget'] as $position => $label)
                    <button @click="setWidgetPosition('{{ $position }}')"
                        :class="settings.widgetPosition === '{{ $position }}' ? 'bg-access-primary text-white' : 'bg-access-bg-gray text-access-text hover:bg-access-button-hover'"
                        class="px-3 py-2 rounded-lg text-xs font-bold transition-colors">
                        {{ __('messages.accessibility.' . $label) }}
                    </button>
                    @endforeach
                </div>
            </div>

            {{-- Reset Button --}}
            <button @click="reset()" class="w-full py-3 text-xs font-black uppercase text-red-500 hover:bg-red-50 rounded-xl border border-dashed border-red-200 transition-colors">
                {{ __('messages.accessibility.reset_settings') }}
            </button>
        </div>
    </div>
</div>