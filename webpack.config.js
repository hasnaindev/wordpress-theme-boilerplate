const path = require('path');
const MiniExtractCssPlugin = require('mini-css-extract-plugin');

module.exports = ({ mode }) => ({
  entry: './src/index.js',

  output: {
    path: path.resolve('assets', 'scripts'),
    filename: 'main.js',
  },

  module: {
    rules: [
      { test: /.js$/, exclude: /(node_modules)/, loader: 'babel-loader' },
      {
        test: /.s?css$/,
        use: [MiniExtractCssPlugin.loader, 'css-loader', 'sass-loader'],
      },
    ],
  },

  plugins: [
    new MiniExtractCssPlugin({
      filename: '../styles/style.css',
    }),
  ],

  mode,
});
