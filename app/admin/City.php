<?php

/**
 * Create grid for cities
 */

Admin::model(\App\Models\City::class)
    ->title('Cities')
    ->columns(function() {
        Column::string('id', 'Id');
        Column::string('name', 'Name');
    })
    ->form(function() {
        FormItem::text('name', 'Name *')->required(true);
    });