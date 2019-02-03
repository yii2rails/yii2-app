<?php

namespace yii2rails\app\domain\filters\config;

use yii2rails\extension\scenario\base\BaseScenario;

class FixValidationKeyInTest extends BaseScenario {
	
	public function run() {
		$config = $this->getData();
		if(APP != CONSOLE && empty($config['components']['request']['cookieValidationKey'])) {
			$config['components']['request']['cookieValidationKey'] = 'testValidationKey'; // костыль, чтоб не выдавало ошибку при тестах в common
		}
		$this->setData($config);
	}
	
}
