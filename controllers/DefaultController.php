<?php

namespace Controllers;

use App\Controller;

class DefaultController extends Controller
{
    public function index(): void
    {
        if (isset($_SESSION['userId'])) {
            $this->goTo('/dashboard');
        } else {
            $this->render('index');
        }
    }
}
