<?php
/**
 * Created by PhpStorm.
 * User: Psevdo
 * Date: 04.07.2017
 * Time: 12:59
 */

namespace app\controllers;

use Core\Controller;

class DefaultController extends Controller {

	public function actionIndex() {
		$this->render('index');
	}

}