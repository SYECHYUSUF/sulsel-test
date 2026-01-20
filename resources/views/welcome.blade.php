<x-layout>
    <x-header />
    
    <main class="space-y-0"> {{-- Gap antar section besar menggunakan Golden Ratio --}}
        <x-hero />
        
        <div class="container mx-auto">
            <x-service-cards />
        </div>
        
        <x-narasi-tunggal-slider />
        
        <x-process-timeline />
        <x-download-center />
        
        <x-aid-banner />
        <x-news-section />
        
        <x-leadership />
        <x-legal-banner />
        <x-faq />
        
    </main>

    <x-footer />
</x-layout>