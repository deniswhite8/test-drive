<?php

/**
 * Create grid for salons
 */

Admin::model(\App\Models\Salon::class)
    ->title('Salons')
    ->async()
    ->disableWithJoin()
    ->with(['dealer'])
    ->columns(function() {
        Column::string('id', 'Id');
        Column::string('name', 'Name');
        Column::string('dealer.name', 'Dealer');
        Column::string('city', 'City');
        Column::string('address', 'Address');
        Column::date('created_at');
    })
    ->form(function() {
        FormItem::text('name', 'Name *')->required(true);
        FormItem::text('city', 'City *')->required(true);
        FormItem::text('address', 'Address *')->required(true);
        FormItem::text('phone', 'Phone');
        FormItem::textarea('work_time', 'Work Time');
        FormItem::textarea('description', 'Description');
        FormItem::map()->setLabel('Coordinates')->setAttributes('latitude', 'longitude')->required(true);
    });