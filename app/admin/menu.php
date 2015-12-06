<?php

/*
 * Describe your menu here.
 *
 * There is some simple examples what you can use:
 *
 * 		Admin::menu()->url('/')->label('Start page')->icon('fa-dashboard')->uses('\AdminController@getIndex');
 * 		Admin::menu(User::class)->icon('fa-user');
 * 		Admin::menu()->label('Menu with subitems')->icon('fa-book')->items(function ()
 * 		{
 * 			Admin::menu(\Foo\Bar::class)->icon('fa-sitemap');
 * 			Admin::menu('\Foo\Baz')->label('Overwrite model title');
 * 			Admin::menu()->url('my-page')->label('My custom page')->uses('\MyController@getMyPage');
 * 		});
 */

Admin::menu()->url('/')->label('Start page')->icon('fa-dashboard')
    ->uses('App\Http\Controllers\Admin\DashboardController@index');

Admin::menu(\App\Models\Salon::class)->label('Salons')->icon('fa-map-marker');
Admin::menu(\App\Models\Auto::class)->label('Autos')->icon('fa-car');
Admin::menu(\App\Models\Dealer::class)->label('Dealers')->icon('fa-building');
Admin::menu(\App\Models\City::class)->label('Cities')->icon('fa-university');

Admin::menu()->label('Auto attributes')->icon('fa-list')->items(function() {
    Admin::menu(\App\Models\Auto\Mark::class)->label('Marks')->icon('fa-dot-circle-o');
    Admin::menu(\App\Models\Auto\Model::class)->label('Models')->icon('fa-dot-circle-o');
    Admin::menu(\App\Models\Auto\Generation::class)->label('Generations')->icon('fa-dot-circle-o');
    Admin::menu(\App\Models\Auto\BodyType::class)->label('Body types')->icon('fa-dot-circle-o');
    Admin::menu(\App\Models\Auto\GearboxType::class)->label('Gearbox types')->icon('fa-dot-circle-o');
});