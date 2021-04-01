<?php

class FavoritesController extends Controller
{
    public function __construct()
    {
        $this->loadmodel('FavoritesModel');
    }

    public function verifyUrl($url)
    {
        if (preg_match('/(http:\/\/)|(https:\/\/)/A', $url) == 0) {
            $url = 'http://' . $url;
        }

        return $url;
    }

    public function addFavorite()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $this->FavoritesModel->url = $this->verifyUrl(strtolower($_POST['url']));
            $this->FavoritesModel->name = ucfirst(strtolower($_POST['name']));

            $this->FavoritesModel->addFavorite();

            $this->goHome();
        }
    }

    public function deleteFavorite($id)
    {
        $this->FavoritesModel->removeById($id);
        $this->goHome();
    }

    public function editFavorite($id = '')
    {
        if ($id != '') {
            $favorite = $this->FavoritesModel->getOne($id);
            $this->render('editFavorite', ['favorite' => $favorite]);
        } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->FavoritesModel->id = $_POST['id'];
            $this->FavoritesModel->name = $_POST['name'];
            $this->FavoritesModel->url = $this->verifyUrl($_POST['url']);
            $this->FavoritesModel->editFavorite();

            $this->goHome();
        }
    }
}
