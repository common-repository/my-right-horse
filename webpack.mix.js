let mix = require('laravel-mix');
const CleanWebpackPlugin = require('clean-webpack-plugin');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.webpackConfig({
  plugins: [ new CleanWebpackPlugin([ 'dist' ], { verbose: false }) ],
});

mix
  .js('assets/js/app.js', 'dist/scripts/mrh-app.js')
  .copy('assets/images', 'dist/images')
  .sass('assets/scss/cs-framework.scss', 'dist/styles/cs-framework.css')
  .sass('assets/scss/mrh-app.scss', 'dist/styles/mrh-app.css')
  .options({
    processCssUrls: false,
  })
  .browserSync({
    proxy: 'https://wordpress-sandbox.test',
    files: [ 'dist/styles/{*,**/*}.css', 'dist/scripts/{*,**/*}.js' ],
  });
