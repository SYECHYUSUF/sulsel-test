<section>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('admin.profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2">
                <label for="name" class="text-sm font-medium text-slate-700">Nama Lengkap</label>
                <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name"
                    class="w-full rounded-lg border-slate-200 text-sm focus:ring-indigo-500 focus:border-indigo-500 @error('name') @enderror">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <label for="username" class="text-sm font-medium text-slate-700">Username</label>
                <input id="username" name="username" type="text" value="{{ old('username', $user->username) }}" required autocomplete="username"
                    class="w-full rounded-lg border-slate-200 text-sm focus:ring-indigo-500 focus:border-indigo-500 @error('username') @enderror">
                @error('username') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2 md:col-span-2">
                <label for="email" class="text-sm font-medium text-slate-700">Alamat Email</label>
                <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" autocomplete="email"
                    class="w-full rounded-lg border-slate-200 text-sm focus:ring-indigo-500 focus:border-indigo-500 @error('email') @enderror">
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="flex items-center gap-4 pt-4 border-t border-slate-100">
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-700 transition-colors shadow-sm">
                Simpan Perubahan
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-emerald-600 font-medium">Berhasil disimpan.</p>
            @endif
        </div>
    </form>
</section>