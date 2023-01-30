// compile with "npx mix" or "npx mix watch"

let mix = require('laravel-mix');

let assetsPath = "themes/test/assets/";
let publicPath = "themes/test/assets/compiled/";

mix.js([assetsPath+'js/app.js',assetsPath+'js/jquery.js'], 'js')
   .sass(assetsPath+'sass/style.scss', 'css')
   .setPublicPath(publicPath)
   .browserSync('http://127.0.0.1:8000');