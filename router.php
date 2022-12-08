<?php
define('ROOT', __DIR__);
ini_set('display_errors', 'on');
error_reporting(E_ALL);
session_start();
$params = $_GET['params'];
$params = explode("/", $params);
$controller = ucfirst($params[0]);
$method = !empty($params[1]) ? $params[1] : 'index';
require(ROOT . '/Models/Database.php');


require 'vendor/autoload.php';


if (file_exists("Controllers/". $controller . "Controller.php")) {
	include("Controllers/" . $controller . "Controller.php");
	$controller = "Controllers\\$controller" . "Controller";
	$page = new $controller();

	if (method_exists($controller, $method)) {
		array_splice($params, 0, 2);
		call_user_func_array(array($page, $method), $params);
	} else {
		include("Controllers/ErrorController.php");
	}
} else if ($controller === "") {
	include("Controllers/BlogController.php");
	$page = new Controllers\BlogController();
	$page->$method();
} else {
	include("Controllers/ErrorController.php");
}