<?php
define('ROOT', dirname(__DIR__));

if(empty($_GET)) {
    $_GET['p'] = 'game.indexAction';
}

$controllers = ['game'];
$methods = ['indexAction', 'getImages', 'getTimer', 'createScore'];

[$controller, $method] = explode('.', $_GET['p']);

if(!in_array($controller, $controllers) || !in_array($method, $methods)) {
    header('HTTP/1.1 403 Forbidden');
    die;
}

require_once ROOT.'/src/Controller/'.ucfirst($controller).'Controller.php';

$controller = ucfirst($controller).'Controller';

$controller = new $controller();

$controller->$method();



