<?php

/**
 * Create grid for salons
 */

Admin::model(\App\Models\Salon::class)
    ->title('Salons')
    ->async()
    ->disableWithJoin()
    ->with(['dealer', 'city'])
    ->columns(function() {
        Column::string('id', 'Id');
        Column::string('name', 'Name');
        Column::string('dealer.name', 'Dealer');
        Column::string('city.name', 'City');
        Column::string('address', 'Address');
        Column::date('created_at');
    })
    ->form(function() {
        FormItem::table()->setName('dealer_id')->setLabel('Dealer *')->setAlias('dealers');
        FormItem::text('name', 'Name *')->required(true);
        FormItem::table()->setName('city_id')->setLabel('City *')->setAlias('cities');
        FormItem::text('address', 'Address *')->required(true);
        FormItem::text('phone', 'Phone');
        FormItem::textarea('work_time', 'Work Time');
        FormItem::ckeditor('description', 'Description');
        FormItem::map()->setLabel('Coordinates')->setAttributes('latitude', 'longitude');
        FormItem::table()->setName('autos')->setLabel('Autos')->setAlias('autos');
        FormItem::image('image', 'Image');
    });