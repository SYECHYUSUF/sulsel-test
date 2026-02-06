import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    server: {
        host: "192.168.91.89", // Sesuaikan dengan IP yang Anda gunakan di PHP server
        hmr: {
            host: "192.168.91.89",
        },
    },
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/css/sidebar.css",
                "resources/js/app.js",
            ],
            refresh: true,
        }),
    ],
});
