{{-- Scroll Button Component --}}
@props(['type' => 'top']) {{-- type can be 'top' or 'bottom' --}}

<div x-data="{ 
    showScrollTop: false,
    showScrollDown: true,
    scrollToTop() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    },
    scrollToBottom() {
        window.scrollTo({ top: document.documentElement.scrollHeight, behavior: 'smooth' });
    },
    handleScroll() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        const scrollHeight = document.documentElement.scrollHeight;
        const clientHeight = document.documentElement.clientHeight;
        
        // Show scroll to top button when scrolled down more than 300px
        this.showScrollTop = scrollTop > 300;
        
        // Show scroll to bottom button when not at bottom
        this.showScrollDown = (scrollTop + clientHeight) < (scrollHeight - 100);
    }
}" 
x-init="
    handleScroll();
    window.addEventListener('scroll', () => handleScroll());
"
class="fixed bottom-6 right-6 z-40 flex flex-col gap-3">

    {{-- Scroll to Top Button --}}
    <button
        @click="scrollToTop()"
        x-show="showScrollTop"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-2"
        class="group relative w-12 h-12 bg-ppid-primary hover:bg-ppid-accent text-white rounded-full shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center overflow-hidden"
        aria-label="{{ __('messages.scroll.to_top') }}"
        title="{{ __('messages.scroll.to_top') }}"
    >
        {{-- Background Pulse Effect --}}
        <div class="absolute inset-0 bg-ppid-accent opacity-0 group-hover:opacity-20 rounded-full transition-opacity duration-300"></div>
        
        {{-- Arrow Up Icon --}}
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 transform group-hover:scale-110 group-hover:-translate-y-0.5 transition-all duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
        </svg>
    </button>

    {{-- Scroll to Bottom Button --}}
    <button
        @click="scrollToBottom()"
        x-show="showScrollDown && !showScrollTop"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-2"
        class="group relative w-12 h-12 bg-ppid-primary hover:bg-ppid-accent text-white rounded-full shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center overflow-hidden"
        aria-label="{{ __('messages.scroll.to_bottom') }}"
        title="{{ __('messages.scroll.to_bottom') }}"
    >
        {{-- Background Pulse Effect --}}
        <div class="absolute inset-0 bg-ppid-accent opacity-0 group-hover:opacity-20 rounded-full transition-opacity duration-300"></div>
        
        {{-- Arrow Down Icon --}}
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 transform group-hover:scale-110 group-hover:translate-y-0.5 transition-all duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
        </svg>
    </button>
</div>
