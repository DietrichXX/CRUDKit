<?php

return [
    // Пути указываются относительно базовой директории Laravel (например, для модели, контроллера и т.д.)
    // Не должны заканчиваться символом "/"
    'base_path' => [
        'controller_base_path' => '/',
        'request_base_path' => '/',
        'model_base_path' => '/',
        'templates_base_path' => '/',
    ],

    'parents' => [
        'controller' => \App\Http\Controllers\Controller::class,   //по умолчанию базовый родительский контроллер, но можно указать свой в случае надобности
    ],
];

