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
    }, false)
    ->form(function() {
        FormItem::table()->setName('mark_id')->setLabel('Mark Id *')->setAlias('marks');
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
        FormItem::table()->setName('model_id')->setLabel('Model Id *')->setAlias('models');
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