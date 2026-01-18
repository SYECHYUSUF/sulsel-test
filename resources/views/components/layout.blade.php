<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPID Provinsi Sulawesi Selatan</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
    class="antialiased bg-background text-foreground transition-all duration-300"
>

    <main>
        {{ $slot }}
    </main>


    <x-accessibility-menu />
    <x-floating-whatsapp />

</body>
</html>