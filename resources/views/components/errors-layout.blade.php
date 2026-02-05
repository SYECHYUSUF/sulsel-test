<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ request()->cookie('theme', 'light') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }} - Pyield('title')PID Sulawesi Selatan</title>
    
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
    
    <!-- Main Content -->
    <main class="min-h-screen relative gradient-bg">
        <!-- Floating Blob Backgrounds -->
        <div class="liquid-blob" style="width: 300px; height: 300px; top: 10%; left: 10%;"></div>
        <div class="liquid-blob" style="width: 400px; height: 400px; top: 50%; right: 5%; animation-delay: 1s;"></div>
        <div class="liquid-blob" style="width: 250px; height: 250px; bottom: 10%; left: 40%; animation-delay: 2s;"></div>
        
        {{ $slot }}
    </main>
    
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
