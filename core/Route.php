<?php

/**
 * Created by PhpStorm.
 * User: Psevdo
 * Date: 03.07.2017
 * Time: 7:05
 */

namespace Core;

class Route {

	public function __construct() {
	}

	/**
	 * @return array
	 */
	public static function parseUrl() {

		// [HTTP_HOST] => snail
		// [REQUEST_URI] => /index.php/user/edit/1
		// [SCRIPT_NAME] => /index.php
		// [PATH_INFO] => /user/edit/1

		// получаем URL и удаляем символ / в начале и конце строки
		// $path = $_SERVER['PATH_INFO'];
		// if($path[0] == '/') $path = substr($path, 1);
		// if($path[strlen($path) - 1] == '/') $path = substr($path, 0, -1);
		//
		// // формируем список параметров
		// $routes = explode('/', $path);
		// if(count($routes) > 2) {
		// 	$routeParams = [];
		// 	for($i = 3; $i < count($routes); $i++) {
		// 		$routeParams[] = $routes[$i];
		// 	}
		// }

		$module = (isset($_GET['module']))? $_GET['module'] : '';
		$controller = (isset($_GET['controller']))? $_GET['controller'] : '';
		$action = (isset($_GET['action']))? $_GET['action'] : '';

		return [
			'module' => $module,
			'controller' => $controller,
			'action' => $action,
		];
	}

	/*public static function createUrl($params = ['user/edit', ['id' => 1, 'par' => 3]]) {
		echo '<pre>';
		print_r($params);
		echo '</pre>';

		// $baseUrl = $params[0];
		// $paramsUrl=$params[1];

		$_url = $params[0];
		if(isset($params[1])) {


			$paramsUrl = [];
			foreach($params[1] as $_key => $_param) {
				$paramsUrl[] = $_key;
			}

			$_url .= '?' . implode('&', $paramsUrl);
		}

		$routeRules = [
			'user/edit/<id:\d+>/<par>' => 'user/edit'
		];

		echo '<pre>';
		print_r($routeRules);
		echo '</pre>';

		foreach($routeRules as $_key => $_rule) {
			echo $_rule.'<br />';
			if($_rule == $params[0]) {
				echo $_key;
				$_url = $_key;
			}
		}

		echo $_url;
	}*/

}