<?php

class DashboardController extends Controller
{
    public function index()
    {
        if (isset($_SESSION['userID'])) {
            $this->loadmodel("FavoritesModel");
            $favorites = $this->FavoritesModel->findByUserId($_SESSION['userID']);

            $this->render('index', ['favorites' => $favorites]);
        }
    }
}
