import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/scss/app.scss'],
      refresh: true
    })
  ],
  build: {
    rollupOptions: {
      output: {
        assetFileNames: (assetInfo) => {
          return assetInfo.name
        }
      }
    }
  }
})
