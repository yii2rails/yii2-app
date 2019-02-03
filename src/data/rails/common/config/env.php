<?php

use yii2rails\app\domain\commands\ApiVersion;
use yii2rails\app\domain\commands\RunBootstrap;
use yii2rails\app\domain\filters\config\LoadConfig;
use yii2rails\app\domain\filters\config\LoadModuleConfig;
use yii2rails\app\domain\filters\config\LoadRouteConfig;
use yii2rails\domain\filters\LoadDomainConfig;
use yii2rails\app\domain\enums\YiiEnvEnum;

return [
	'api' => [
		'defaultVersion' => 1,
	],
    'aliases' => [],
    'cache' => [
        'enable' => false, //YII_ENV == YiiEnvEnum::PROD,
    ],
	'servers' => [
		'db' => [
			'main' => [
				'driver' => 'sqlite',
				'dbname' => '@common/runtime/sqlite/main.db',
				'map' => [],
			],
			'test' => [
				'driver' => 'sqlite',
				'dbname' => '@common/runtime/sqlite/test.db',
			],
			'filedb' => [
				'path' => '@common/data',
			],
		],
	],
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
			[
				'class' => ApiVersion::class,
				'isEnabled' => APP == API,
			],
            [
                'class' => 'yii2rails\domain\filters\DefineDomainLocator',
                'filters' => [
                    [
                        'class' => LoadDomainConfig::class,
                        'app' => COMMON,
                        'name' => 'domains',
                        'withLocal' => true,
                    ],
                ],
            ],
            /*[
                'class' => 'yii2module\offline\domain\filters\IsOffline',
                'exclude' => [
                    CONSOLE,
                    BACKEND,
                ],
            ],*/
		],
	],
	'config' => [
		'filters' => [
			[
				'class' => LoadConfig::class,
				'app' => COMMON,
				'name' => 'main',
				'withLocal' => true,
			],
			[
				'class' => LoadConfig::class,
				'app' => APP,
				'name' => 'main',
				'withLocal' => true,
			],
			
			[
				'class' => LoadModuleConfig::class,
				'app' => COMMON,
				'name' => 'modules',
				'withLocal' => true,
			],
			[
				'class' => LoadModuleConfig::class,
				'app' => APP,
				'name' => 'modules',
				'withLocal' => true,
			],
			
			[
				'class' => LoadRouteConfig::class,
				'app' => APP,
				'name' => 'routes',
				'withLocal' => true,
			],
			
			[
				'class' => LoadConfig::class,
				'app' => COMMON,
				'name' => 'params',
				'withLocal' => true,
				'assignTo' => 'params',
			],
			[
				'class' => LoadConfig::class,
				'app' => APP,
				'name' => 'params',
				'withLocal' => true,
				'assignTo' => 'params',
			],
			
			[
				'class' => LoadConfig::class,
				'app' => COMMON,
				'name' => 'install',
			],
			[
				'class' => LoadConfig::class,
				'app' => APP,
				'name' => 'install',
			],
			
			[
				'class' => LoadConfig::class,
				'app' => COMMON,
				'name' => 'test',
				'withLocal' => true,
				'isEnabled' => YII_ENV == YiiEnvEnum::TEST,
			],
			[
				'class' => LoadConfig::class,
				'app' => APP,
				'name' => 'test',
				'withLocal' => true,
				'isEnabled' => YII_ENV == YiiEnvEnum::TEST,
			],
			
			[
				'class' => 'yii2lab\db\domain\filters\migration\SetPath',
				'path' => [
					'@vendor/yii2bundle/yii2-rbac/src/domain/migrations',
					//'@vendor/yii2bundle/yii2-account/src/domain/v2/migrations',
					//'@vendor/yiisoft/yii2/log/migrations',
                    '@vendor/yii2tool/yii2-restclient/src/domain/migrations',
					'@vendor/yii2bundle/yii2-lang/src/domain/migrations',
					'@vendor/yii2bundle/yii2-account/src/domain/v2/migrations',
                    '@vendor/yubundle/yii2-account/src/domain/v2/migrations',
                    '@vendor/yubundle/yii2-reference/src/domain/migrations',
                    '@vendor/yubundle/yii2-user/src/domain/v1/migrations',
				],
				'scan' => [
					'@domain',
				],
			],
			
			'yii2rails\app\domain\filters\config\StandardConfigMutations',
			'yii2rails\app\domain\filters\config\DebugModule',
		],
	],
];