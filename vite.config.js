import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
  plugins: [
    laravel({
      manifest: true, // Menyertakan manifest.json
      input: 'resources/js/app.js',
      output: 'public/build',
    }),
  ],
});
