<?php

session_start();
require_once '../vendor/autoload.php';
require_once '../app/functions.php';

$router = new AltoRouter();

$router->map('GET', '/', 'DefaultController#index');

// map users details page using controller#action string
$router->map('GET', '/users/[i:id]', 'UsersController#editProfile');
$router->map('GET|POST', '/login', 'UsersController#login');
$router->map('GET|POST', '/signup', 'UsersController#signup');
$router->map('GET', '/logout', 'UsersController#logout');

// map dashboard
$router->map('GET|POST', '/dashboard', 'DashboardController#index');
$router->map('GET', '/dashboard/sort-by/[a:sortBy]?', 'DashboardController#index');
$router->map('GET', '/dashboard/show-category/[a:category]?', 'DashboardController#showCategory');

// map favorites actions
$router->map('POST', '/favorites/addFavorite', 'FavoritesController#addFavorite');
$router->map('GET', '/favorites/deleteFavorite/[i:id]', 'FavoritesController#deleteFavorite');
$router->map('GET', '/favorites/editFavorite/[i:id]', 'FavoritesController#editFavorite');
$router->map('POST', '/favorites/editFavorite', 'FavoritesController#editFavorite');

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
