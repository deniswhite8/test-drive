<?php

AssetManager::addStyle(elixir('css/admin.css'));
AssetManager::addScript('//api-maps.yandex.ru/2.1/?lang=ru_RU');
AssetManager::addScript(elixir('js/admin.js'));

FormItem::register('map', \App\Models\Admin\Form\Element\Map::class);
FormItem::register('table', \App\Models\Admin\Form\Element\Table::class);