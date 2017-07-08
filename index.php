<?php
/**
 * Created by PhpStorm.
 * User: Psevdo
 * Date: 02.07.2017
 * Time: 13:19
 */

defined('SNAIL_DEBUG') or define('SNAIL_DEBUG', true);

if(SNAIL_DEBUG === true) {
	ini_set('display_errors', 'on');
}
if(SNAIL_DEBUG === false) {
	ini_set('display_errors', 'off');
}

require_once(__DIR__ . '/core/Snail.php');
require_once(__DIR__ . '/core/Route.php');
require_once(__DIR__ . '/core/Module.php');
require_once(__DIR__ . '/core/Controller.php');
require_once(__DIR__ . '/core/View.php');
$confg = require_once(__DIR__ . '/config/main.php');

(new Core\Snail($confg))->run();