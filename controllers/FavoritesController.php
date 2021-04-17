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
        $this->category = $this->loadModel('CategoriesModel');

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
            $this->favorite->setUser_id($_SESSION['userId']);
            if ($_POST['category'] !== '') {
                $this->favorite->setCategory_id($_POST['category']);
            } else {
                $this->favorite->setCategory_id(0);
            }

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
            $favorite = $this->favorite->getOneById($id);
            $categories = $this->category->sortCategory($this->category->getAll());

            if (!$favorite || $favorite['user_id'] !== $_SESSION['userId']) {
                $data['error'] = 'Hmmm, une erreur est survenue. Veuillez réessayer plus tard.';
                $this->goTo('/dashboard');
            } else {
                $this->render('editFavorite', [
                    'favorite' => $favorite,
                    'categories' => $categories
                ]);
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $this->favorite->setId($id);
            $this->favorite->setName($_POST['name']);
            $this->favorite->setUrl($this->verifyUrl($_POST['url']));

            $this->category->setName = trim($_POST['category']);
            $this->category->setSlug = slugify($this->category->getName);

            $existingCategory = $this->category->getCategoryByName($this->category->getName);

            if ($existingCategory) {
                $this->favorite->setCategory_id($existingCategory['id']);
            } else {
                $this->category->addCategory();

                $newCategory = $this->category->getCategoryBySlug($categorySlug);
                $this->favorite->setCategory_id($newCategory['id']);
            }

            $this->favorite->editFavorite();

            $this->goTo('/dashboard/view/' . $_COOKIE['lastView']);
        }
    }
}
