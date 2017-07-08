<?php

/**
 * Created by PhpStorm.
 * User: Psevdo
 * Date: 03.07.2017
 * Time: 12:15
 */

namespace app\modules\test\controllers;

class TestController extends \Core\Controller {

	public function actionWerty() {
		$this->render('index', [
			'param1' => 'val1',
			'param2' => 'val2'
		]);
	}

}