<?php

namespace yii2lab\app\console\bin;

use Yii;
use yii\console\ExitCode;
use yii\helpers\Console;
use yii2lab\extension\console\helpers\input\Question;
use yii2lab\extension\console\helpers\Output;
use yii2lab\extension\console\base\Controller;
use yii2lab\domain\data\EntityCollection;
use yii2module\vendor\domain\entities\TestEntity;
use yii2lab\extension\console\helpers\Alert;
use yii2lab\app\domain\helpers\generator\Generator;
use yii2lab\extension\console\helpers\input\Select;
use yii2mod\helpers\ArrayHelper;

class GenerateController extends \yii\base\Component
{
	
	public function init() {
		parent::init();
		Output::line();
	}
	
	/**
	 * Generate app
	 */
	public function actionApp()
	{
		$config = require_once(__DIR__ . '/../../../src/data/config.php');
		$domainAlias = Select::display('Select domain', array_keys($config));
		$domainAlias = ArrayHelper::first($domainAlias);
		$aliasConfig = $config[$domainAlias];
		Generator::generateApplication($aliasConfig['sourceDir'], $aliasConfig['forCopy']);
		Alert::success('Template success generated!');
	}
	
}
