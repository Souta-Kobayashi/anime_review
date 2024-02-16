import { splitVendorChunkPlugin, defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import vuetify from 'vite-plugin-vuetify';
import { visualizer } from 'rollup-plugin-visualizer';
import purgecss from '@fullhuman/postcss-purgecss';

export default defineConfig({
  build: {
    rollupOptions: {
      sourcemap: true,
      output: {
        entryFileNames: `assets/[name].js`,
        chunkFileNames: `assets/[name].js`,
        assetFileNames: `assets/[name].[ext]`,
      },
    },
  },
  css: {
    postcss: {
      plugins: [
        purgecss({
          content: ['./public/build/assets/*.js'],
          safelist: [
            /-(leave|enter|appear)(|-(to|from|active))$/,
            /^(?!(|.*?:)cursor-move).+-move$/,
            /^router-link(|-exact)-active$/,
            /data-v-.*/,
            /v-.*/,
            /text-.*/,
            /bg-.*/,
            /rounded-circle/,
          ],
        }),
      ],
    },
  },
  plugins: [
    vue(),
    vuetify({
      styles: {
        configFile:
          './resources/sass/vuetify_settings.scss',
      },
    }),
    laravel({
      input: [
        'resources/css/app.css',
        'resources/sass/app.scss',
        'resources/js/app.js',
      ],
      refresh: true,
    }),
    splitVendorChunkPlugin(),
    visualizer(),
  ],
});
