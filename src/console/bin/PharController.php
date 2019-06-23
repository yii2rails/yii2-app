<?php

namespace yii2rails\app\console\bin;

use Yii;
use yii\helpers\ArrayHelper;
use yii2rails\app\domain\helpers\phar\PharCacheHelper;
use yii2rails\extension\code\helpers\CodeCacheHelper;
use yii2rails\extension\console\handlers\RenderHahdler;
use yii2rails\extension\console\helpers\input\Select;
use yii2rails\extension\console\helpers\Output;
use yii2rails\extension\console\base\Controller;
use yii2rails\extension\yii\helpers\FileHelper;

class PharController extends \yii\base\Component
{
	
	public function init() {
		parent::init();

        \yii2rails\domain\helpers\DomainHelper::defineDomains([
            'tool' => 'yii2tool\tool\domain\Domain',
        ]);

        Output::line();
	}

    public function actionMakeCache2()
    {
        Output::line('Update cache...');

        $select = Select::display('From', ['all', 'common']);
        $from = Select::getFirstValue($select);
        if($from == 'all') {
            $all = \App::$domain->tool->runtimeInclude->allUnique();
        } elseif ($from == 'common') {
            $all = PharCacheHelper::allCommon();
        }

        CodeCacheHelper::saveClassesCache($all);

        Output::block('Cache updated!');
        $size = filesize(CodeCacheHelper::getFileName());
        Output::arr([
            'total files' => count($all),
            'size' => FileHelper::sizeFormat($size),
        ]);
    }

	public function actionMakeCache()
	{
		Output::line('Update cache...');

		$select = Select::display('From', ['all', 'common']);
		$from = Select::getFirstValue($select);
		if($from == 'all') {
            $all = \App::$domain->tool->runtimeInclude->allUnique();
        } elseif ($from == 'common') {
            $all = PharCacheHelper::allCommon();
        }

        d([count($all), $all]);

        PharCacheHelper::setRendeClass(RenderHahdler::class);
        PharCacheHelper::addClassListWithParents($all);


        Output::block('Cache updated!');
        $size = filesize(ROOT_DIR . DS . PHAR_FILE);
        Output::arr([
            'total files' => count($all),
            'phar size' => FileHelper::sizeFormat($size),
        ]);
	}

}
