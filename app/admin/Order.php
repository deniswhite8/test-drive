<?php

/**
 * Create grid for autos
 */

Admin::model(\App\Models\Order::class)
    ->title('Orders')
    ->async()
    ->disableWithJoin()
    ->with(['mark', 'model', 'generation', 'salon'])
    ->columns(function() {
        Column::string('id', 'Id');
        Column::string('mark.name', 'Mark');
        Column::string('model.name', 'Model');
        Column::string('generation.name', 'Generation');
        Column::string('salon.name', 'Salon');
        Column::string('contacts');
        Column::date('datetime')->format('medium', 'short');
        Column::string('comment');
        Column::date('created_at');
    })
    ->form(function() {
        FormItem::table()->setName('mark_id')->setLabel('Mark *')->setAlias('marks');
        FormItem::table()->setName('model_id')->setLabel('Model *')->setAlias('models');
        FormItem::table()->setName('generation_id')->setLabel('Generation Id')->setAlias('generations');
        FormItem::table()->setName('salon_id')->setLabel('Salon *')->setAlias('salons');

        FormItem::text('contacts', 'Contacts (telephone or email) *')->required(true);
        FormItem::timestamp('datetime', 'Date and Time *')->required(true);
        FormItem::textarea('comment', 'Comment');
    });