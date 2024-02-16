import { splitVendorChunkPlugin, defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import vuetify from 'vite-plugin-vuetify';
import { visualizer } from 'rollup-plugin-visualizer';
import viteCompression from 'vite-plugin-compression';

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
    viteCompression(),
  ],
});
