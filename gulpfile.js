var elixir = require('laravel-elixir');

elixir(function(mix) {
    mix
        .less(['app.less'], null, {
            paths: __dirname + '/node_modules/'
        })
        .browserify('app.js')
        .version(['css/app.css', 'js/bundle.js'])
        .copy('node_modules/bootstrap/dist/fonts/**', elixir.config.publicDir + '/fonts')
    ;
});