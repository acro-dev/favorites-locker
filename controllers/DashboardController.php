<?php

class DashboardController extends Controller
{
    public function __construct()
    {
        if (!isset($_SESSION['userID'])) {
            $this->goHome();
        }
        if (!isset($_COOKIE['sort_fav-' . $_SESSION['userID']])) {
            $this->sortFav();
        }
    }

    public function index()
    {
        $cookie = 'sort_fav-' . $_SESSION['userID'];
        $order = $_COOKIE[$cookie] !== 'name' ? 'category_id, name' : 'name';
        $this->loadmodel("FavoritesModel");
        $favorites = $this->FavoritesModel->findAllByUserId($order);

        $this->render('dashboard', ['favorites' => $favorites]);
        var_dump($_COOKIE);
    }
    public function profile()
    {
        $this->loadmodel('UsersModel');
        $data = $this->UsersModel->getOne($_SESSION['userID']);
        $this->render('profile', $data);
    }
    public function render($file, $data = [])
    {
        $controller = str_replace('Controller', '', get_class($this));

        extract($data);
        ob_start();
        require_once(ROOT . 'views/' . strtolower($controller) . '/' . $file . '.php');
        $content = ob_get_clean();
        require_once(ROOT . 'views/layout/dashboard.php');
    }
    public function sortFav($filter = "name")
    {
        $name = 'sort_fav-' . $_SESSION['userID'];
        setcookie($name, $filter, time() + (60 * 60 * 24 * 365), "/");
        $this->goHome();
    }
}
