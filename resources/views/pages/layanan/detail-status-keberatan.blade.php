<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengajuan Keberatan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        
        /* Animated gradient background */
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        .animated-bg {
            background: linear-gradient(-45deg, #667eea 0%, #764ba2 25%, #f093fb 50%, #4facfe 75%, #667eea 100%);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }
        
        /* Floating animation */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        .float-animation {
            animation: float 6s ease-in-out infinite;
        }
        
        /* Glassmorphism */
        .glass {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.8);
        }
        
        /* Pulse animation for status */
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 20px currentColor; opacity: 1; }
            50% { box-shadow: 0 0 40px currentColor; opacity: 0.8; }
        }
        
        .status-pulse {
            animation: pulse-glow 2s ease-in-out infinite;
        }
    </style>
</head>
<body class="animated-bg min-h-screen p-4 md:p-8">
    
    <!-- Decorative floating circles -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-72 h-72 bg-white/10 rounded-full blur-3xl float-animation"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-white/10 rounded-full blur-3xl float-animation" style="animation-delay: 1s;"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-white/10 rounded-full blur-3xl float-animation" style="animation-delay: 2s;"></div>
    </div>
    
    <div class="relative max-w-5xl mx-auto z-10">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('layanan.pengajuan-keberatan.check-status') }}" 
               class="inline-flex items-center gap-2 px-4 py-2 bg-white/20 backdrop-blur-xl border border-white/40 rounded-xl text-white hover:bg-white/30 transition-all shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span class="font-semibold">Kembali ke Pencarian</span>
            </a>
        </div>
        
        <!-- Main Card with Glassmorphism -->
        <div class="glass rounded-3xl shadow-2xl overflow-hidden">
            <!-- Gradient accent bar with status color -->
            @if($pengajuan->status == 'y')
                <div class="h-2 bg-gradient-to-r from-emerald-500 via-green-500 to-teal-500"></div>
            @elseif($pengajuan->status == 't')
                <div class="h-2 bg-gradient-to-r from-red-500 via-rose-500 to-pink-500"></div>
            @elseif($pengajuan->status == 'a')
                <div class="h-2 bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500"></div>
            @else
                <div class="h-2 bg-gradient-to-r from-amber-500 via-yellow-500 to-orange-500"></div>
            @endif
            
            <div class="p-8 md:p-10">
                <!-- Header with Status Badge -->
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-8">
                    <div>
                        <h1 class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 bg-clip-text text-transparent mb-2">
                            Detail Pengajuan Keberatan
                        </h1>
                        <p class="text-slate-600 text-sm">Nomor Pendaftaran: <span class="font-bold text-slate-800">{{ $pengajuan->no_pendaftaran }}</span></p>
                    </div>
                    
                    <!-- Status Badge with glow effect -->
                    <div class="flex-shrink-0">
                        @if($pengajuan->status == 'y')
                            <div class="relative">
                                <div class="absolute inset-0 bg-emerald-400 rounded-2xl blur-lg opacity-50"></div>
                                <div class="relative px-6 py-3 bg-gradient-to-r from-emerald-500 to-green-600 rounded-2xl shadow-xl">
                                    <div class="flex items-center gap-2 text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span class="font-bold text-lg">Disetujui</span>
                                    </div>
                                </div>
                            </div>
                        @elseif($pengajuan->status == 't')
                            <div class="relative">
                                <div class="absolute inset-0 bg-red-400 rounded-2xl blur-lg opacity-50"></div>
                                <div class="relative px-6 py-3 bg-gradient-to-r from-red-500 to-rose-600 rounded-2xl shadow-xl">
                                    <div class="flex items-center gap-2 text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span class="font-bold text-lg">Ditolak</span>
                                    </div>
                                </div>
                            </div>
                        @elseif($pengajuan->status == 'a')
                            <div class="relative">
                                <div class="absolute inset-0 bg-blue-400 rounded-2xl blur-lg opacity-50"></div>
                                <div class="relative px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-2xl shadow-xl">
                                    <div class="flex items-center gap-2 text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                        </svg>
                                        <span class="font-bold text-lg">Dijawab</span>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="relative">
                                <div class="absolute inset-0 bg-amber-400 rounded-2xl blur-lg opacity-50 status-pulse"></div>
                                <div class="relative px-6 py-3 bg-gradient-to-r from-amber-500 to-orange-600 rounded-2xl shadow-xl">
                                    <div class="flex items-center gap-2 text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 animate-spin" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                        </svg>
                                        <span class="font-bold text-lg">Dalam Proses</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                
                <!-- Info Grid with Glassmorphism Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- Tanggal Pengajuan -->
                    <div class="relative overflow-hidden rounded-2xl p-5" style="background: linear-gradient(135deg, rgba(99, 102, 241, 0.05) 0%, rgba(168, 85, 247, 0.05) 100%); backdrop-filter: blur(10px); border: 1px solid rgba(99, 102, 241, 0.2);">
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <dt class="text-sm font-semibold text-slate-600 mb-1">Tanggal Pengajuan</dt>
                                <dd class="text-lg font-bold text-slate-900">{{ $pengajuan->created_at->format('d F Y H:i') }}</dd>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Nama Pemohon -->
                    <div class="relative overflow-hidden rounded-2xl p-5" style="background: linear-gradient(135deg, rgba(236, 72, 153, 0.05) 0%, rgba(219, 39, 119, 0.05) 100%); backdrop-filter: blur(10px); border: 1px solid rgba(236, 72, 153, 0.2);">
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-pink-500 to-rose-600 rounded-xl flex items-center justify-center shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <dt class="text-sm font-semibold text-slate-600 mb-1">Nama Pemohon</dt>
                                <dd class="text-lg font-bold text-slate-900">{{ $pengajuan->nama_pemohon }}</dd>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Alasan Keberatan -->
                <div class="mb-8">
                    <div class="relative overflow-hidden rounded-2xl p-6" style="background: linear-gradient(135deg, rgba(251, 146, 60, 0.08) 0%, rgba(249, 115, 22, 0.05) 100%); backdrop-filter: blur(10px); border: 1px solid rgba(251, 146, 60, 0.2);">
                        <h3 class="text-lg font-bold text-slate-900 mb-4 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            Alasan Keberatan
                        </h3>
                        <ul class="space-y-2">
                            @foreach($pengajuan->alasanPengajuan as $alasan)
                                <li class="flex items-start gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-slate-700 font-medium">{{ $alasan->alasan }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                
                <!-- Kasus Posisi -->
                <div class="mb-8">
                    <div class="relative overflow-hidden rounded-2xl p-6" style="background: linear-gradient(135deg, rgba(59, 130, 246, 0.08) 0%, rgba(37, 99, 235, 0.05) 100%); backdrop-filter: blur(10px); border: 1px solid rgba(59, 130, 246, 0.2);">
                        <h3 class="text-lg font-bold text-slate-900 mb-3 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Kasus Posisi
                        </h3>
                        <p class="text-slate-700 leading-relaxed whitespace-pre-line">{{ $pengajuan->kasus }}</p>
                    </div>
                </div>
                
                <!-- Tanggapan Admin (if exists) -->
                @if($pengajuan->feedback)
                    <div class="relative">
                        <!-- Glow effect -->
                        <div class="absolute inset-0 bg-gradient-to-r from-emerald-400 via-teal-400 to-cyan-400 rounded-3xl blur-2xl opacity-20"></div>
                        
                        <div class="relative overflow-hidden rounded-3xl p-8" style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.12) 0%, rgba(5, 150, 105, 0.08) 100%); backdrop-filter: blur(20px); border: 2px solid rgba(16, 185, 129, 0.3);">
                            <!-- Icon header -->
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-14 h-14 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl flex items-center justify-center shadow-xl">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-emerald-900">Tanggapan Admin</h3>
                                    <p class="text-sm text-emerald-700">Respon resmi dari administrator</p>
                                </div>
                            </div>
                            
                            <!-- Feedback content -->
                            <div class="bg-white/60 rounded-2xl p-6 border border-emerald-200/50 mb-4">
                                <p class="text-slate-800 leading-relaxed whitespace-pre-line text-base">{{ $pengajuan->feedback }}</p>
                            </div>
                            
                            <!-- Meta info -->
                            <div class="flex items-center gap-2 text-sm text-emerald-800">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="font-semibold">Dijawab pada:</span>
                                <span>{{ \Carbon\Carbon::parse($pengajuan->tgl_feedback)->format('d F Y H:i') }}</span>
                                @if($pengajuan->feedbackBy)
                                    <span class="mx-2">•</span>
                                    <span class="font-semibold">oleh {{ $pengajuan->feedbackBy->name }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
</body>
</html>
