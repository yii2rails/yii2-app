<?php

return [
	'yii2 rails' => [
		'sourceDir' => 'vendor/yii2rails/yii2-app/src/data/rails',
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
	'yii2 native' => [
		'sourceDir' => 'vendor/yii2rails/yii2-app/src/data/native',
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