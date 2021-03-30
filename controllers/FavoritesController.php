<?php

class FavoritesController extends Controller
{
    public function __construct()
    {
        $this->loadmodel('FavoritesModel');
    }

    public function addFavorite()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $url = strtolower($_POST['url']);
            if (preg_match('/(http:\/\/)|(https:\/\/)/A', $url) == 0) {
                $url = 'http://' . $url;
            }
            $name = ucfirst(strtolower($_POST['name']));

            $this->FavoritesModel->addFavorite($name, $url);

            header('Location: /');
        }
    }

    public function deleteFavorite($id)
    {
        $this->FavoritesModel->removeById($id);
        header('Location: /');
    }

    public function editFavorite($id = '')
    {
        if ($id != '') {
            $favorite = $this->FavoritesModel->getOne($id);
            $this->render('edit', ['favorite' => $favorite]);
        } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $favorite = $this->FavoritesModel->editFavorite($_POST);

            header('Location: /');
        }
    }
}
