<section>
    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div class="space-y-4">
            <div class="space-y-2">
                <label for="update_password_current_password" class="text-sm font-medium text-slate-700">Kata Sandi Saat Ini</label>
                <input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password"
                    class="w-full rounded-lg border-slate-200 text-sm focus:ring-indigo-500 focus:border-indigo-500 @error('current_password', 'updatePassword') border-red-500 @enderror">
                @error('current_password', 'updatePassword') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label for="update_password_password" class="text-sm font-medium text-slate-700">Kata Sandi Baru</label>
                    <input id="update_password_password" name="password" type="password" autocomplete="new-password"
                        class="w-full rounded-lg border-slate-200 text-sm focus:ring-indigo-500 focus:border-indigo-500 @error('password', 'updatePassword') border-red-500 @enderror">
                    @error('password', 'updatePassword') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label for="update_password_password_confirmation" class="text-sm font-medium text-slate-700">Konfirmasi Kata Sandi Baru</label>
                    <input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password"
                        class="w-full rounded-lg border-slate-200 text-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>
            </div>
        </div>

        <div class="flex items-center gap-4 pt-4 border-t border-slate-100">
            <button type="submit" class="px-4 py-2 bg-[#1A305E] text-white rounded-lg text-sm font-medium hover:bg-slate-800 transition-colors shadow-sm">
                Perbarui Kata Sandi
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-emerald-600 font-medium">Kata sandi berhasil diperbarui.</p>
            @endif
        </div>
    </form>
</section>