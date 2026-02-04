<x-layout>
    <x-header />

    {{-- Breadcrumb + Title Section --}}
    <div class="bg-white dark:bg-slate-800 border-b border-gray-200 dark:border-slate-700 font-['Plus_Jakarta_Sans']">
        <div class="container mx-auto px-4 py-6">
            {{-- Breadcrumb --}}
            <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300 mb-4">
                <a href="/" class="hover:text-ppid-primary dark:text-white transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="w-4 h-4">
                        <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                        <polyline points="9 22 9 12 15 12 15 22" />
                    </svg>
                </a>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="w-4 h-4 text-gray-400">
                    <path d="m9 18 6-6-6-6" />
                </svg>
                <a href="/informasi-publik"
                    class="hover:text-ppid-primary dark:text-white transition-colors">{{ __('messages.breadcrumb.public_info') }}</a>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="w-4 h-4 text-gray-400">
                    <path d="m9 18 6-6-6-6" />
                </svg>
                <span
                    class="text-ppid-primary dark:text-white font-medium">{{ __('messages.public_info_types.serta_merta') }}</span>
            </div>

            {{-- Title --}}
            <div class="flex items-end justify-between">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold text-ppid-primary dark:text-white mb-2">
                        {{ __('messages.public_info_pages.serta_merta_title') }}
                    </h1>
                    <p class="text-gray-600 dark:text-gray-300">
                        {{ __('messages.public_info_pages.serta_merta_subtitle') }}
                    </p>
                </div>
                <div class="hidden md:block">
                    <div class="w-20 h-1 bg-gradient-to-r from-ppid-primary to-transparent rounded-full"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content --}}
    <main class="py-10 md:py-16 bg-gray-50 dark:bg-slate-900 font-['Plus_Jakarta_Sans']">
        <div class="container mx-auto px-4">
            <div class="max-w-7xl mx-auto">

                {{-- Search and Filter --}}
                <form action="{{ url()->current() }}" method="GET" class="flex flex-col md:flex-row gap-4 mb-6">
                    <div class="flex-1">
                        <div class="relative">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400">
                                <circle cx="11" cy="11" r="8" />
                                <path d="m21 21-4.3-4.3" />
                            </svg>
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="{{ __('messages.common.search_placeholder') }}"
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-ppid-primary dark:bg-slate-700 dark:text-white dark:focus:ring-blue-500" />
                        </div>
                    </div>
                    <div>
                        <select name="tahun" onchange="this.form.submit()"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-ppid-primary bg-white dark:bg-slate-800 dark:text-white">
                            <option value="">{{ __('messages.common.select_year') }}</option>
                            @foreach ($availableYears as $year)
                                <option value="{{ $year->waktu }}" {{ request('tahun') == $year->waktu ? 'selected' : '' }}>
                                    {{ $year->waktu }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit"
                            class="px-6 py-2 bg-ppid-accent text-white rounded-lg hover:bg-ppid-accent-hover transition-colors font-medium">
                            {{ __('messages.news.search_btn') }}
                        </button>
                        @if (request('search') || request('tahun'))
                            <a href="{{ url()->current() }}"
                                class="px-6 py-2 bg-gray-200 dark:bg-slate-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-slate-600 transition-colors font-medium flex items-center justify-center">
                                Clear
                            </a>
                        @endif
                    </div>
                </form>

                {{-- Table --}}
                <div
                    class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-200 dark:border-slate-700 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-ppid-primary text-white">
                                <tr>
                                    <th class="px-4 py-3 text-sm font-semibold">{{ __('messages.table.no') }}</th>
                                    <th class="px-4 py-3 text-sm font-semibold">{{ __('messages.table.title') }}</th>
                                    <th class="px-4 py-3 text-sm font-semibold">{{ __('messages.table.year') }}</th>
                                    <th class="px-4 py-3 text-sm font-semibold">{{ __('messages.table.opd') }}</th>
                                    <th class="px-4 py-3 text-sm font-semibold">{{ __('messages.table.action') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($informasiData as $item)
                                    <tr class="hover:bg-ppid-primary/5 transition-colors">
                                        <td class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                                            {{ ($informasiData->currentPage() - 1) * $informasiData->perPage() + $loop->iteration }}
                                        </td>
                                        <td class="px-4 py-3 text-sm text-gray-700 font-medium">{{ $item->judul }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300 whitespace-nowrap">
                                            {{ \Carbon\Carbon::parse($item->tgl_upload)->format('Y') }}
                                        </td>
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ $item->skpd->nm_skpd ?? '-' }}</td>
                                        <td class="px-4 py-3 text-center whitespace-nowrap">
                                            <div class="flex items-center justify-center gap-2">
                                                <a href="{{ route('informasi-publik.show', $item->id_informasi) }}"
                                                    class="p-1.5 text-ppid-primary dark:text-white hover:bg-ppid-primary/10 rounded transition-colors"
                                                    title="{{ __('messages.common.view_detail') }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="w-4 h-4">
                                                        <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" />
                                                        <circle cx="12" cy="12" r="3" />
                                                    </svg>
                                                </a>
                                                <a href="{{ $item->file ? (str_starts_with($item->file, 'http') ? $item->file : asset('storage/' . $item->file)) : '#' }}"
                                                    download
                                                    class="p-1.5 text-ppid-primary dark:text-white hover:bg-ppid-primary/10 rounded transition-colors"
                                                    title="{{ __('messages.common.download') }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="w-4 h-4">
                                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                                        <polyline points="7 10 12 15 17 10" />
                                                        <line x1="12" x2="12" y1="15" y2="3" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div
                        class="border-t border-gray-200 dark:border-slate-700 px-6 py-4 bg-gray-50 dark:bg-slate-900 flex items-center justify-center gap-2">
                        {{ $informasiData->links() }}
                    </div>

                </div>

            </div>
        </div>
    </main>

    <x-footer />
</x-layout>