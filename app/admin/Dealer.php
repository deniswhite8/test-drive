<?php

/**
 * Create grid for dealers
 */

Admin::model(\App\Models\Dealer::class)
    ->title('Dealers')
    ->columns(function() {
        Column::string('id', 'Id');
        Column::string('name', 'Name');
        Column::date('created_at');
    })
    ->form(function() {
        FormItem::text('name', 'Name *')->required(true);
        FormItem::textarea('description', 'Description');
    });