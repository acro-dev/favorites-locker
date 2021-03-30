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
}
