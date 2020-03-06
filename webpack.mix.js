const path = require('path')
const fs = require('fs-extra')
const mix = require('laravel-mix')
require('laravel-mix-versionhash')
// const { BundleAnalyzerPlugin } = require('webpack-bundle-analyzer')

mix
  // .js('resources/js/frontend.js', 'public/dist/js')
  // .sass('resources/sass/frontend.scss', 'public/dist/css')
  .js([
    'node_modules/jquery/dist/jquery.min.js',
    'node_modules/semantic-ui-sass/semantic-ui.js',
    'node_modules/semantic-ui-vue/dist/umd/semantic-ui-vue.min.js',
    'resources/js/frontend.js'
  ], 'public/dist/js/frontend.js')
  .autoload({
    jquery: ['$', 'window.jQuery', 'jQuery']
  })

  .sass('resources/sass/frontend.scss', 'public/dist/css/')
  .copy('node_modules/semantic-ui-css/semantic.min.css', 'public/dist/css/')
  .copy('node_modules/semantic-ui-css/themes', 'public/dist/css/themes')

  .disableNotifications()

if (mix.inProduction()) {
  mix
    // .extract() // Disabled until resolved: https://github.com/JeffreyWay/laravel-mix/issues/1889
    // .version() // Use `laravel-mix-versionhash` for the generating correct Laravel Mix manifest file.
    .versionHash()
} else {
  mix.sourceMaps()
}

mix.webpackConfig({
  plugins: [
    // new BundleAnalyzerPlugin()
  ],
  resolve: {
    extensions: ['.js', '.json', '.vue'],
    alias: {
      '~': path.join(__dirname, './resources/js')
    }
  },
  output: {
    chunkFilename: 'dist/js/[chunkhash].js',
    path: mix.config.hmr ? '/' : path.resolve(__dirname, './public')
  }
})

mix.then(() => {
  if (!mix.config.hmr) {
    process.nextTick(() => publishAseets())
  }
})

function publishAseets () {
  const publicDir = path.resolve(__dirname, './public')

  if (mix.inProduction()) {
    fs.removeSync(path.join(publicDir, 'dist'))
  }

  // fs.copySync(path.join(publicDir, 'dist'), path.join(publicDir, 'dist'))
  // fs.removeSync(path.join(publicDir))
}
