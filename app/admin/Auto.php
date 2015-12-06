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
        FormItem::table()->setName('mark_id')->setLabel('Mark *')->setAlias('marks');
        FormItem::table()->setName('model_id')->setLabel('Model *')->setAlias('models');
        FormItem::table()->setName('generation_id')->setLabel('Generation Id')->setAlias('generations');

        FormItem::select('body_type_id', 'Body Type *')->required(true)
            ->list(\App\Models\Auto\BodyType::class);
        FormItem::select('gearbox_type_id', 'Gearbox Type *')->required(true)
            ->list(\App\Models\Auto\GearboxType::class);

        FormItem::text('mileage', 'Mileage')->validationRule('integer');
        FormItem::ckeditor('description', 'Description');
        FormItem::image('image', 'Image');
    });