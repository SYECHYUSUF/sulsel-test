<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PPID Provinsi Sulawesi Selatan</title>
    
    {{-- 1. FONTS --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    {{-- 2. AOS CSS --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    {{-- 3. VITE (Tailwind & JS) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Tambahkan transisi halus agar saat fitur aksesibilitas diubah tidak patah-patah */
        .transition-all-custom {
            transition: all 0.3s ease-in-out;
        }
    </style>
</head>
<body 
    x-data="{ 
        fontSize: localStorage.getItem('acc-font-size') || 16,
        isContrast: localStorage.getItem('acc-contrast') === 'true',
        isMono: localStorage.getItem('acc-mono') === 'true',
        isDyslexic: localStorage.getItem('acc-dys') === 'true',
        isBold: localStorage.getItem('acc-bold') === 'true',
        isHighlightLinks: localStorage.getItem('acc-links') === 'true',
        isHighlightTitles: localStorage.getItem('acc-titles') === 'true'
    }"
    :class="{ 
        'high-contrast': isContrast,
        'monochrome': isMono,
        'dyslexic-font': isDyslexic,
        'bold-text': isBold,
        'highlight-links': isHighlightLinks,
        'highlight-titles': isHighlightTitles
    }"
    :style="'font-size: ' + fontSize + 'px'"
    class="antialiased bg-background text-foreground transition-all-custom"
>


    <main class="{{ request()->is('/') ? '' : 'pt-36 lg:pt-48' }}">
        {{-- Konten Utama yang akan diisi oleh @section atau {{ $slot }} --}}
        {{ $slot }}
    </main>


    {{-- Komponen Tambahan --}}
    <x-accessibility-menu />

    {{-- 4. AOS JS & INISIALISASI --}}
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Inisialisasi AOS saat dokumen siap
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 1000,    // Durasi animasi (1 detik)
                once: true,        // Animasi hanya berjalan sekali
                easing: 'ease-in-out', // Efek transisi
                anchorPlacement: 'top-bottom', // Kapan animasi dipicu
            });
        });
    </script>

</body>
</html>