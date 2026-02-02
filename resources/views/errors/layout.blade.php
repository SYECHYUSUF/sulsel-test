<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ request()->cookie('theme', 'light') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - PPID Sulawesi Selatan</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        @keyframes float-slow {
            0%, 100% { transform: translateY(0px) translateX(0px); }
            50% { transform: translateY(-15px) translateX(10px); }
        }
        
        @keyframes pulse-glow {
            0%, 100% { opacity: 0.5; }
            50% { opacity: 0.8; }
        }
        
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
        
        .animate-float-slow {
            animation: float-slow 4s ease-in-out infinite;
        }
        
        .animate-pulse-glow {
            animation: pulse-glow 2s ease-in-out infinite;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 50%, #0ea5e9 100%);
        }
        
        .dark .gradient-bg {
            background: linear-gradient(135deg, #020617 0%, #0f172a 50%, #1e3a8a 100%);
        }
        
        .liquid-blob {
            position: absolute;
            border-radius: 40% 60% 70% 30% / 40% 50% 60% 50%;
            background: linear-gradient(135deg, rgba(30, 58, 138, 0.3) 0%, rgba(14, 165, 233, 0.2) 100%);
            filter: blur(40px);
            animation: float-slow 6s ease-in-out infinite;
        }
    </style>
</head>
<body class="bg-background text-foreground overflow-x-hidden" id="app-body">
    <!-- Accessibility Menu -->
    <x-accessibility-menu />
    
    <!-- Minimal Header -->
    <nav class="fixed top-0 left-0 right-0 z-40 bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-800">
        <div class="container mx-auto px-4 py-3">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <a href="/" class="flex items-center gap-3">
                    <img src="{{ asset('images/logo-ppid.png') }}" alt="Logo PPID" class="h-10 w-auto">
                </a>
                
                <!-- Right Actions -->
                <div class="flex items-center gap-3">
                    <!-- Language Switcher -->
                    <button onclick="toggleLanguage()" 
                            class="px-3 py-1.5 text-sm font-medium text-slate-700 dark:text-slate-300 hover:text-[#1e3a8a] dark:hover:text-sky-400 transition-colors">
                        <span id="current-lang">{{ app()->getLocale() == 'id' ? 'ID' : 'EN' }}</span>
                    </button>
                    
                    <!-- Dark Mode Toggle -->
                    <button id="theme-toggle" 
                            class="p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                        <svg class="w-5 h-5 hidden dark:block text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"/>
                        </svg>
                        <svg class="w-5 h-5 block dark:hidden text-slate-700" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Main Content -->
    <main class="min-h-screen pt-16 relative gradient-bg">
        <!-- Floating Blob Backgrounds -->
        <div class="liquid-blob" style="width: 300px; height: 300px; top: 10%; left: 10%;"></div>
        <div class="liquid-blob" style="width: 400px; height: 400px; top: 50%; right: 5%; animation-delay: 1s;"></div>
        <div class="liquid-blob" style="width: 250px; height: 250px; bottom: 10%; left: 40%; animation-delay: 2s;"></div>
        
        @yield('content')
    </main>
    
    <!-- Minimal Footer -->
    <footer class="relative z-10 bg-slate-900/50 backdrop-blur-md border-t border-slate-800">
        <div class="container mx-auto px-4 py-6">
            <p class="text-center text-sm text-slate-400">
                &copy; {{ date('Y') }} PPID Provinsi Sulawesi Selatan. All Rights Reserved.
            </p>
        </div>
    </footer>
    
    <script>
        // Theme Toggle
        const themeToggle = document.getElementById('theme-toggle');
        const html = document.documentElement;
        
        themeToggle?.addEventListener('click', function() {
            const currentTheme = html.classList.contains('dark') ? 'dark' : 'light';
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            
            html.classList.remove('dark', 'light');
            html.classList.add(newTheme);
            
            document.cookie = `theme=${newTheme}; path=/; max-age=31536000`;
        });
        
        // Language Toggle
        function toggleLanguage() {
            const currentLang = '{{ app()->getLocale() }}';
            const newLang = currentLang === 'id' ? 'en' : 'id';
            window.location.href = `/locale/${newLang}`;
        }
    </script>
</body>
</html>
