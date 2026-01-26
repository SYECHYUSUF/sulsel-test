<x-admin-layout title="Manajemen SKPD - Admin PPID">
    <x-slot name="header">
        Manajemen SKPD
    </x-slot>

    <h3 class="text-lg font-bold text-[#1A305E] dark:text-blue-400 mb-4">Manajemen SKPD</h3>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($skpd as $item)
            <a href="{{ route('admin.skpd.show', $item) }}"
                class="bg-white dark:bg-slate-800 rounded-xl shadow-sm p-4 border border-slate-100 dark:border-slate-700 overflow-hidden hover:shadow-md transition-shadow">
                <h3 class="text-base font-semibold mb-2 text-slate-900 dark:text-slate-100">{{ $item->nm_skpd }}</h3>
                <h5 class="text-sm text-gray-500 dark:text-gray-400 line-clamp-2">{{ $item->alamat }}</h5>
            </a>
        @endforeach
    </div>
</x-admin-layout>