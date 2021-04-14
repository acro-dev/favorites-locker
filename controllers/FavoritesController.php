<?php

namespace Controllers;

use App\Controller;

class FavoritesController extends Controller
{
    private object $favorite;
    private object $category;

    public function __construct()
    {
        $this->favorite = $this->loadModel('FavoritesModel');
    }

    public function verifyUrl($url): string
    {
        $url = filter_var($url, FILTER_SANITIZE_URL);
        if (preg_match('/(http:\/\/)|(https:\/\/)/A', $url) === 0) {
            $url = 'http://' . $url;
        }

        return $url;
    }

    public function addFavorite(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $this->favorite->setUrl($this->verifyUrl(strtolower($_POST['fav-url'])));
            $this->favorite->setName(ucfirst(strtolower($_POST['fav-name'])));

            $this->favorite->addFavorite();

            $this->goTo();
        }
    }

    public function deleteFavorite($id): void
    {
        $this->favorite->removeById($id);
        $this->goTo();
    }

    public function editFavorite($id): void
    {

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $favorite = $this->favorite->findOneById($id);
            if(!$favorite || $favorite['user_id']!== $_SESSION['userId']){
                $data['error'] = 'Hmmm, une erreur est survenue. Veuillez réessayer plus tard.';
                $this->goTo();
            } else {
                $this->render('editFavorite', ['favorite' => $favorite]);
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $this->favorite->setId($id);
            $this->favorite->setName($_POST['name']);
            $this->favorite->setUrl($this->verifyUrl($_POST['url']));
            $category = $_POST['category'];
            $this->category = $this->loadModel('CategoriesModel');
            $existingCategory = $this->category->findCategory($category);
            if ($category === $existingCategory['name']) {
                $this->favorite->setCategory_id($existingCategory['id']);
            } else {
                $this->favorite->setCategory_id(NULL);
            }
            $this->favorite->editFavorite();

            $this->goTo('/dashboard/view/'.$_COOKIE['lastView']);
        }
    }
}
