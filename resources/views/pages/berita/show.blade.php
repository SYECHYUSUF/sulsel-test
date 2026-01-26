<x-layout>
    <x-header />

    {{-- Breadcrumb Section --}}
    <div class="bg-gray-50 dark:bg-slate-900 pt-8 pb-4 font-['Plus_Jakarta_Sans']">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap items-center gap-2 text-sm text-gray-600 dark:text-gray-300">
                <a href="/" class="flex items-center gap-1.5 hover:text-[#1A305E] dark:hover:text-[#D4AF37] transition-colors">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                    {{ __('messages.common.home') }}
                </a>
                <svg class="w-4 h-4 text-gray-400 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                <a href="/berita" class="hover:text-[#1A305E] dark:hover:text-[#D4AF37] transition-colors">{{ __('messages.common.news') }}</a>
                <svg class="w-4 h-4 text-gray-400 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                <span class="text-[#1A305E] dark:text-[#D4AF37] font-semibold truncate max-w-[200px] md:max-w-none">{{ Str::limit($berita->judul, 40) }}</span>
            </div>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="pb-16 bg-gray-50 dark:bg-slate-900 font-['Plus_Jakarta_Sans']">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
                
                {{-- Article Content (No Card Style) --}}
                <div class="lg:col-span-8">
                    
                    {{-- Article Header --}}
                    <div class="mb-8">
                        <div class="flex items-center gap-3 mb-4">
                            <a href="/berita?category={{ $berita->id_skpd }}" class="bg-[#1A305E] text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider hover:bg-[#D4AF37] transition-colors">
                                {{ $berita->skpd->nm_skpd ?? 'Umum' }}
                            </a>
                            <span class="text-gray-500 text-sm flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                                {{ \Carbon\Carbon::parse($berita->tgl_upload)->isoFormat('D MMMM Y') }}
                            </span>
                             <span class="text-gray-500 text-sm flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                                {{ number_format($berita->viewers) }} Views
                            </span>
                        </div>
                        <h1 class="text-3xl md:text-4xl font-bold text-[#1A305E] dark:text-white leading-tight mb-6">
                            {{ $berita->judul }}
                        </h1>
                        
                        <div class="rounded-xl overflow-hidden mb-6 shadow-lg">
@if($berita->img_berita)
                             <img src="{{ asset('storage/img_berita/' . $berita->img_berita) }}" 
                                  class="w-full h-auto object-cover" 
                                  alt="{{ $berita->judul }}">
                             @else
                             <div class="w-full h-64 md:h-96 bg-gray-100 dark:bg-slate-700 flex items-center justify-center rounded-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-20 h-20 text-gray-300 dark:text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                             </div>
                             @endif
                        </div>
                    </div>

                    {{-- Article Body --}}
                    <div class="prose prose-lg dark:prose-invert max-w-none text-gray-700 dark:text-gray-300 leading-relaxed text-justify">
                        {!! $berita->deskripsi !!}
                    </div>

                    {{-- Tags & Share --}}
                    <div class="mt-12 pt-8 border-t border-gray-100 dark:border-slate-700">
                        <div class="flex flex-wrap items-center justify-between gap-6">
                            <div class="flex flex-wrap gap-2">
                                <span class="text-sm font-semibold text-gray-700 dark:text-gray-300 mr-2">{{ __('messages.common.categories') }}:</span>
                                <a href="/berita?category={{ $berita->id_skpd }}" class="px-3 py-1 bg-gray-100 dark:bg-slate-700 text-gray-600 dark:text-gray-300 rounded-full text-sm hover:bg-[#1A305E] hover:text-white transition-colors">
                                    #{{ Str::slug($berita->skpd->nm_skpd ?? 'umum') }}
                                </a>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">{{ __('messages.news.share') }}:</span>
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-colors">
                                     <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" stroke="none"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ urlencode($berita->judul) }}" target="_blank" class="w-8 h-8 rounded-full bg-sky-100 text-sky-500 flex items-center justify-center hover:bg-sky-500 hover:text-white transition-colors">
                                     <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" stroke="none"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"/></svg>
                                </a>
                                <a href="https://wa.me/?text={{ urlencode($berita->judul . ' ' . url()->current()) }}" target="_blank" class="w-8 h-8 rounded-full bg-green-100 text-green-600 flex items-center justify-center hover:bg-green-600 hover:text-white transition-colors">
                                     <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" stroke="none"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Sidebar (Right) --}}
                <div class="lg:col-span-4 space-y-8">
                     
                    {{-- Popular News --}}
                    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 p-6">
                        <h3 class="font-bold text-[#1A305E] dark:text-white mb-6 flex items-center gap-2">
                            <span class="w-1 h-6 bg-[#D4AF37] rounded-full"></span>
                            {{ __('messages.common.popular') }}
                        </h3>
                         <div class="space-y-6">
                            @foreach ($recent_news as $index => $recent)
                                <a href="{{ route('berita.show', $recent->slug) }}" class="flex gap-4 group cursor-pointer">
                                    <span class="text-4xl font-bold text-gray-200 group-hover:text-[#D4AF37] transition-colors -mt-2">0{{$index+1}}</span>
                                    <div>
                                        <div class="text-xs text-gray-500 mb-1">
                                            {{ $recent->skpd->nm_skpd ?? 'Umum' }} • {{ \Carbon\Carbon::parse($recent->tgl_upload)->format('d M Y') }}
                                        </div>
                                        <h4 class="text-sm font-bold text-gray-900 dark:text-white leading-snug group-hover:text-[#1A305E] dark:group-hover:text-[#D4AF37] transition-colors line-clamp-2">
                                            {{ $recent->judul }}
                                        </h4>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    {{-- Categories --}}
                    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 p-6">
                        <h3 class="font-bold text-[#1A305E] dark:text-white mb-4 flex items-center gap-2">
                             <span class="w-1 h-6 bg-[#D4AF37] rounded-full"></span>
                            {{ __('messages.common.categories') }}
                        </h3>
                        <div class="space-y-2">
                            @foreach($categories as $cat)
                                <a href="/berita?category={{ $cat->id_skpd }}" class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-slate-700 transition-colors group">
                                    <span class="text-gray-700 font-medium group-hover:text-[#1A305E] dark:text-gray-300 dark:group-hover:text-white line-clamp-1 text-sm">{{ $cat->nm_skpd }}</span>
                                    <span class="bg-gray-100 dark:bg-slate-700 text-gray-500 text-xs px-2 py-1 rounded-full group-hover:bg-[#1A305E] group-hover:text-white transition-colors flex-shrink-0">{{ $cat->berita_count }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <x-footer />
</x-layout>
