<?php
/**
 * Created by PhpStorm.
 * User: Psevdo
 * Date: 05.07.2017
 * Time: 8:10
 */

namespace Core;


class View {

	protected $content = '';
	protected $viewPath = '';
	protected $viewName = '';

	public function __construct($viewName, $viewPath, $params = []) {
		$this->viewName = $viewName;
		$this->viewPath = $viewPath;
		$this->params = $params;

		try {

			if(!file_exists($this->viewPath . $this->viewName . '.php'))
				throw new \Exception('Внутрення ошибка приложения');

			/*
			 * $params = ['param' => 'val1', 'param2' => 'val2']
			 * $param1 = 'val1'
			 * $param2 = 'val2'
			 */
			if(count($params) > 0) extract($params);

			ob_start();
			require_once($this->viewPath . $this->viewName . '.php');
			$this->content = ob_get_contents();
			ob_end_clean();


			if(!file_exists('app\views\layouts\main.php'))
				throw new \Exception('Внутрення ошибка приложения');

			require_once('app\views\layouts\main.php');

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