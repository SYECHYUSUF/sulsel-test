<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Admin PPID Sulsel' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/sidebar.css'])
    <style>
        [x-cloak] { display: none !important; }
    </style>
    <script>
        // Prevent FOUC by setting sidebar state immediately
        (function() {
            const sidebarOpen = localStorage.getItem('sidebarOpen') === null ? true : localStorage.getItem('sidebarOpen') === 'true';
            document.documentElement.classList.toggle('sidebar-closed', !sidebarOpen);
        })();
    </script>

    @isset($extra_head)
        {{ $extra_head }}
    @endisset
</head>
<body class="bg-slate-50 font-sans antialiased text-foreground dark:bg-slate-900"
    x-data="{ 
        darkMode: localStorage.getItem('darkMode') === 'true',
        toggleDarkMode() {
            this.darkMode = !this.darkMode;
            localStorage.setItem('darkMode', this.darkMode);
            if (this.darkMode) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        },
        init() {
            if (this.darkMode) {
                document.documentElement.classList.add('dark');
            }
        }
    }"
    x-init="init()"
>
    <div 
        class="flex h-screen overflow-hidden" 
        x-data="{ 
            sidebarOpen: localStorage.getItem('sidebarOpen') === null ? true : localStorage.getItem('sidebarOpen') === 'true',
            toggleSidebar() {
                const newState = !this.sidebarOpen;
                
                const update = () => {
                    this.sidebarOpen = newState;
                    document.documentElement.classList.toggle('sidebar-closed', !newState);
                    localStorage.setItem('sidebarOpen', newState);
                };

                if (document.startViewTransition) {
                    document.startViewTransition(update);
                } else {
                    update();
                }
            },
            init() {
                // Sync initial state if needed, but script handled it.
                // Just watch for future changes if manipulated outside
                this.$watch('sidebarOpen', val => {
                    document.documentElement.classList.toggle('sidebar-closed', !val);
                    localStorage.setItem('sidebarOpen', val);
                });
            }
        }"
    >
        <!-- Mobile Backdrop -->
        <div x-show="sidebarOpen" 
             @click="toggleSidebar()" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-black/50 z-20 md:hidden glass"
             style="display: none;"></div>

        <!-- Sidebar -->
        <x-admin-sidebar />

        <!-- Main Content Wrapper -->
        <div class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden transition-all duration-300">
            <!-- Header -->
            <x-admin-header />

            <!-- Main Content -->
            <main class="w-full grow p-6 lg:p-8 lg:pt-4">
                <div class="w-full mx-auto max-w-7xl">
                    {{ $slot }}
                </div>
            </main>

            <!-- Footer -->
            <footer class="w-full p-6 text-center text-sm text-slate-500 dark:text-slate-400">
                &copy; {{ date('Y') }} PPID Provinsi Sulawesi Selatan. All rights reserved.
            </footer>
        </div>
    </div>

    @isset($extra_script)
        {{ $extra_script }}
    @endisset
</body>
</html>
