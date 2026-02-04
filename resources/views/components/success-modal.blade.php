@props([
    'show' => false,
    'title' => 'Yey, Berhasil!',
    'description' => '',
    'registrationNumber' => null,
    'primaryButtonText' => 'Mantap!',
    'primaryButtonUrl' => '#',
    'secondaryButtonText' => 'Tutup',
    'autoClose' => false,
    'duration' => 5000,
])

<div x-data="{
    show: @js($show),
    autoCloseTimer: null,
    init() {
        if (this.show && @js($autoClose)) {
            this.autoCloseTimer = setTimeout(() => {
                this.show = false;
            }, @js($duration));
        }
    },
    close() {
        if (this.autoCloseTimer) clearTimeout(this.autoCloseTimer);
        this.show = false;
    }
}"
    x-show="show"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-50 overflow-y-auto"
    style="display: none;"
    @keydown.escape.window="close()">
    
    {{-- Backdrop --}}
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div @click="close()" class="fixed inset-0 transition-opacity bg-slate-900/60 backdrop-blur-sm" aria-hidden="true"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        {{-- Modal Panel --}}
        <div x-show="show"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="inline-block align-bottom bg-white dark:bg-slate-800 rounded-3xl px-8 pt-10 pb-8 text-center overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-sm sm:w-full">
            
            {{-- Success Icon --}}
            <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-gradient-to-br from-ppid-primary to-blue-600 mb-6 shadow-lg">
                <svg class="h-10 w-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>

            {{-- Title --}}
            <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-3">
                {{ $title }}
            </h3>

            {{-- Description --}}
            @if($description)
                <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed mb-2">
                    {{ $description }}
                </p>
            @endif

            {{-- Registration Number --}}
            @if($registrationNumber)
                <p class="text-xs text-slate-500 dark:text-slate-400 mb-1">
                    Nomor pendaftaran:
                </p>
                <p class="text-sm font-semibold text-ppid-primary dark:text-blue-400 mb-6">
                    {{ $registrationNumber }}
                </p>
            @else
                <div class="mb-6"></div>
            @endif

            {{-- Slot for Custom Content --}}
            @if(trim($slot))
                <div class="mb-6 text-left">
                    {{ $slot }}
                </div>
            @endif

            {{-- Action Buttons --}}
            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                @if($secondaryButtonText)
                    <button @click="close()" type="button"
                        class="px-6 py-3 bg-slate-100 hover:bg-slate-200 dark:bg-slate-700 dark:hover:bg-slate-600 text-slate-700 dark:text-slate-200 text-sm font-semibold rounded-xl transition-all duration-200">
                        {{ $secondaryButtonText }}
                    </button>
                @endif

                @if($primaryButtonUrl !== '#')
                    <a href="{{ $primaryButtonUrl }}"
                        class="px-6 py-3 bg-gradient-to-r from-ppid-primary to-blue-600 hover:from-[#152749] hover:to-blue-700 text-white text-sm font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                        {{ $primaryButtonText }}
                    </a>
                @else
                    <button @click="close()" type="button"
                        class="px-6 py-3 bg-gradient-to-r from-ppid-primary to-blue-600 hover:from-[#152749] hover:to-blue-700 text-white text-sm font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                        {{ $primaryButtonText }}
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>
