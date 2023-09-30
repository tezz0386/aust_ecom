import { defineConfig } from "vite";
import vue from '@vitejs/plugin-vue';
import laravel from "laravel-vite-plugin";
import path from "path";




export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/views/frontend/sass/app.scss",
                "resources/views/frontend/js/app.js"
            ],
            buildDirectory: "frontend",
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        {
            name: "blade",
            handleHotUpdate({ file, server }) {
                if (file.endsWith(".blade.php")) {
                    server.ws.send({
                        type: "full-reload",
                        path: "*",
                    });
                }
            },
        },
    ],
    resolve: {
        alias: {
            '@': 'admin/js',
            '~bootstrap': path.resolve('node_modules/bootstrap'),
        }
    },
    build: {
        chunkSizeWarningLimit: 1000 * 1024, // 1 MB
    },

});
