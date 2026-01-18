import './bootstrap';
import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';

// Daftarkan plugin collapse
Alpine.plugin(collapse);

window.Alpine = Alpine;
Alpine.start();