const mix = require('laravel-mix');

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

mix.copy('node_modules/bootstrap/dist/css/bootstrap.min.css', 'public/css')
    .copy('node_modules/owl.carousel/dist/assets/owl.carousel.min.css', 'public/css')
    .copy('node_modules/owl.carousel/dist/assets/owl.theme.default.min.css', 'public/css')
    .copy('node_modules/summernote/dist/summernote-bs4.css', 'public/css')
    .copy('node_modules/jqvmap/dist/jqvmap.min.css', 'public/css')
    .copy('node_modules/bootstrap/dist/js/bootstrap.min.js', 'public/js')
    .copy('node_modules/jquery-sparkline/jquery.sparkline.min.js', 'public/js')
    .copy('node_modules/chart.js/dist/Chart.min.js', 'public/js')
    .copy('node_modules/owl.carousel/dist/owl.carousel.min.js', 'public/js')
    .copy('node_modules/summernote/dist/summernote-bs4.js', 'public/js')
    .copy('node_modules/chocolat/dist/js/jquery.chocolat.min.js', 'public/js')
    .copy('node_modules/jqvmap/dist/jquery.vmap.min.js', 'public/js')

mix.copy('node_modules/summernote/dist/font/summernote.ttf', 'public/css/font')
  .copy('node_modules/summernote/dist/font/summernote.woff', 'public/css/font')
