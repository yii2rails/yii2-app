<?php 

return [
	'commands' => [],
	'filters' => [
		[
			'class' => 'yii2lab\\app\\domain\\filters\\env\\LoadConfig',
			'paths' => [
				'vendor/yii2rails/yii2-app/tests/_application_test/common/config',
			],
		],
		'yii2lab\\app\\domain\\filters\\env\\YiiEnv',
	],
];