const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js');

mix.sass('resources/sass/app.scss', 'public/css');
mix.sass('resources/sass/dashboard.scss', 'public/css');
