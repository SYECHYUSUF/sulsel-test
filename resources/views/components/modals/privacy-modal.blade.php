{{-- Privacy Policy Modal --}}
<x-modal name="privacy-policy" maxWidth="2xl" focusable>
    <div class="p-6 bg-white dark:bg-gray-800">
        {{-- Modal Header --}}
        <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center gap-3">
                {{-- Icon --}}
                <div class="w-10 h-10 bg-ppid-primary rounded-lg flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                
                {{-- Title --}}
                <h2 class="text-xl md:text-2xl font-bold text-gray-900 dark:text-white">
                    {{ __('messages.privacy_policy.title') }}
                </h2>
            </div>
            
            {{-- Close Button --}}
            <button @click="$dispatch('close-modal', 'privacy-policy')" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Modal Content --}}
        <div class="max-h-[60vh] overflow-y-auto pr-2 space-y-4 text-gray-700 dark:text-gray-300">
            <p class="text-sm text-gray-500 dark:text-gray-400 italic">
                {{ __('messages.privacy_policy.last_updated') }}
            </p>

            @foreach(__('messages.privacy_policy.sections') as $section)
            <div class="space-y-2">
                <h3 class="text-lg font-bold text-ppid-primary dark:text-ppid-accent">
                    {{ $section['title'] }}
                </h3>
                <p class="text-sm leading-relaxed">
                    {{ $section['content'] }}
                </p>
                
                @if(isset($section['items']))
                <ul class="list-disc list-inside space-y-1 ml-4 text-sm">
                    @foreach($section['items'] as $item)
                    <li>{{ $item }}</li>
                    @endforeach
                </ul>
                @endif
            </div>
            @endforeach
        </div>

        {{-- Modal Footer --}}
        <div class="mt-6 pt-4 border-t border-gray-200 dark:border-gray-700 flex justify-end">
            <button 
                @click="$dispatch('close-modal', 'privacy-policy')"
                class="px-6 py-2.5 bg-ppid-primary hover:bg-ppid-accent text-white rounded-lg transition-colors duration-300 font-medium"
            >
                {{ __('messages.common.close') }}
            </button>
        </div>
    </div>
</x-modal>
