const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');

// Set the development mode based on the environment
const isProduction = process.env.NODE_ENV === 'production';

module.exports = {
  mode: isProduction ? 'production' : 'development',
  entry: {
    main: './src/js/main.js',
  },
  output: {
    filename: 'js/[name].js',
    path: path.resolve(__dirname, 'dist'),
  },
  devtool: isProduction ? false : 'source-map',
  module: {
    rules: [
      // JavaScript
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['@babel/preset-env'],
          },
        },
      },
      // CSS
      {
        test: /\.css$/,
        use: [
          MiniCssExtractPlugin.loader,
          {
            loader: 'css-loader',
            options: {
              importLoaders: 1,
              sourceMap: !isProduction,
            },
          },
          'postcss-loader',
        ],
      },
    ],
  },
  plugins: [
    new CleanWebpackPlugin(),
    new MiniCssExtractPlugin({
      filename: 'css/[name].css',
    }),
    // Uncomment and customize this if you want to use BrowserSync
    
    new BrowserSyncPlugin({
      host: 'localhost',
      port: 3000,
      proxy: 'https://wp-dev.test',
      files: [
        '**/*.php',
        'dist/js/**/*.js',
        'dist/css/**/*.css',
      ],
      notify: false,
    }),
  ],
};