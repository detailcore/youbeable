const CompressionPlugin = require('compression-webpack-plugin')
const isServer = process.argv.includes('--server')
// const path = require('path')

let platformChainWebpack = isServer ? 
  config => {
    config.plugins.delete('html')
    config.plugins.delete('preload')
    config.plugins.delete('prefetch')
  } :
  config => {
    config.plugin('html').tap(options => {
      options[0].minify = false
      return options
    })
  }

let configureWebpack = isServer ? 
  {
    target: 'node',
    entry: { app: './src/entry-server.js' },
    output: {
      filename: './js/server-bundle.js', 
      libraryExport: 'default', 
      libraryTarget: 'commonjs2',
      // chunkFilename:'./js/[chunkhash].js',
      // chunkFilename:'./js/[id].[chunkhash].js',
      // path: path.resolve(__dirname, '../public/js')
    },
    optimization: { splitChunks: false },
  } :
  {
    entry: { app: './src/entry-client.js' }
  }


module.exports = {
  filenameHashing: false,
  // отключить Линт в продакшен сборке
  lintOnSave: process.env.NODE_ENV !== 'production',
  productionSourceMap: false,
  // local Laravel server address for api proxy
  devServer: { proxy: 'http://localhost:8000' },

  // outputDir should be Laravel public dir
  outputDir: '../public/',
  publicPath: '/',

  // for production we use "blade" template file
  indexPath: process.env.NODE_ENV === 'production'
      ? '../resources/views/app.blade.php'
      : 'index.html',
  css: {
    loaderOptions: {
      scss: {
        additionalData: `@import "@/style/_init.scss";`,
      },
    }
  },

  configureWebpack: {
    optimization: {
      splitChunks: {
        chunks: 'all',
        minSize: 100000,
        maxSize: 250000,
      }
    }
  },

  configureWebpack,

	chainWebpack: config => {
		config.plugin('define').tap(options => {
			options[0]['process.isClient'] = !isServer;
			options[0]['process.isServer'] = isServer;
			return options;
		});

    config.plugins.delete('prefetch')

    config.plugin('CompressionPlugin').use(CompressionPlugin)

    config.performance
      .maxEntrypointSize(250000)
      .maxAssetSize(250000)

		platformChainWebpack(config);
	}
}