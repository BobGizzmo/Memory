<?php
define('ROOT', dirname(__DIR__));
require ROOT.'/src/Autoloader.php';
Src\Autoloader::register();
require ROOT.'/core/Autoloader.php';
Core\Autoloader::register();

if(empty($_GET)) {
    $_GET['p'] = 'game.indexAction';
}

$controllers = ['game'];
$methods = ['indexAction', 'getImages', 'getTimer', 'createScore'];

[$controller, $method] = explode('.', $_GET['p']);

if(!in_array($controller, $controllers) || !in_array($method, $methods)) {
    header('HTTP/1.0 404 Not Found');
    die;
}

$controller = 'Src\Controller\\'.ucfirst($controller).'Controller';

$controller = new $controller();

$controller->$method();