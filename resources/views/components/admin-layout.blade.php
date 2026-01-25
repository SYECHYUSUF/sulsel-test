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
    
    @vite(['resources/css/app.css', 'resources/css/sidebar.css', 'resources/js/app.js'])

    @isset($extra_head)
        {{ $extra_head }}
    @endisset
</head>
<body class="bg-slate-50 font-sans antialiased text-slate-800">
    <div 
        class="flex h-screen overflow-hidden" 
        x-data="{ sidebarOpen: true }"
    >
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
            <footer class="w-full p-6 text-center text-sm text-slate-500">
                &copy; {{ date('Y') }} PPID Provinsi Sulawesi Selatan. All rights reserved.
            </footer>
        </div>
    </div>

    @isset($extra_script)
        {{ $extra_script }}
    @endisset
</body>
</html>
