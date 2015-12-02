<?php

/**
 * Create grids for auto attributes
 */

Admin::model(\App\Models\Auto\Mark::class)
    ->title('Auto Marks')
    ->columns(function() {
        Column::string('id', 'Id');
        Column::string('name', 'Name');
    })
    ->form(function() {
        FormItem::text('name', 'Name *')->required(true);
    });

Admin::model(\App\Models\Auto\Model::class)
    ->title('Auto Models')
    ->async()
    ->disableWithJoin()
    ->with('mark')
    ->columns(function() {
        Column::string('id', 'Id');
        Column::string('name', 'Name');
        Column::string('mark.name', 'Mark');
    })
    ->form(function() {
        FormItem::text('mark_id', 'Mark Id *')->required(true)->validationRule('integer');
        FormItem::text('name', 'Name *')->required(true);
    });

Admin::model(\App\Models\Auto\Generation::class)
    ->title('Auto Generations')
    ->async()
    ->disableWithJoin()
    ->with('model')
    ->columns(function() {
        Column::string('id', 'Id');
        Column::string('name', 'Name');
        Column::string('model.name', 'Model');
    })
    ->form(function() {
        FormItem::text('model_id', 'Model Id *')->required(true)->validationRule('integer');
        FormItem::text('name', 'Name *')->required(true);
    });

Admin::model(\App\Models\Auto\BodyType::class)
    ->title('Auto Body Types')
    ->columns(function() {
        Column::string('id', 'Id');
        Column::string('name', 'Name');
    })
    ->form(function() {
        FormItem::text('name', 'Name *')->required(true);
    });

Admin::model(\App\Models\Auto\GearboxType::class)
    ->title('Auto Gearbox Types')
    ->columns(function() {
        Column::string('id', 'Id');
        Column::string('name', 'Name');
    })
    ->form(function() {
        FormItem::text('name', 'Name *')->required(true);
    });