<header class="z-10 bg-slate-50 sticky top-0 h-20 flex items-center justify-between px-8 py-5">
    <!-- Search Bar (New) -->
    <div class="flex-1 max-w-2xl">
        <div class="relative group">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                <svg class="w-5 h-5 text-slate-400 group-hover:text-[#D4AF37] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </span>
            <input type="text" 
                   class="w-full py-2.5 pl-10 pr-4 text-sm text-slate-700 bg-white border border-slate-200 rounded-full focus:outline-none focus:ring-2 focus:ring-[#D4AF37]/50 focus:border-[#D4AF37] transition-all shadow-sm placeholder-slate-400"
                   placeholder="Search..."
            >
        </div>
    </div>

    <!-- Right Actions -->
    <div class="flex items-center space-x-6 ml-4">
        <!-- Notification -->
        <button class="relative p-2 text-slate-400 hover:text-[#1A305E] transition-colors group">
            <span class="absolute top-2 right-2 h-2.5 w-2.5 rounded-full bg-[#D4AF37] border-2 border-slate-50"></span>
            <svg class="w-6 h-6 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
            </svg>
        </button>

        <!-- Divider -->
        <div class="h-8 w-px bg-slate-200"></div>

        <!-- User Profile -->
        <div class="flex items-center space-x-3 cursor-pointer group relative">
             <div class="h-10 w-10 rounded-full bg-slate-200 flex items-center justify-center overflow-hidden border-2 border-white shadow-md ring-2 ring-transparent group-hover:ring-[#D4AF37]/50 transition-all">
                <img src="https://ui-avatars.com/api/?name=Admin+User&background=1A305E&color=D4AF37" alt="Admin" class="h-full w-full object-cover">
            </div>
            <div class="text-left hidden lg:block">
                <div class="flex items-center">
                    <span class="text-sm font-bold text-[#1A305E] group-hover:text-[#D4AF37] transition-colors">Dr. Monica</span> <!-- Placeholder Name as in Ref -->
                    <svg class="w-4 h-4 text-slate-400 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </div>
                <div class="text-[10px] text-slate-500 font-medium">Administrator</div>
            </div>
        </div>
    </div>
</header>
