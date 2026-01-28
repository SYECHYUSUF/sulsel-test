{{-- News Sidebar Component --}}
<div class="space-y-6">
    {{-- Berita Terkini --}}
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-200 dark:border-slate-700 overflow-hidden">
        <div class="bg-[#1A305E] px-5 py-4">
            <div class="flex items-center gap-3 text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                </svg>
                <h3 class="font-bold">Berita Terkini</h3>
            </div>
        </div>

        <div class="divide-y divide-gray-200 dark:divide-slate-700">
            @if(isset($recentNews) && $recentNews->count() > 0)
                @foreach($recentNews as $news)
                <a href="{{ route('berita.show', $news->slug) }}" class="block p-4 hover:bg-gray-50 dark:hover:bg-slate-700 transition-colors group">
                    <h4 class="font-semibold text-gray-900 dark:text-white text-sm mb-1 group-hover:text-[#1A305E] dark:group-hover:text-[#D4AF37] transition-colors line-clamp-2">
                        {{ $news->judul }}
                    </h4>
                    <div class="flex items-center gap-1.5 text-xs text-gray-500 dark:text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ \Carbon\Carbon::parse($news->tgl_upload)->diffForHumans() }}</span>
                    </div>
                </a>
                @endforeach
            @else
                <div class="p-4 text-center text-gray-500 dark:text-gray-400 text-sm">
                    Belum ada berita terbaru
                </div>
            @endif
        </div>

        <div class="p-4 bg-gray-50 dark:bg-slate-900">
            <a href="/berita" class="flex items-center justify-center gap-2 text-sm font-semibold text-[#1A305E] dark:text-white hover:text-[#D4AF37] transition-colors">
                <span>Lihat Semua Berita</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </div>

    {{-- Quick Links --}}
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-200 dark:border-slate-700 p-5">
        <h3 class="font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#D4AF37]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
            </svg>
            Link Cepat
        </h3>
        <div class="space-y-2">
            @php
                $quickLinks = [
                    ['label' => 'Permohonan Informasi', 'url' => '/layanan/permohonan-informasi'],
                    ['label' => 'Pengajuan Keberatan', 'url' => '/layanan/pengajuan-keberatan'],
                    ['label' => 'Informasi Publik', 'url' => '/informasi-publik'],
                    ['label' => 'SOP Layanan', 'url' => '/layanan/sop'],
                ];
            @endphp
            @foreach($quickLinks as $link)
            <a href="{{ $link['url'] }}" class="flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300 hover:text-[#1A305E] dark:hover:text-[#D4AF37] transition-colors group">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#D4AF37] group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span>{{ $link['label'] }}</span>
            </a>
            @endforeach
        </div>
    </div>
</div>
