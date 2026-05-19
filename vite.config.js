import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'; // <-- 1. Importe o plugin do Vue aqui

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss', // O laravel/ui mudou css para sass
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        vue({  // <-- 2. Adicione a configuração do Vue aqui
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js', // <-- 3. Ajuda o Vue a renderizar no navegador
        },
    },
});