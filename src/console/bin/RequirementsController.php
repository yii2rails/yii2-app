<?php

namespace yii2rails\app\console\bin;

use Yii;
use yii\console\ExitCode;
use yii\helpers\Console;
use yii2rails\extension\console\helpers\input\Question;
use yii2rails\extension\console\helpers\Output;
use yii2rails\extension\console\base\Controller;
use yii2rails\domain\data\EntityCollection;
use yii2module\vendor\domain\entities\TestEntity;
use yii2rails\extension\console\helpers\Alert;
use yii2rails\app\domain\helpers\generator\Generator;
use yii2rails\extension\console\helpers\input\Select;
use yii2mod\helpers\ArrayHelper;
use yii2lab\init\domain\helpers\CheckYiiRequirements;

class RequirementsController extends \yii\base\Component
{
	
	public function init() {
		parent::init();
		Output::line();
	}
	
	/**
	 * Check Yii Requirements
	 */
	public function actionAll()
	{
		CheckYiiRequirements::run()->render();
	}
	
}
