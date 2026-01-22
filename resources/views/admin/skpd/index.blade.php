<x-admin-layout title="Manajemen SKPD - Admin PPID">
    <x-slot name="header">
        Manajemen SKPD
    </x-slot>

    <h3 class="text-lg font-bold text-[#1A305E] mb-4">Manajemen SKPD</h3>

    <div class="grid grid-cols-3 gap-4">
        @foreach ($skpd as $item)
        <a href="{{ route('admin.data-skpd.show', $item) }}" class="bg-white rounded-xl shadow-sm p-4 border border-slate-100 overflow-hidden">
            <h3 class="text-base mb-2">{{ $item->nm_skpd }}</h3>
            <h5 class="text-gray-500">{{ $item->alamat }}</h5>
        </a>    
        @endforeach
    </div>  
</x-admin-layout>