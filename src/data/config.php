<?php

return [
	'rails template' => [
		'sourceDir' => 'vendor/yii2rails/yii2-app/src/data/nativeAppOnRails',
		'forCopy' => [
			'backend' => [
				'backend',
				'environments/files/backend',
				'common',
				'environments/files/common',
			],
			'frontend' => [
				'frontend',
				'environments/files/frontend',
				'common',
				'environments/files/common',
			],
			'console' => [
				'cmd',
				'console',
				'environments/files/console',
			],
			'phpStorm' => [
				'.idea',
			],
		],
	],
	'yii template' => [
		'sourceDir' => 'vendor/yii2rails/yii2-app/src/data/appOnRails',
		'forCopy' => [
			'api' => [
				'api',
				'environments/files/api',
				'common',
				'environments/files/common',
			],
			'backend' => [
				'backend',
				'environments/files/backend',
				'common',
				'environments/files/common',
			],
			'frontend' => [
				'frontend',
				'environments/files/frontend',
				'common',
				'environments/files/common',
			],
			'console' => [
				'cmd',
				'console',
				'environments/files/console',
			],
			'phpStorm' => [
				'.idea',
			],
		],
	],
];