<?php

namespace Controllers;

use App\Controller;

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

            $this->FavoritesModel->setUrl($this->verifyUrl(strtolower($_POST['fav-url'])));
            $this->FavoritesModel->setName(ucfirst(strtolower($_POST['fav-name'])));

            $this->FavoritesModel->addFavorite();

            $this->goHome();
        }
    }

    public function deleteFavorite($params)
    {
        echo 'hohoh';
        extract($params);
        $this->FavoritesModel->removeById($id);
        $this->goHome();
    }

    public function editFavorite($params = [])
    {
        extract($params);

        if ($id != '') {
            $favorite = $this->FavoritesModel->findOneById($id);
            $this->render('editFavorite', ['favorite' => $favorite]);
        } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->FavoritesModel->setId($_POST['id']);
            $this->FavoritesModel->setName($_POST['name']);
            $this->FavoritesModel->setUrl($this->verifyUrl($_POST['url']));
            $category = $_POST['category'];
            $this->loadmodel('CategoriesModel');
            $existingCategory = $this->CategoriesModel->findCategory($category);
            if ($category == $existingCategory['name']) {
                $this->FavoritesModel->setCategory_id($existingCategory['id']);
            } else {
                $this->FavoritesModel->setCategory_id(NULL);
            }
            $this->FavoritesModel->editFavorite();

            $this->goHome();
        }
    }
}
