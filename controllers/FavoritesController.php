<?php

class FavoritesController extends Controller
{
    public function index()
    {
        if (isset($_SESSION['userID']) && $_SESSION['userID'] != "") {


            $this->loadmodel("FavoritesModel");
            $favorites = $this->FavoritesModel->findByUserId($_SESSION['userID']);

            $this->render('index', ['favorites' => $favorites]);
        } else {
            header('Location: /');
            exit;
        }
    }
    public function addFavorite()
    {
        if (isset($_POST['url']) && $_POST['url'] != "") {
            $url = trim($_POST['url']);
            $url = htmlspecialchars($url);
            $url = strtolower($url);
            if (preg_match('/(http:\/\/)|(https:\/\/)/A', $url) == 0) {
                $url = 'http://' . $url;
            }

            $name = trim($_POST['name']);
            $name = htmlspecialchars($name);
            $name = ucfirst($name);

            $this->loadmodel('FavoritesModel');
            $this->FavoritesModel->addFavorite($name, $url);

            header('Location: /');
        }
    }

    public function deleteFavorite($id)
    {
        $this->loadmodel('FavoritesModel');
        $this->FavoritesModel->removeById($id);

        header('Location: /');
    }

    public function editFavorite($id = '')
    {
        if ($id != '') {
            $this->loadmodel('FavoritesModel');
            $favorite = $this->FavoritesModel->getOne($id);
            $this->render('edit', ['favorite' => $favorite]);
        } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->loadmodel('FavoritesModel');
            $favorite = $this->FavoritesModel->editFavorite($_POST);

            header('Location: /');
        }
    }
}