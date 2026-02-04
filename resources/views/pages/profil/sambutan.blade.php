<x-layout>
    <x-header />

    {{-- Breadcrumb + Title Section --}}
    <div class="bg-white dark:bg-slate-800 border-b border-gray-200 dark:border-slate-700 font-['Plus_Jakarta_Sans']">
        <div class="container mx-auto px-4 py-6">
            {{-- Breadcrumb --}}
            <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300 mb-4">
                <a href="/" class="hover:text-ppid-primary dark:text-white transition-colors">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                        </path>
                    </svg>
                </a>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <a href="#"
                    class="hover:text-ppid-primary dark:text-white transition-colors">{{ __('messages.breadcrumb.profile') }}</a>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span
                    class="text-ppid-primary dark:text-white font-medium">{{ __('messages.profile.greeting_title') }}</span>
            </div>

            {{-- Title --}}
            <div class="flex items-end justify-between">
                <div>
                    <div>
                        <h1 class="text-3xl md:text-4xl font-extrabold text-ppid-primary dark:text-white leading-tight">
                            {{ __('messages.profile.greeting_title') }}
                        </h1>
                        <p class="text-base md:text-lg text-gray-600 dark:text-gray-300 mt-2">
                            {{ __('messages.profile.greeting_subtitle') }}
                        </p>
                    </div>
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
            <div class="max-w-7xl grid grid-cols-1 md:grid-cols-3 gap-8 mx-auto">
                <div class="md:col-span-2 gap-8">
                    {{-- Main Content --}}
                    <div class="w-full space-y-6">
                        {{-- Opening Quote --}}
                        <div class="bg-ppid-primary rounded-xl p-8 md:p-10 text-white relative overflow-hidden">
                            <div class="absolute -right-6 -top-6 text-white/10 text-[120px] leading-none font-serif">"
                            </div>
                            <div class="relative">
                                <p class="text-lg md:text-xl leading-relaxed mb-4 italic">
                                    Transparansi adalah kunci untuk membangun kepercayaan publik dan mewujudkan tata
                                    kelola pemerintahan yang baik
                                </p>
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-0.5 bg-white dark:bg-slate-800/50"></div>
                                    <span class="text-sm text-white/90">Komitmen PPID Sulawesi Selatan</span>
                                </div>
                            </div>
                        </div>

                        {{-- Main Content --}}
                        <div class="prose prose-slate max-w-none dark:prose-invert">
                            {!! $profil->deskripsi ?? 'Konten belum tersedia.' !!}
                        </div>

                        {{-- Closing --}}
                        <div class="mt-8 pt-6 border-t border-gray-200 dark:border-slate-700">
                            <p class="text-gray-900 dark:text-white font-medium mb-6">
                                Wassalamu'alaikum Warahmatullahi Wabarakatuh
                            </p>

                            <div class="flex items-start gap-4">
                                <div class="w-1 h-20 bg-ppid-accent rounded-full"></div>
                                <div>
                                    <p class="font-bold text-gray-900 dark:text-white text-lg">Kepala PPID</p>
                                    <p class="text-gray-600 dark:text-gray-300 text-sm">Provinsi Sulawesi Selatan</p>
                                    <p class="text-gray-500 text-xs mt-1">Pejabat Pengelola Informasi dan Dokumentasi
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Sidebar --}}
                <aside class="space-y-6">
                    {{-- Leadership Card - Kepala PPID --}}
                    <div
                        class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-200 dark:border-slate-700 overflow-hidden top-24">
                        <div class="bg-ppid-primary px-5 py-4">
                            <h3 class="font-bold text-white">Kepala PPID Utama</h3>
                        </div>
                        <div class="p-5">
                            <div class="bg-ppid-primary/5 rounded-lg p-4 border border-ppid-primary/10">
                                <div class="aspect-[3/4] rounded-lg overflow-hidden mb-3 border-4 border-ppid-accent">
                                    @if($profil && $profil->foto_kepala)
                                        <img src="{{ asset('storage/' . $profil->foto_kepala) }}"
                                            alt="Kepala PPID Utama Sulawesi Selatan" class="w-full h-full object-cover">
                                    @else
                                        {{-- Fallback placeholder --}}
                                        <div
                                            class="w-full h-full flex items-center justify-center text-white bg-gradient-to-br from-ppid-primary to-ppid-text">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-20 h-20" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <p class="font-bold text-ppid-primary dark:text-white text-sm mb-1">Dr. H. Andi Sudirman
                                    Sulaiman, SE., MM</p>
                                <p class="text-xs text-ppid-accent font-semibold mb-2">Kepala Dinas Kominfo</p>
                                <div class="w-12 h-0.5 bg-ppid-accent rounded-full mb-2"></div>
                                <p class="text-xs text-gray-600 dark:text-gray-400 leading-relaxed">PPID Utama Provinsi
                                    Sulawesi Selatan</p>
                            </div>
                        </div>
                    </div>
                </aside>

            </div>
        </div>
        </div>
    </main>

    <x-footer />
</x-layout>