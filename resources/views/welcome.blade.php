<x-layout>
    <x-header />
    
    <main class="space-y-0"> {{-- Gap antar section besar menggunakan Golden Ratio --}}
        <x-hero />
        
        <div class="container mx-auto">
            <x-service-cards />
        </div>

        <x-process-timeline />
        <x-download-center />
        
        <x-news-section />
        
        <x-leadership />
        <x-faq />
        <x-legal-banner />
        
    </main>

    <x-footer />
</x-layout>