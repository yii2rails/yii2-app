<?php

use yii2lab\app\domain\enums\YiiEnvEnum;

$url = [
	'frontend' => 'http://demo.yii/',
	'backend' => 'http://admin.demo.yii/',
	'api' => 'http://api.demo.yii/',
];

$servers = [
	'static' => [
		//'publicPath' => '@frontend/web/',
		/*'domain' => 'http://static.yii/',
		'driver' => 'ftp',
		'connection' => [
			'host' => 'static.yii',
			'username' => 'static',
			'password' => '123456',
		],*/
		'domain' => $url['frontend'],
		'driver' => 'local',
		'connection' => [
			'path' => '@frontend/web',
		],
	],
	/*'mail' => [
		'host' => '',
		'username' => '',
		'password' => '',
		'port' => 25,
		//'encryption' => 'ssl', // It is often used, check your provider or mail server specs
	],*/
	'db' => [
		'main' => [
			'driver' => 'pgsql',
			'host' => '127.0.0.1',
			'username' => 'postgres',
			'password' => '',
			'dbname' => 'demo_yii',
			'defaultSchema' => 'public',
		],
	],
];

$authclientProfiles = [
	'github' => [
		'class' => 'yii\authclient\clients\Github',
		'clientId' => '',
		'clientSecret' => '',
	],
];

$config = [
	'title' => 'Develop',
	'filters' => [
		[
			'class' => 'yii2lab\init\domain\filters\input\Custom',
			'title' => 'Custom env config',
			'segment' => null,
			'value' => [
				'url' => $url,
				'servers' => $servers,
				'mode' => [
					'env' => YiiEnvEnum::DEV,
					'debug' => true,
				],
				'jwt' => include(__DIR__ . '/../snipet/jwt.php'),
				/*'authclient' => [
					'profiles' => $authclientProfiles,
				],*/
			],
		],
	],
];

$filters = include(__DIR__ . '/../snipet/filters.php');
$config['filters'] = array_merge($config['filters'], $filters);
return $config;