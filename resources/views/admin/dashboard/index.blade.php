<x-admin-layout title="Dashboard Admin - PPID Sulsel">
    <x-slot name="header">
        Dashboard
    </x-slot>

    <!-- Main Grid -->
    <div class="grid grid-cols-12 gap-6 pb-10">
        
        <!-- ROW 1 -->
        
        <!-- Left: Duty Officer / Profile Card (Span 4) -->
        <div class="col-span-12 lg:col-span-4 xl:col-span-3">
            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-6 h-full relative overflow-hidden group">
                <!-- Header -->
                <div class="flex justify-between items-start mb-6">
                    <h3 class="text-[#1A305E] font-bold text-lg">Piket Hari Ini</h3>
                    <span class="text-xs font-semibold text-slate-400 bg-slate-50 px-2 py-1 rounded-lg">Shift Pagi</span>
                </div>

                <!-- Profile Content -->
                <div class="flex flex-col items-center text-center mt-4">
                    <div class="relative w-32 h-32 mb-4">
                        <div class="absolute inset-0 bg-[#D4AF37]/20 rounded-full animate-pulse"></div>
                        <img src="https://ui-avatars.com/api/?name=Andi+M&background=1A305E&color=fff" 
                             alt="Officer" 
                             class="relative w-32 h-32 rounded-full object-cover border-4 border-white shadow-lg z-10">
                    </div>
                    
                    <h4 class="text-xl font-bold text-[#1A305E] mb-1">Andi Mulawarman</h4>
                    <p class="text-sm text-slate-500 font-medium mb-4">Staf Layanan Informasi</p>
                    
                    <div class="flex items-center text-xs font-semibold text-slate-400 gap-2 bg-slate-50 px-4 py-2 rounded-full">
                        <svg class="w-4 h-4 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        08:00 AM - 04:00 PM
                    </div>

                    <!-- Carousel Controls (Visual) -->
                    <div class="flex justify-between w-full mt-8 px-2">
                        <button class="p-2 rounded-full bg-slate-50 hover:bg-[#1A305E] hover:text-white text-slate-400 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                        </button>
                        <button class="p-2 rounded-full bg-slate-50 hover:bg-[#1A305E] hover:text-white text-slate-400 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Stats Grid (Span 8) -->
        <div class="col-span-12 lg:col-span-8 xl:col-span-9">
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 h-full">
                
                <!-- Card 1: Permohonan -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 flex flex-col justify-between hover:shadow-md transition-shadow">
                    <div class="flex justify-between items-start">
                        <div>
                            <h2 class="text-3xl font-bold text-[#1A305E] mb-1">40</h2>
                            <p class="text-sm font-semibold text-slate-500">Permohonan</p>
                        </div>
                        <div class="p-3 bg-green-50 rounded-xl text-green-600">
                             <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                    </div>
                    <div class="mt-4 text-xs text-slate-400">
                        Yesterday: <span class="font-bold text-slate-600">32 Permohonan</span>
                    </div>
                </div>

                <!-- Card 2: Keberatan (New Admit) -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 flex flex-col justify-between hover:shadow-md transition-shadow">
                    <div class="flex justify-between items-start">
                        <div>
                            <h2 class="text-3xl font-bold text-[#1A305E] mb-1">21</h2>
                            <p class="text-sm font-semibold text-slate-500">Keberatan</p>
                        </div>
                        <div class="p-3 bg-blue-50 rounded-xl text-blue-600">
                             <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>
                    <div class="mt-4 text-xs text-slate-400">
                        Yesterday: <span class="font-bold text-slate-600">18 Processed</span>
                    </div>
                </div>

                <!-- Card 3: Berita (Operations) -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 flex flex-col justify-between hover:shadow-md transition-shadow">
                    <div class="flex justify-between items-start">
                        <div>
                            <h2 class="text-3xl font-bold text-[#1A305E] mb-1">14</h2>
                            <p class="text-sm font-semibold text-slate-500">Berita Baru</p>
                        </div>
                        <div class="p-3 bg-amber-50 rounded-xl text-amber-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </div>
                    </div>
                    <div class="mt-4 text-xs text-slate-400">
                        Yesterday: <span class="font-bold text-slate-600">9 Published</span>
                    </div>
                </div>

                <!-- Card 4: SKPD (Doctors) -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 flex flex-col justify-between hover:shadow-md transition-shadow">
                    <div class="flex justify-between items-start">
                        <div>
                            <h2 class="text-3xl font-bold text-[#1A305E] mb-1">54</h2>
                            <p class="text-sm font-semibold text-slate-500">SKPD Terdaftar</p>
                        </div>
                         <div class="p-3 bg-emerald-50 rounded-xl text-emerald-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                    </div>
                    <div class="mt-4 text-xs text-slate-400">
                        Active Agencies
                    </div>
                </div>

                <!-- Card 5: Dokumen (Nurses) -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 flex flex-col justify-between hover:shadow-md transition-shadow">
                    <div class="flex justify-between items-start">
                        <div>
                            <h2 class="text-3xl font-bold text-[#1A305E] mb-1">3.6k</h2>
                            <p class="text-sm font-semibold text-slate-500">Total Dokumen</p>
                        </div>
                        <div class="p-3 bg-indigo-50 rounded-xl text-indigo-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                    </div>
                    <div class="mt-4 text-xs text-slate-400">
                        Available Publicly
                    </div>
                </div>

                <!-- Card 6: Earnings (Visitor or similar) -->
                 <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 flex flex-col justify-between hover:shadow-md transition-shadow">
                    <div class="flex justify-between items-start">
                        <div>
                            <h2 class="text-3xl font-bold text-[#1A305E] mb-1">12k</h2>
                            <p class="text-sm font-semibold text-slate-500">Visitor Bulanan</p>
                        </div>
                        <div class="p-3 bg-red-50 rounded-xl text-red-600">
                           <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>
                    <div class="mt-4 text-xs text-slate-400">
                        Yesterday: <span class="font-bold text-slate-600">420 Visits</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- ROW 2 -->
        
        <!-- Left: Survey Chart (Span 8) -->
        <div class="col-span-12 lg:col-span-8">
            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-[#1A305E] font-bold text-lg">Statistik Layanan Informasi</h3>
                    <div class="flex items-center space-x-4 text-xs font-semibold">
                        <div class="flex items-center"><span class="w-2 h-2 rounded-full bg-[#1A305E] mr-2"></span> Permohonan</div>
                        <div class="flex items-center"><span class="w-2 h-2 rounded-full bg-[#D4AF37] mr-2"></span> Keberatan</div>
                    </div>
                </div>
                
                <!-- CSS Bar Chart Visualization -->
                <div class="relative h-64 flex items-end justify-between px-2 gap-2">
                    <!-- Grid Lines -->
                    <div class="absolute inset-0 flex flex-col justify-between pointer-events-none">
                        <div class="border-b border-slate-50 w-full h-full"></div>
                        <div class="border-b border-slate-50 w-full h-full"></div>
                        <div class="border-b border-slate-50 w-full h-full"></div>
                        <div class="border-b border-slate-50 w-full h-full"></div>
                    </div>

                    <!-- Bars (Loop 12 months roughly) -->
                    @foreach(['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'] as $index => $month)
                         <div class="flex flex-col items-center justify-end h-full w-full group relative z-10">
                            <!-- Tooltip container -->
                            <div class="flex items-end justify-center w-full gap-1 h-full pb-6">
                                <div class="w-2.5 bg-[#1A305E] rounded-t-sm transition-all duration-500 hover:opacity-80" style="height: {{ rand(30, 90) }}%"></div>
                                <div class="w-2.5 bg-[#D4AF37] rounded-t-sm transition-all duration-500 hover:opacity-80" style="height: {{ rand(10, 60) }}%"></div>
                            </div>
                            <span class="text-[10px] text-slate-400 absolute bottom-0">{{ $month }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Right: Calendar (Span 4) -->
        <div class="col-span-12 lg:col-span-4">
             <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-6 h-full">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-[#1A305E] font-bold text-lg">Calendar</h3>
                    <div class="flex space-x-1">
                        <button class="p-1 text-slate-400 hover:text-[#1A305E]"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg></button>
                         <span class="text-xs font-bold text-slate-600 self-center">Dec 2025</span>
                        <button class="p-1 text-slate-400 hover:text-[#1A305E]"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></button>
                    </div>
                </div>

                <!-- Calendar Grid -->
                <div class="grid grid-cols-7 gap-1 text-center text-xs mb-2">
                    <span class="text-slate-400 py-1">Su</span>
                    <span class="text-slate-400 py-1">Mo</span>
                    <span class="text-slate-400 py-1">Tu</span>
                    <span class="text-slate-400 py-1">We</span>
                    <span class="text-slate-400 py-1">Th</span>
                    <span class="text-slate-400 py-1">Fr</span>
                    <span class="text-slate-400 py-1">Sa</span>
                </div>
                <div class="grid grid-cols-7 gap-1 text-center text-xs font-medium">
                    <!-- Days derived roughly from ref or random -->
                    @for($i = 24; $i <= 31; $i++) <span class="py-2 rounded-full text-slate-300">{{ $i }}</span> @endfor
                    
                    @for($i = 1; $i <= 31; $i++)
                        @php $isToday = $i == 20; @endphp
                        <span class="py-2.5 flex items-center justify-center rounded-full cursor-pointer hover:bg-slate-50 transition-colors {{ $isToday ? 'bg-[#1A305E] text-white shadow-md' : 'text-slate-600' }}">
                            {{ $i }}
                        </span>
                    @endfor
                    
                     @for($i = 1; $i <= 4; $i++) <span class="py-2 rounded-full text-slate-300">{{ $i }}</span> @endfor
                </div>
            </div>
        </div>

    </div>
</x-admin-layout>
