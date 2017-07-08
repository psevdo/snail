<?php
/**
 * Created by PhpStorm.
 * User: Psevdo
 * Date: 04.07.2017
 * Time: 13:47
 */

namespace Core;


class Controller {

	protected $module = '';
	protected $controller = '';
	protected $layout = 'main';

	/**
	 * Controller constructor.
	 * @param $module
	 * @param $controller
	 */
	public function __construct($module, $controller) {
		$this->module = $module;
		$this->controller = $controller;
		// echo '<pre>';
		// print_r($this);
		// echo '</pre>';
	}

	protected function render($view, $params = []) {
		if($this->module != '' && $this->controller != '')
			new View($view, 'app\modules\\' . $this->module . '\views\\' . $this->controller . '\\', $params);
		elseif($this->module == '' && $this->controller != '')
			new View($view, 'app\views\\' . $this->controller . '\\', $params);
		else
			throw new \Exception('Внутренняя ошибка приложения');
	}
	/**
	 *
	 */
}