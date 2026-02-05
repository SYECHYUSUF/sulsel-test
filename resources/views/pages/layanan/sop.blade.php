<x-layout>
    <x-header />

    {{-- Breadcrumb + Title Section --}}
    <div class="bg-white dark:bg-slate-800 border-b border-gray-200 dark:border-slate-700 font-['Plus_Jakarta_Sans']">
        <div class="container mx-auto px-4 py-8">
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
                <span class="text-ppid-primary dark:text-white font-medium">Layanan</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="w-4 h-4 text-gray-400">
                    <path d="m9 18 6-6-6-6" />
                </svg>
                <span class="text-ppid-primary dark:text-white font-bold">{{ __('messages.menu.sop') }}</span>
            </div>

            {{-- Title --}}
            <div class="flex items-end justify-between">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold text-ppid-primary dark:text-white mb-2">
                        {{ __('messages.layanan_pages.sop_title') }}
                    </h1>
                    <p class="text-gray-600 dark:text-gray-300">
                        {{ __('messages.layanan_pages.sop_subtitle') }}
                    </p>
                </div>
                <div class="hidden md:block">
                    <div class="w-24 h-1.5 bg-linear-to-r from-ppid-primary to-ppid-accent rounded-full"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content --}}
    <main class="py-12 md:py-16 bg-gray-50 dark:bg-slate-900 font-['Plus_Jakarta_Sans']">
        <div class="container mx-auto px-4">
            <div class="max-w-7xl mx-auto">

                {{-- Search Box --}}
                <div
                    class="bg-white dark:bg-slate-800 p-4 rounded-xl shadow-sm border border-gray-200 dark:border-slate-700 mb-8 max-w-2xl">
                    <form action="{{ route('layanan.sop') }}" method="GET" class="flex gap-2">
                        <div class="relative flex-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                                <circle cx="11" cy="11" r="8" />
                                <path d="m21 21-4.3-4.3" />
                            </svg>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ __('messages.sop_page.search_placeholder') }}"
                                class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-ppid-primary focus:border-ppid-primary transition-all" />
                        </div>
                        <button type="submit"
                            class="px-6 py-2.5 bg-ppid-primary text-white font-medium rounded-lg hover:bg-ppid-primary/90 transition-colors">
                            {{ __('messages.news.search_btn') }}
                        </button>
                    </form>
                </div>

                {{-- Table --}}
                <div
                    class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-200 dark:border-slate-700 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-ppid-primary text-white">
                                <tr>
                                    <th class="px-6 py-4 text-sm font-semibold w-16 text-center">{{ __('messages.table.no') }}</th>
                                    <th class="px-6 py-4 text-sm font-semibold">{{ __('messages.sop_page.title_column') }}</th>
                                    <th class="px-6 py-4 text-sm font-semibold w-48 text-center">{{ __('messages.sop_page.action_column') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($sopData as $sop)
                                    <tr class="hover:bg-blue-50/50 transition-colors group">
                                        <td class="px-6 py-4 text-center text-gray-500 font-medium">
                                            {{ ($sopData->currentPage() - 1) * $sopData->perPage() + $loop->iteration }}
                                        </td>
                                        <td
                                            class="px-6 py-4 text-gray-800 font-medium group-hover:text-ppid-primary dark:text-white transition-colors uppercase">
                                            {{ $sop->judul }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center justify-center gap-3">
                                                <a href="{{ asset('storage/sop/' . $sop->file) }}" target="_blank"
                                                    class="p-2 text-gray-400 hover:text-ppid-primary dark:text-white hover:bg-gray-100 dark:bg-slate-700 rounded-lg transition-all"
                                                    title="Lihat">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path
                                                            d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0" />
                                                        <circle cx="12" cy="12" r="3" />
                                                    </svg>
                                                </a>
                                                <a href="{{ route('layanan.sop.download', $sop->id) }}"
                                                    class="flex items-center gap-1.5 px-3 py-1.5 bg-ppid-primary/5 text-ppid-primary dark:text-white rounded-lg hover:bg-ppid-primary hover:text-white transition-all text-xs font-bold"
                                                    title="Download">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                                        <polyline points="7 10 12 15 17 10" />
                                                        <line x1="12" x2="12" y1="15" y2="3" />
                                                    </svg>
                                                    {{ $sop->jumlah_download ?? 0 }}
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-12 text-center text-gray-500 italic bg-gray-50">
                                            {{ __('messages.sop_page.no_data') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    @if($sopData->hasPages())
                        <div
                            class="border-t border-gray-200 dark:border-slate-700 px-6 py-4 bg-gray-50 dark:bg-slate-900 flex items-center justify-center">
                            {{ $sopData->appends(request()->query())->links() }}
                        </div>
                    @endif
                </div>


            </div>
        </div>
    </main>

</x-layout>