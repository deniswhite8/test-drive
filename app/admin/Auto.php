<?php

/**
 * Create grid for autos
 */

Admin::model(\App\Models\Auto::class)
    ->title('Autos')
    ->async()
    ->disableWithJoin()
    ->with(['mark', 'model', 'generation', 'bodyType', 'gearboxType'])
    ->columns(function() {
        Column::string('id', 'Id');
        Column::string('mark.name', 'Mark');
        Column::string('model.name', 'Model');
        Column::string('generation.name', 'Generation');
        Column::string('bodyType.name', 'Body');
        Column::string('gearboxType.name', 'Gearbox');
        Column::date('created_at');
    })
    ->form(function() {
        FormItem::text('mark_id', 'Mark Id *')->required(true)->validationRule('integer');
        FormItem::text('model_id', 'Model Id *')->required(true)->validationRule('integer');
        FormItem::text('generation_id', 'Generation Id')->validationRule('integer');

        FormItem::select('body_type_id', 'Body Type *')->required(true)
            ->list(\App\Models\Auto\BodyType::class);
        FormItem::select('gearbox_type_id', 'Gearbox Type *')->required(true)
            ->list(\App\Models\Auto\GearboxType::class);

        FormItem::text('mileage', 'Mileage')->validationRule('integer');
        FormItem::textarea('description', 'Description');
    });