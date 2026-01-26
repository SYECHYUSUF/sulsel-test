<x-layout>
    <x-header />

    {{-- Breadcrumb + Title Section --}}
    <div class="bg-white dark:bg-slate-800 border-b border-gray-200 dark:border-slate-700 font-['Plus_Jakarta_Sans']">
        <div class="container mx-auto px-4 py-8">
            {{-- Breadcrumb --}}
            <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300 mb-4">
                <a href="/" class="hover:text-[#1A305E] dark:text-white transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                </a>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-gray-400"><path d="m9 18 6-6-6-6"/></svg>
                <span class="text-[#1A305E] dark:text-white font-medium">Profil</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-gray-400"><path d="m9 18 6-6-6-6"/></svg>
                <span class="text-[#1A305E] dark:text-white font-bold">PPID Pelaksana</span>
            </div>
          
            {{-- Title --}}
            <div class="flex items-end justify-between">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold text-[#1A305E] dark:text-white mb-2">
                        PPID Pelaksana
                    </h1>
                    <p class="text-gray-600 dark:text-gray-300">
                        Daftar PPID Pelaksana di Lingkup Pemerintah Provinsi Sulawesi Selatan
                    </p>
                </div>
                <div class="hidden md:block">
                    <div class="w-24 h-1.5 bg-gradient-to-r from-[#1A305E] to-[#D4AF37] rounded-full"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content --}}
    <main class="py-12 md:py-16 bg-gray-50 dark:bg-slate-900 font-['Plus_Jakarta_Sans']">
        <div class="container mx-auto px-4">
            <div class="max-w-7xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($ppidData as $ppid)
                        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-gray-100 p-8 hover:shadow-xl transition-all hover:border-[#D4AF37]/30 group hover:-translate-y-1 relative overflow-hidden">
                            
                            {{-- Decorative Top Border --}}
                            <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-[#1A305E] to-[#D4AF37] opacity-0 group-hover:opacity-100 transition-opacity"></div>

                            {{-- Logo --}}
                            <div class="flex justify-center mb-6 relative z-10">
                                <div class="w-20 h-20 bg-gray-50 dark:bg-slate-700 rounded-full flex items-center justify-center shadow-inner group-hover:bg-white dark:group-hover:bg-slate-800 transition-colors">
                                    
                                    @if($ppid->logo)
                                        {{-- Jika logo SKPD ada --}}
                                        <img src="{{ asset('storage/logo-skpd/' . $ppid->logo) }}" 
                                            alt="Logo {{ $ppid->nama_skpd }}" 
                                            class="w-14 h-14 object-contain">
                                    @else
                                        {{-- Jika logo kosong, gunakan default --}}
                                        <img src="{{ asset('images/logo-sulsel.png') }}" 
                                            alt="Logo Default" 
                                            class="w-14 h-14 object-contain">
                                    @endif

                                </div>
                            </div>

                            {{-- Name --}}
                            <h3 class="text-center font-bold text-[#1A305E] dark:text-white mb-6 text-base leading-snug min-h-[50px] flex items-center justify-center">
                                {{ $ppid->nm_skpd }}
                            </h3>

                            {{-- Divider --}}
                            <div class="w-full h-px bg-gray-100 dark:bg-slate-700 mb-6 group-hover:bg-[#D4AF37]/20 transition-colors"></div>

                            {{-- Contact Info --}}
                            <div class="space-y-4 text-sm text-gray-600 dark:text-gray-300">
                                <div class="flex items-start gap-3">
                                   <div class="w-7 h-7 rounded-lg bg-blue-50 dark:bg-slate-700 text-[#1A305E] dark:text-gray-200 flex items-center justify-center flex-shrink-0 mt-0.5 group-hover:bg-[#1A305E] group-hover:text-white transition-colors">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                                   </div>
                                    <div>
                                        <p class="font-bold text-[#1A305E] dark:text-white text-xs uppercase mb-0.5">Alamat</p>
                                        <p class="leading-relaxed text-xs">{{ $ppid->alamat ?? '-' }}</p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-3">
                                     <div class="w-7 h-7 rounded-lg bg-blue-50 dark:bg-slate-700 text-[#1A305E] dark:text-gray-200 flex items-center justify-center flex-shrink-0 mt-0.5 group-hover:bg-[#1A305E] group-hover:text-white transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                     </div>
                                    <div>
                                        <p class="font-bold text-[#1A305E] dark:text-white text-xs uppercase mb-0.5">Telepon</p>
                                        <p class="text-xs">{{ $ppid->no_telp ?? '-' }}</p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-3">
                                     <div class="w-7 h-7 rounded-lg bg-blue-50 dark:bg-slate-700 text-[#1A305E] dark:text-gray-200 flex items-center justify-center flex-shrink-0 mt-0.5 group-hover:bg-[#1A305E] group-hover:text-white transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                                     </div>
                                    <div class="min-w-0">
                                        <p class="font-bold text-[#1A305E] dark:text-white text-xs uppercase mb-0.5">Email</p>
                                        <a href="mailto:{{ $ppid->email }}" class="text-[#1A305E] dark:text-white hover:underline break-all group-hover:text-[#D4AF37] transition-colors text-xs truncate block">
                                            {{ $ppid->email ?? '-' }}
                                        </a>
                                    </div>
                                </div>

                                <div class="flex items-start gap-3">
                                     <div class="w-7 h-7 rounded-lg bg-blue-50 dark:bg-slate-700 text-[#1A305E] dark:text-gray-200 flex items-center justify-center flex-shrink-0 mt-0.5 group-hover:bg-[#1A305E] group-hover:text-white transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" x2="22" y1="12" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1 4-10z"/></svg>
                                     </div>
                                    <div class="min-w-0">
                                        <p class="font-bold text-[#1A305E] dark:text-white text-xs uppercase mb-0.5">Website</p>
                                        <a href="{{ $ppid->website }}" target="_blank" rel="noopener noreferrer" class="text-[#1A305E] dark:text-white hover:underline break-all group-hover:text-[#D4AF37] transition-colors text-xs truncate block">
                                            {{ $ppid->website ?? '-' }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="mt-12 flex justify-center">
                    {{ $ppidData->links('pagination::tailwind') }}
                </div>

            </div>
        </div>
    </main>

    <x-footer />
</x-layout>
