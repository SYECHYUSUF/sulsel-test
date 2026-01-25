@props([
    'name',
    'options' => [], 
    'value' => null,
    'placeholder' => 'Pilih opsi...',
    'disabled' => false,
    'required' => false,
    'idKey' => 'id',
    'labelKey' => 'label'
])

<div x-data="{
    open: false,
    search: '',
    disabled: {{ $disabled ? 'true' : 'false' }},
    value: '{{ $value }}',
    label: '',
    rawOptions: {{ $options instanceof \Illuminate\Support\Collection ? $options->toJson() : json_encode($options) }},
    
    get options() {
        return this.rawOptions.map(opt => ({
            id: opt['{{ $idKey }}'],
            label: opt['{{ $labelKey }}']
        }));
    },
    init() {
        let selected = this.options.find(opt => opt.id == this.value);
        if (selected) this.label = selected.label;
    },
    get filteredOptions() {
        if (this.search === '') return this.options;
        return this.options.filter(opt => 
            opt.label.toLowerCase().includes(this.search.toLowerCase())
        );
    },
    select(opt) {
        this.value = opt.id;
        this.label = opt.label;
        this.open = false;
        this.search = '';
    }
}" 
class="relative" 
@click.outside="open = false"> <input type="hidden" name="{{ $name }}" x-model="value" {{ $required ? 'required' : '' }}>

    <button type="button" 
        @click="if(!disabled) open = !open"
        class="w-full flex items-center justify-between px-4 py-2 bg-white border border-slate-200 rounded-lg text-sm text-left focus:outline-none focus:border-ppid-accent focus:ring-1 focus:ring-ppid-accent transition-all"
        :class="open ? 'border-ppid-accent ring-1 ring-ppid-accent' : ''">
        
        <span x-text="label || '{{ $placeholder }}'" :class="!label && 'text-slate-400'"></span>
        
        <svg class="w-4 h-4 text-slate-400 transition-transform duration-200" 
            :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>

    <div x-show="open" 
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        class="absolute z-50 w-full mt-2 bg-white border border-slate-100 rounded-xl shadow-xl overflow-hidden"
        style="display: none;"
        @click.stop> <div class="p-2 border-b border-slate-50">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input type="text" 
                    x-model="search"
                    @keyup.escape="open = false"
                    class="w-full pl-9 pr-4 py-2 bg-slate-50 border-none rounded-lg text-sm focus:ring-0 placeholder-slate-400" 
                    placeholder="Cari...">
            </div>
        </div>

        <div class="max-h-60 overflow-y-auto custom-scrollbar">
            <template x-for="opt in filteredOptions" :key="opt.id">
                <button type="button"
                    @click="select(opt)"
                    class="w-full px-4 py-2.5 text-left text-sm hover:bg-slate-50 flex items-center justify-between group transition-colors"
                    :class="value == opt.id ? 'bg-slate-50 text-[#1a305e] font-semibold' : 'text-slate-600'">
                    
                    <span x-text="opt.label"></span>
                    <svg x-show="value == opt.id" class="w-4 h-4 text-[#d4af37]" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </template>
            
            <div x-show="filteredOptions.length === 0" class="px-4 py-8 text-center">
                <p class="text-xs text-slate-400">Data tidak ditemukan</p>
            </div>
        </div>
    </div>
</div>