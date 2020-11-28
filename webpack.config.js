const path = require('path');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');

module.exports = ({ mode }) => {
  const isProduction = mode === 'production';

  const entry = './src/scripts/index.js';

  const output = {
    path: path.resolve('assets', 'scripts'),
    filename: '[name].js',
    publicPath: 'wp-content'
      .concat(
        path
          .join(__dirname, 'assets', 'scripts', '/')
          .split('wp-content')
          .pop()
      ),
  };

  const devtool = isProduction
    ? 'source-map'
    : 'inline-source-map';

  const module = {
    rules: [
      { test: /.js$/, exclude: /(node_modules)/, loader: 'babel-loader' },
    ],
  };

  const plugins = [
    new CleanWebpackPlugin(),
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
  ];

  const optimization = {
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
  };

  return {
    entry,
    output,
    devtool,
    module,
    plugins,
    optimization,
  };
};
