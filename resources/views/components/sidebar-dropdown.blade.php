{{-- resources/views/components/sidebar-dropdown.blade.php --}}
@props(['label', 'active' => false])

<li class="relative" x-init="checkActive('{{ $label }}', @js($active))">
    <button @click="
        if(!sidebarOpen) { 
            sidebarOpen = true; 
            activeDropdown = '{{ $label }}'; 
        } else {
            activeDropdown = (activeDropdown === '{{ $label }}') ? null : '{{ $label }}';
        }" class="flex items-center py-3 text-sm font-semibold transition-all duration-200 rounded-xl mx-3 group"
        :class="[
                sidebarOpen ? 'px-4 justify-between w-[calc(100%-1.5rem)]' : 'px-0 justify-center h-12 w-12 mx-auto',
                (activeDropdown === '{{ $label }}' || @js($active)) && sidebarOpen ? 'text-white bg-sidebar-hover' : 'text-slate-400 hover:text-white hover:bg-sidebar-hover'
            ]">
        <div class="flex items-center min-w-0">
            <div class="w-6 h-6 shrink-0 transition-colors duration-200" :class="[
                    sidebarOpen ? 'mr-3' : 'mr-0',
                    (activeDropdown === '{{ $label }}' || @js($active)) && sidebarOpen ? 'text-white' : 'text-slate-400 group-hover:text-white'
                 ]">
                {{ $icon }}
            </div>
            <span x-show="sidebarOpen" x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                class="whitespace-nowrap overflow-hidden text-ellipsis">
                {{ __($label) }}
            </span>
        </div>
        <svg x-show="sidebarOpen" class="w-4 h-4 transition-transform duration-200 shrink-0 ml-2"
            :class="{ 'rotate-180': activeDropdown === '{{ $label }}' }" fill="none" stroke="currentColor"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>

    <ul x-show="activeDropdown === '{{ $label }}' && sidebarOpen" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 -translate-y-2 max-h-0"
        x-transition:enter-end="opacity-100 translate-y-0 max-h-[500px]"
        class="mt-1 space-y-1 overflow-hidden transition-all duration-300">
        {{ $slot }}
    </ul>
</li>