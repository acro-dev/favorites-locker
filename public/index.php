<?php
session_start();
require_once '../vendor/autoload.php';

$router = new AltoRouter();

$router->map('GET', '/', 'DefaultController#index');

// map users details page using controller#action string
$router->map('GET', '/users/[i:id]', 'UsersController#editProfile');
$router->map('GET|POST', '/login', 'UsersController#login');
$router->map('GET|POST', '/signup', 'UsersController#signup');
$router->map('GET', '/logout', 'UsersController#logout');

// map dashboard
$router->map('GET', '/dashboard', 'DashboardController#index');

$match = $router->match();

if (is_array($match)) {

    $requestedAction = explode('#', $match['target']);
    $requestedAction[0] = 'Controllers\\' . $requestedAction[0];
    $action = $requestedAction[1];
    $controller = new $requestedAction[0];
    if (empty($match['params'])) {
        $controller->$action();
    } else {
        $controller->$action($match['params']);
    }
} else {
    // no route was matched
    header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}
