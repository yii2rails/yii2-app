<?php

use yii2rails\app\domain\commands\RunBootstrap;

return [
    'app' => [
        'commands' => [
            [
                'class' => RunBootstrap::class,
                'app' => COMMON,
            ],
            [
                'class' => RunBootstrap::class,
                'app' => APP,
            ],
        ],
    ],
    'config' => [
        'filters' => [
            'yii2rails\app\domain\filters\config\NativeYiiTemplateConfig',
        ],
    ],
];
