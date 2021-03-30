<?php
session_start();

define('ROOT', str_replace('public/index.php', '', $_SERVER['SCRIPT_FILENAME']));

require_once ROOT . '/app/Model.php';
require_once ROOT . '/app/Controller.php';

$params = explode('/', $_GET['p']);

if ($params[0] != "") {
    $controller = ucFirst($params[0]) . "Controller";

    $action = (isset($params[1]) && !empty($params[1])) ? $params[1] : "index";

    require_once ROOT . '/controllers/' . $controller . '.php';
    $controller = new $controller;
    if (method_exists($controller, $action)) {
        unset($params[0]);
        unset($params[1]);
        call_user_func_array([$controller, $action], $params);
        // $controller->$action();
    } else {
        http_response_code(404);
        echo "La page demandé n'existe pas !";
    }
} else {
    require_once ROOT . 'controllers/DefaultController.php';
    $DefaultController = new DefaultController;
    $DefaultController->index();
}
