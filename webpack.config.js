const path = require('path');
const MiniExtractCssPlugin = require('mini-css-extract-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');

module.exports = ({ mode }) => ({
  entry: './src/scripts/index.js',

  output: {
    path: path.resolve('assets', 'scripts'),
    filename: '[name].js',
    chunkFilename: '[id].js',
    publicPath: 'wp-content'
      .concat(
        path
          .join(__dirname, 'assets', 'scripts', '/')
          .split('wp-content')
          .pop()
      ),
  },

  devtool: mode === 'production'
    ? 'source-map'
    : 'inline-source-map',

  module: {
    rules: [
      { test: /.js$/, exclude: /(node_modules)/, loader: 'babel-loader' },
    ],
  },

  plugins: [
    new MiniExtractCssPlugin({
      filename: '../styles/[name].css',
    }),
    new BrowserSyncPlugin({
      host: 'localhost',
      proxy: 'http://boilerplate.test/',
      port: 3000,
      injectChanges: true,
      notify: true,
      files: [
        {
          match: ['**/*.php', 'assets/scripts/*.js', 'assets/styles/*.css'],
          fn(event, file) {
            event === 'change'
            && file.split('.').pop() === 'css'
              ? this.reload('*.css')
              : this.reload();
          },
        },
      ],
    }, {
      reload: false,
    }),
  ],
  
  optimization: {
    runtimeChunk: 'single',
    splitChunks: {
      cacheGroups: {
        vendor: {
          test: /[\\/]node_modules[\\/]/,
          name: 'vendors',
          chunks: 'all',
        },
      },
    },
  },

  mode,
});
