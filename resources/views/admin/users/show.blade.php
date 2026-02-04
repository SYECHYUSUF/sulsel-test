<x-admin-layout>
    <x-slot:title>Detail User - {{ $user->name }}</x-slot:title>

    <div class="space-y-6">
        {{-- Header Area --}}
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.users.index') }}" 
                    class="p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-100 dark:hover:bg-slate-700 dark:hover:text-slate-300 rounded-xl transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
                <div>
                    <h1 class="text-2xl font-bold text-slate-900 dark:text-slate-100">Detail User</h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm">Informasi lengkap akun pengguna dan akses sistem.</p>
                </div>
            </div>
            
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Profile Card --}}
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl p-6 shadow-sm text-center">
                    <div class="mb-4 inline-flex items-center justify-center w-24 h-24 rounded-full bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 text-3xl font-bold">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <h2 class="text-xl font-bold text-slate-900 dark:text-slate-100">{{ $user->name }}</h2>
                    <p class="text-slate-500 dark:text-slate-400 text-sm mb-4">{{ $user->username }}</p>
                    
                    <div class="flex flex-wrap justify-center gap-2">
                        @foreach($user->roles as $role)
                            <span class="px-3 py-1 bg-indigo-50 dark:bg-indigo-900/20 text-indigo-600 dark:text-indigo-400 border border-indigo-100 dark:border-indigo-800 rounded-full text-xs font-semibold">
                                {{ $role->display_name ?? $role->name }}
                            </span>
                        @endforeach
                    </div>
                </div>

                {{-- Account Metadata --}}
                <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl p-6 shadow-sm">
                    <h3 class="font-bold text-slate-900 dark:text-slate-100 mb-4 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Info Akun
                    </h3>
                    <div class="space-y-4">
                        <div>
                            <div class="text-xs text-slate-400 uppercase tracking-wider mb-1">Email</div>
                            <div class="text-sm font-medium text-slate-700 dark:text-slate-200">{{ $user->email ?: '-' }}</div>
                        </div>
                        <div>
                            <div class="text-xs text-slate-400 uppercase tracking-wider mb-1">Dibuat Pada</div>
                            <div class="text-sm font-medium text-slate-700 dark:text-slate-200">
                                {{ $user->created_at?->translatedFormat('d M Y, H:i') ?? '-' }}
                            </div>
                        </div>
                        <div>
                            <div class="text-xs text-slate-400 uppercase tracking-wider mb-1">Terakhir Diperbarui</div>
                            <div class="text-sm font-medium text-slate-700 dark:text-slate-200">
                                {{ $user->updated_at?->translatedFormat('d M Y, H:i') ?? '-' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Main Details --}}
            <div class="lg:col-span-2 space-y-6">
                {{-- SKPD Detail --}}
                <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl overflow-hidden shadow-sm">
                    <div class="bg-slate-50 dark:bg-slate-700/50 px-6 py-4 border-b border-slate-200 dark:border-slate-700">
                        <h3 class="font-bold text-slate-900 dark:text-slate-100 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            Informasi SKPD
                        </h3>
                    </div>
                    <div class="p-6">
                        @if($user->skpd)
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <div class="text-xs text-slate-400 uppercase tracking-wider mb-1">Nama SKPD</div>
                                    <div class="font-medium text-slate-900 dark:text-slate-100">{{ $user->skpd->nm_skpd }}</div>
                                </div>
                            </div>
                        @else
                            <div class="text-center py-4 text-slate-500 italic">
                                User ini tidak terasosiasi dengan SKPD manapun.
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Roles & Permissions Detail --}}
                <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl overflow-hidden shadow-sm">
                    <div class="bg-slate-50 dark:bg-slate-700/50 px-6 py-4 border-b border-slate-200 dark:border-slate-700">
                        <h3 class="font-bold text-slate-900 dark:text-slate-100 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            Hak Akses (Roles)
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-6">
                            @forelse($user->roles as $role)
                                <div>
                                    <div class="flex items-center gap-2 mb-2">
                                        <div class="w-2 h-2 rounded-full bg-indigo-500"></div>
                                        <div class="font-bold text-slate-900 dark:text-slate-100">{{ $role->display_name ?: $role->name }}</div>
                                    </div>
                                    <p class="text-sm text-slate-500 dark:text-slate-400 ml-4 mb-3">
                                        {{ $role->description ?: 'Tidak ada deskripsi peran.' }}
                                    </p>
                                    
                                    {{-- Permissions List --}}
                                    <div class="ml-4 flex flex-wrap gap-2">
                                        @foreach($role->permissions as $permission)
                                            <span class="px-2 py-1 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 rounded text-[10px] uppercase font-bold tracking-tight">
                                                {{ $permission->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-4 text-slate-500 italic">
                                    User ini tidak memiliki peran akses.
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- Log Login --}}
                <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl overflow-hidden shadow-sm">
                    <div class="bg-slate-50 dark:bg-slate-700/50 px-6 py-4 border-b border-slate-200 dark:border-slate-700 flex justify-between items-center">
                        <h3 class="font-bold text-slate-900 dark:text-slate-100 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Aktivitas Login Terakhir
                        </h3>
                    </div>
                    <div class="p-6">
                        @if($user->lastLogin)
                            <div class="flex items-center gap-4">
                                <div class="p-3 bg-emerald-50 dark:bg-emerald-900/20 rounded-xl text-emerald-600 dark:text-emerald-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-bold text-slate-900 dark:text-slate-100">Login Berhasil</div>
                                    <div class="text-sm text-slate-500 dark:text-slate-400">
                                        {{ $user->lastLogin?->createdAt?->translatedFormat('d F Y \p\u\k\u\l H:i:s') ?? 'Belum pernah login' }}
                                    </div>
                                    <div class="text-xs text-slate-400 mt-1">IP Address: {{ $user->lastLogin->ip }}</div>
                                </div>
                            </div>
                        @else
                            <div class="text-center py-4 text-slate-500 italic">
                                Belum ada riwayat login tercatat.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
