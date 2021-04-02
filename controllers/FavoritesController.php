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
            $favorite = $this->FavoritesModel->findOneById($id);
            $this->render('editFavorite', ['favorite' => $favorite]);
        } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->FavoritesModel->id = $_POST['id'];
            $this->FavoritesModel->name = $_POST['name'];
            $this->FavoritesModel->url = $this->verifyUrl($_POST['url']);
            $category = $_POST['category'];
            $this->loadmodel('CategoriesModel');
            $existingCategory = $this->CategoriesModel->findCategory($category);
            if ($category == $existingCategory['name']) {
                $this->FavoritesModel->category_id = $existingCategory['id'];
            } else {
                $this->FavoritesModel->category_id = NULL;
            }
            var_dump($this->FavoritesModel);
            $this->FavoritesModel->editFavorite();

            $this->goHome();
        }
    }
}
