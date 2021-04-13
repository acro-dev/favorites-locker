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

    public function index($params = [])
    {
        extract($params);

        if (isset($sortBy)) {
            switch ($sortBy) {
                case 'name':
                    $order = 'name';
                    break;
                case 'categories':
                    $order = 'name, category_id';
                    break;
            }
        } else {
            $order = 'name';
        }

        $this->loadmodel("FavoritesModel");
        $favorites = $this->FavoritesModel->findAllByUserId($order);

        $this->render('dashboard', ['favorites' => $favorites, 'order' => $order]);
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
    }
}
