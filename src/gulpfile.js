const elixir = require('laravel-elixir');

require('laravel-elixir-vue');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(mix => {
    const __root = __dirname + '/../../../../public';

    mix.sass('stellar.scss').copy('public/css/stellar.css', __root + '/css/stellar.css');
    mix.rollup('stellar.js').copy('public/js/stellar.js', __root + '/js/stellar.js');
});
