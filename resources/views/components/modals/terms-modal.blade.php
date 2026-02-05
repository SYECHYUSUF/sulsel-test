{{-- Terms and Conditions Modal --}}
<x-modal name="terms-conditions" maxWidth="2xl" focusable>
    <div class="p-6 bg-white dark:bg-gray-800">
        {{-- Modal Header --}}
        <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center gap-3">
                {{-- Icon --}}
                <div class="w-10 h-10 bg-ppid-primary rounded-lg flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                
                {{-- Title --}}
                <h2 class="text-xl md:text-2xl font-bold text-gray-900 dark:text-white">
                    {{ __('messages.terms_conditions.title') }}
                </h2>
            </div>
            
            {{-- Close Button --}}
            <button @click="$dispatch('close-modal', 'terms-conditions')" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Modal Content --}}
        <div class="max-h-[60vh] overflow-y-auto pr-2 space-y-4 text-gray-700 dark:text-gray-300">
            <p class="text-sm text-gray-500 dark:text-gray-400 italic">
                {{ __('messages.terms_conditions.last_updated') }}
            </p>

            <div class="prose dark:prose-invert max-w-none">
                {!! \App\Models\Setting::getValue('terms_conditions', 'Syarat dan ketentuan belum diatur.') !!}
            </div>
        </div>

        {{-- Modal Footer --}}
        <div class="mt-6 pt-4 border-t border-gray-200 dark:border-gray-700 flex justify-end">
            <button 
                @click="$dispatch('close-modal', 'terms-conditions')"
                class="px-6 py-2.5 bg-ppid-primary hover:bg-ppid-accent text-white rounded-lg transition-colors duration-300 font-medium"
            >
                {{ __('messages.common.close') }}
            </button>
        </div>
    </div>
</x-modal>
