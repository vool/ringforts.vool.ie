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

mix.setPublicPath('public');

mix.copyDirectory('./node_modules/leaflet/dist/images', 'public/img/leaflet');
mix.copyDirectory('resources/images', 'public/img');

mix.sass('resources/sass/frontend/app.scss', 'css/frontend.css')
    .sass('resources/sass/backend/app.scss', 'css/backend.css')
    .js([
        './node_modules/leaflet/dist/leaflet.js',
        './node_modules/leaflet.featuregroup.subgroup/dist/leaflet.featuregroup.subgroup.js',
        './node_modules/leaflet.markercluster/dist/leaflet.markercluster.js',
        './node_modules/leaflet.heat/dist/leaflet-heat.js',
        './node_modules/sidebar-v2/js/leaflet-sidebar.min.js',
        './node_modules/leaflet-bing-layer/leaflet-bing-layer.js',
        'resources/js/frontend/app.js'
        ], 'js/frontend.js')
    .js([
        './node_modules/leaflet/dist/leaflet.js',
        'resources/js/backend/before.js',
        'resources/js/backend/app.js',
        'resources/js/backend/after.js'
    ], 'js/backend.js')
    .extract([
        'jquery',
        'bootstrap',
        'popper.js/dist/umd/popper',
        'axios',
        'sweetalert2',
        'lodash',
        '@fortawesome/fontawesome-svg-core',
        '@fortawesome/free-brands-svg-icons',
        '@fortawesome/free-regular-svg-icons',
        '@fortawesome/free-solid-svg-icons'
    ]);

if (mix.inProduction() || process.env.npm_lifecycle_event !== 'hot') {
    mix.version();
}
