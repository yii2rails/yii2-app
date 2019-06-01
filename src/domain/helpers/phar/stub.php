<?php
define('PHAR_LOADED', true);

spl_autoload_register(function ($class) {
    $path = str_replace('\\', SL, $class);
    /*if($path == 'Yii') {
        $path = 'yii/Yii';
    }*/
    $fileName = 'phar://../../' . PHAR_FILE . SL . $path . '.php';
    /*if(!file_exists($fileName)) {
        \yii2rails\app\domain\helpers\phar\PharCacheHelper::addClass($class);
    }*/
    $result = @include($fileName);
    return $result;
});

__HALT_COMPILER();