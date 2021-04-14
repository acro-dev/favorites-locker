<?php

session_start();
require_once '../vendor/autoload.php';
require_once '../app/functions.php';

$router = new AltoRouter();

// map Homepage
$router->map('GET', '/', 'DefaultController#index');

// map users details page using controller#action string
$router->map('GET|POST', '/login', 'UsersController#login');
$router->map('GET|POST', '/signup', 'UsersController#signup');
$router->map('GET', '/logout', 'UsersController#logout');
$router->map('GET', '/users/[i:id]', 'UsersController#editProfile');

// map dashboard
$router->map('GET|POST', '/dashboard', 'DashboardController#view');
$router->map('GET', '/dashboard/view/[:view]?', 'DashboardController#view');
$router->map('GET', '/dashboard/show-category/[a:category]?', 'DashboardController#showCategory');

// map favorites actions
$router->map('POST', '/favorites/addFavorite', 'FavoritesController#addFavorite');
$router->map('GET', '/favorites/deleteFavorite/[i:id]', 'FavoritesController#deleteFavorite');
$router->map('GET|POST', '/favorites/editFavorite/[i:id]', 'FavoritesController#editFavorite');

$match = $router->match();

if (is_array($match)) {

    $requestedAction = explode('#', $match['target']);
    $requestedAction[0] = 'Controllers\\' . $requestedAction[0];
    $action = $requestedAction[1];
    $controller = new $requestedAction[0];
    if (empty($match['params'])) {
        $controller->$action();
    } else {
        extract($match['params'], EXTR_OVERWRITE);
        if (isset($id)) {
            $controller->$action($id);
        } else if (isset($view)) {
            $controller->$action($view);
        }
    }
} else {
    // no route was matched
    header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    require_once '../views/errors/404.php';
}
