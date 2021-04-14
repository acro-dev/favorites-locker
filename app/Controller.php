<?php

namespace App;

abstract class Controller
{
    public function loadModel(string $model): object
    {
        $modelPath = 'Models\\' . $model;
        return new $modelPath;
    }

    public function render(string $file, array $data = []): void
    {
        $controller = str_replace(['Controllers\\', 'Controller'], '', get_class($this));

        extract($data, EXTR_OVERWRITE);
        ob_start();
        require_once('../views/' . strtolower($controller) . '/' . $file . '.php');
        $content = ob_get_clean();
        if (isset($_SESSION['userId'])) {
            require_once('../views/layout/dashboard.php');
        } else {
            require_once('../views/layout/default.php');
        }
    }

    public function goTo(string $location = '/'): void
    {
        header('location: ' . $location);
        exit;
    }
}
