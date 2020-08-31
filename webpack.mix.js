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
    // 'node_modules/semantic-ui-sass/semantic-ui.js',
    'public/dist/frontend/semantic/semantic.js',
    'node_modules/semantic-ui-vue/dist/umd/semantic-ui-vue.min.js',
    'resources/js/main.js'
  ], 'public/dist/frontend/js/frontend.js')
  .autoload({
    jquery: ['$', 'window.jQuery', 'jQuery']
  })

  .sass('resources/sass/frontend.scss', 'public/dist/frontend/css/')
  // .copy('node_modules/semantic-ui-css/semantic.min.css', 'public/dist/frontend/css/')
  // .copy('public/dist/frontend/semantic/semantic.css', 'public/dist/frontend/css/')
  // .copy('node_modules/semantic-ui-css/themes', 'public/dist/frontend/css/themes')

  .disableNotifications()

// LIVE
if (mix.inProduction()) {
  mix
    // .extract() // Disabled until resolved: https://github.com/JeffreyWay/laravel-mix/issues/1889
    // .version() // Use `laravel-mix-versionhash` for the generating correct Laravel Mix manifest file.
    .versionHash()
    .styles(
      [
        'public/dist/frontend/css/semantic.min.css',
        'public/dist/frontend/css/frontend.css'
      ],
      'public/dist/frontend/css/all.min.css'
    )
    // .combine(
    //   [
    //     'public/dist/frontend/js/frontend.js',
    //   ],
    //   'public/dist/frontend/js/all.min.js'
    // )
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
    chunkFilename: 'dist/frontend/js/[chunkhash].js',
    path: mix.config.hmr ? '/' : path.resolve(__dirname, './public')
  },
  module: {
    rules: [
      {
        test: /\.pug$/,
        oneOf: [
          {
            resourceQuery: /^\?vue/,
            use: ['pug-plain-loader']
          },
          {
            use: ['raw-loader', 'pug-plain-loader']
          }
        ]
      }
    ]
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
    // fs.removeSync(path.join(publicDir, 'dist'))
  }

  // fs.copySync(path.join(publicDir, 'dist'), path.join(publicDir, 'dist'))
  // fs.removeSync(path.join(publicDir))
}
