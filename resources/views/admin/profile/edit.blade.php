<x-admin-layout>
    <x-slot:title>Profil</x-slot:title>

    <div class="max-w-5xl mx-auto space-y-6">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 flex flex-col md:flex-row items-center gap-6">
            <div class="w-24 h-24 bg-indigo-100 text-indigo-600 rounded-2xl flex items-center justify-center text-3xl font-bold border-4 border-white shadow-sm">
                {{ substr($user->name, 0, 1) }}
            </div>
            <div class="text-center md:text-left flex-1">
                <h1 class="text-2xl font-bold text-slate-900">{{ $user->name }}</h1>
                <p class="text-slate-500 text-sm italic">@ {{ $user->username }}</p>
                <div class="mt-2 flex flex-wrap justify-center md:justify-start gap-2">
                    <span class="px-3 py-1 bg-indigo-50 text-indigo-700 rounded-full text-xs font-bold border border-indigo-100">
                        {{ $user->roles->first()->display_name ?? 'User' }}
                    </span>
                    @if($user->id_skpd)
                    <span class="px-3 py-1 bg-slate-50 text-slate-600 rounded-full text-xs font-medium border border-slate-100">
                        {{ $user->skpd->nm_skpd ?? $user->id_skpd }}
                    </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="p-6 border-b border-slate-100">
                    <h3 class="font-bold text-slate-900">Keamanan Akun</h3>
                    <p class="text-slate-500 text-xs">Pastikan akun Anda menggunakan kata sandi yang panjang dan acak.</p>
                </div>
                <div class="p-6 pt-0">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="p-6 border-b border-slate-100">
                    <h3 class="font-bold text-slate-900">Informasi Profil</h3>
                    <p class="text-slate-500 text-xs">Perbarui nama, username, atau alamat email.</p>
                </div>
                <div class="p-6 pt-0">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>