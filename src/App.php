<?php

use common\locators\DomainLocator;
use yii2rails\domain\base\BaseDomainLocator;
use yii\base\InvalidConfigException;
use yii\console\Application as ConsoleApplication;
use yii\web\Application as WebApplication;
use yii\web\ServerErrorHttpException;
use yii2rails\app\domain\helpers\Env;
use yii2rails\app\domain\helpers\Constant;
use yii2rails\app\domain\helpers\Config;
use yii2rails\app\domain\helpers\Load;
use yii2rails\extension\develop\helpers\Benchmark;
use yii2rails\extension\scenario\helpers\ScenarioHelper;

class App
{
	
	/**
	 * @var DomainLocator|BaseDomainLocator the domain container
	 */
	public static $domain;
	
	private static $initedAs = null;
	
	public static function run($appName = null, $projectDir = '')
	{
		if(!empty($appName)) {
			self::init($appName, $projectDir);
		}
		$config = self::initConfig();
		self::runApplication($config);
	}
	
	public static function init($appName, $projectDir = '')
	{
		if(self::$initedAs) {
			return;
		}
		define('MICRO_TIME', microtime(true));
		require_once(__DIR__ . '/domain/helpers/Load.php');
		Load::autoload();
		//Load::helpers();
		Constant::init($appName);
		//CodeCacheHelper::loadClassesCache();
		
		Benchmark::begin('pre_init_yii_' . __METHOD__);
		Env::init($projectDir);
		$env = Env::get();
		Constant::setYiiEnv($env['mode']['env']);
		Constant::setYiiDebug($env['mode']['debug']);
		$yiiClass = Env::get('yii.class');
		Load::yii($yiiClass);
		Benchmark::end('pre_init_yii_' . __METHOD__);
		
		Benchmark::begin('init_yii_' . __METHOD__);
		Load::required();
		$aliases = Env::get('aliases');
		Constant::setAliases($aliases);
		$container = Env::get('container');
		Constant::setContainer($container);
		Benchmark::end('init_yii_' . __METHOD__);
		
		Benchmark::begin('run_env_commands_' . __METHOD__);
		$commands = Env::get('app.commands', []);
		self::runCommands($commands);
		Benchmark::end('run_env_commands_' . __METHOD__);
		
		self::$initedAs = $appName;
	}

	public static function initPhpApplication($appName = 'default', $config = null) {
	    self::init($appName);
        if(empty($config)) {
            $config = include(__DIR__ . '/../../../../vendor/yii2rails/yii2-app/src/php/config/main.php');
        }
        Yii::$app = self::getYiiApplication($config);
        Yii::$app->init();
    }

    private static function getYiiApplication($config = null)
    {
        if (APP == CONSOLE) {
            $application = new ConsoleApplication($config);
        } else {
            $application = new WebApplication($config);
        }
        return $application;
    }

	private static function initConfig() {
		Benchmark::begin('init_config');
		$definition = Env::get('config');
		Config::init($definition);
		$config = Config::get();
		Benchmark::end('init_config');
		return $config;
	}
	
	private static function runCommands($commands)
	{
		try {
			$filterCollection = new \yii2rails\extension\scenario\collections\ScenarioCollection($commands);
			$filterCollection->runAll();
		} catch(InvalidConfigException $e) {
		} catch(ServerErrorHttpException $e) {
		}
	}
	
	private static function runApplication($config)
	{
        $application = self::getYiiApplication($config);
		if (APP == CONSOLE) {
			$exitCode = $application->run();
			exit($exitCode);
		} else {
			$application->run();
		}
	}
	
}
