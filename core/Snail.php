<?php

/**
 * Created by PhpStorm.
 * User: Psevdo
 * Date: 03.07.2017
 * Time: 9:17
 */

namespace Core;

use Core\Route;

class Snail {

	protected $config = [];
	private $_module = '';
	private $_controller = '';
	private $_action = '';

	/**
	 * Snail constructor.
	 * @param $config
	 */
	public function __construct($config) {
		$this->config = $config;
	}

	/**
	 * @return string
	 */
	public function version() {
		return '1.0.0';
	}

	public function run() {
		// получаем URL и список параметров
		$route = Route::parseUrl();
		$this->_module = $route['module'];
		$this->_controller = $route['controller'];
		$this->_action = $route['action'];

		// если не указан модуль, то запускаем контроллер по-умолчанию
		if($this->_module == '') {
			$namespace = '\app\controllers\\';
			$this->_controller = 'default';
			$controllerName = ucfirst($this->_controller) . 'Controller';
			$actionName = 'actionIndex';

			try {
				if(!file_exists('app/controllers/' . $controllerName . '.php'))
					throw new \Exception('Внутрення ошибка приложения');
				require_once('app/controllers/' . $controllerName . '.php');
			} catch(\Exception $e) {
				echo $e->getMessage();
				if(SNAIL_DEBUG === true) {
					echo '<br />' . $e->getFile();
					echo ' (Строка: ' . $e->getLine() . ')';
				}
				die();
			}
		} else {
			$namespace = '\app\modules\\' . $this->_module . '\controllers\\';
			$controllerName = ucfirst($this->_controller) . 'Controller';
			$actionName = 'action' . ucfirst($this->_action);

			try {
				if(!file_exists('app/modules/' . $this->_module . '/controllers/' . $controllerName . '.php'))
					throw new \Exception('Внутрення ошибка приложения');
				require_once('app/modules/' . $this->_module . '/controllers/' . $controllerName . '.php');
			} catch(\Exception $e) {
				echo $e->getMessage();
				if(SNAIL_DEBUG === true) {
					echo '<br />' . $e->getFile();
					echo ' (Строка: ' . $e->getLine() . ')';
				}
				die();
			}
		}


		try {
			$controllerName = $namespace . $controllerName;
			if(!class_exists($controllerName)) throw new \Exception('Ошибка выполнения приложения');

			$controller = new $controllerName($this->_module, $this->_controller);
			if(!method_exists($controller, $actionName)) throw new \Exception('Ошибка выполнения приложения');

			// выполняем метод контроллера
			call_user_func_array(
				[$controller, $actionName],
				[] // $this->_params
			);
		} catch(\Exception $e) {
			echo $e->getMessage();

			if(SNAIL_DEBUG === true) {
				echo '<br />' . $e->getFile();
				echo ' (Строка: ' . $e->getLine() . ')';
			}
			die();
		}

	}
}