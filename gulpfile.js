var elixir = require('laravel-elixir');

elixir(function(mix) {
    //build client app
    mix
        .less(['app.less'], null, {
            paths: __dirname + '/node_modules/'
        })
        .browserify('app.js')
        .copy('node_modules/bootstrap/dist/fonts/**', elixir.config.publicDir + '/build/fonts')
    ;

    // build admin over sleeping owl
    mix
        .less(['admin.less'], elixir.config.cssOutput + '/admin.css', {
            paths: __dirname + '/node_modules/'
        })
    ;

    mix.version(['css/app.css', 'js/bundle.js', 'css/admin.css'])
});