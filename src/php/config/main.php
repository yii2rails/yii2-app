<?php

return [
    'id'                  => 'yii2-php',
    'basePath'            => __DIR__,
    'enableCoreCommands'  => false,
    'controllerNamespace' => 'yii\\apidoc\\commands',
    'components' => [
        'language' => 'yii2module\lang\domain\components\Language',
        'user' => [
            'class' => 'yii2module\account\domain\v2\web\User',
        ],
        'authManager' => 'yii2lab\rbac\domain\rbac\PhpManager',
        'cache' => [
            'class' => 'yii\caching\FileCache',
            'cachePath' => '@common/runtime/cache',
        ],
        'i18n' => [
            'class' => 'yii2module\lang\domain\i18n\I18N',
            'aliases' => [
                '*' => '@common/messages',
            ],
        ],
        'db' => 'yii2lab\db\domain\db\Connection',
        'queue' => [
            'class' => 'yii2rails\extension\queue\drivers\file\Queue',
            'path' => '@common/runtime/queue',
            'autoRun' => !YII_ENV_PROD,
        ],
        'session' => [
            'class' => 'yii\web\Session',
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-php',
        ],
    ],
];
