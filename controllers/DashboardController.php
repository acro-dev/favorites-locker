<?php

namespace Controllers;

use App\Controller;

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
    }
    public function profile()
    {
        $this->loadmodel('UsersModel');
        $data = $this->UsersModel->getOne($_SESSION['userID']);
        $this->render('profile', $data);
    }

    public function sortFav($filter = "name")
    {
        $name = 'sort_fav-' . $_SESSION['userID'];
        setcookie($name, $filter, time() + (60 * 60 * 24 * 365), "/");
        $this->goHome();
    }
}
