<?php

namespace Controllers;

use App\Controller;

class DashboardController extends Controller
{
    private object $user;
    private object $favorites;

    public function __construct()
    {
        if (!isset($_SESSION['userId'])) {
            $this->goTo();
        }
        $this->favorites = $this->loadModel("FavoritesModel");

    }

    public function view(string $view = 'by-name'): void
    {
        $favorites = $this->favorites->getAllByUserId($_SESSION['userId']);
        $categories = $this->sortCategory($favorites);

        $categoryKey = array_search($view, array_column($categories, 'slug'), true);

        if ($categoryKey !== false) {
            foreach ($favorites as $i => $favorite) {
                if ($favorite['category'] !== $categories[$categoryKey]['name']) {
                    unset($favorites[$i]);
                }
            }
        }

        setcookie('lastView',$view,0,'/');

        $this->render('dashboard', [
            'view' => $view,
            'favorites' => $favorites,
            'categories' => $categories
        ]);
    }

    public function sortCategory(array $favorites): array
    {
        $categories = array();

        foreach ($favorites as $fav) {
            if ($fav['category'] !== null &&
                !in_array($fav['category'], array_column($categories, 'name'), true)) {
                $categories[] = ['name'=>$fav['category'], 'slug'=>slugify($fav['category'])];
            }
        }
        sort($categories);
        return $categories;
    }
}
