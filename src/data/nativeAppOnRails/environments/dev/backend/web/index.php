<?php

use App;

$name = 'backend';
$path = '../..';

@include_once(__DIR__ . '/' . $path . '/vendor/yii2bundle/yii2-app/src/App.php');

if(!class_exists(App::class)) {
	die('Run composer install');
}

App::run($name);
