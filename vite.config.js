import { splitVendorChunkPlugin, defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";
import vuetify from "vite-plugin-vuetify";
import { visualizer } from "rollup-plugin-visualizer";
import viteCompression from "vite-plugin-compression";
// import { fileURLToPath, URL } from 'node:url';

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
          "./resources/sass/vuetify_settings.scss",
      },
    }),
    laravel({
      input: [
        "resources/css/app.css",
        "resources/sass/app.scss",
        "resources/js/app.js",
        // 'resources/js/app.ts',
      ],
      refresh: true,
    }),
    splitVendorChunkPlugin(),
    visualizer(),
    viteCompression(),
  ],
});

//vitejs.dev/config/
// export default defineConfig({
//   plugins: [
//     vue(),
//     vuetify({
//       styles: {
//         configFile:
//           './resources/sass/vuetify_settings.scss',
//       },
//     }),
//     laravel({
//       input: [
//         'resources/css/app.css',
//         'resources/sass/app.scss',
//         'resources/js/app.ts',
//       ],
//       refresh: true,
//     }),
//   ],
//   resolve: {
//     alias: {
//       '@': fileURLToPath(
//         new URL('./resources/js', import.meta.url)
//       ),
//     },
//   },
// });
