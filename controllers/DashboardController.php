<?php

class DashboardController extends Controller
{
    public function index()
    {
        if (isset($_SESSION['userID'])) {
            $this->loadmodel("FavoritesModel");
            $favorites = $this->FavoritesModel->findAllByUserId($_SESSION['userID']);

            $this->render('index', ['favorites' => $favorites]);
        }
    }
    public function profile($id = '')
    {
        if (!isset($_SESSION['userID']) || $_SESSION['userID'] != $id) {
            header('Location: /');
        } else {
            $this->loadmodel('UsersModel');
            $data = $this->UsersModel->getOne($_SESSION['userID']);
            $this->render('profile', $data);
        }
    }
}
