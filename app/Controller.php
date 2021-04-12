<?php

namespace App;

abstract class Controller
{
    public function loadmodel($model)
    {
        $modelPath = 'Models\\' . $model;
        $this->$model = new $modelPath;
    }

    public function render($file, $data = [])
    {
        $controller = str_replace(['Controllers\\', 'Controller'], '', get_class($this));

        extract($data);
        ob_start();
        require_once('../views/' . strtolower($controller) . '/' . $file . '.php');
        $content = ob_get_clean();
        if (isset($_SESSION['userID'])) {
            require_once('../views/layout/dashboard.php');
        } else {
            require_once('../views/layout/default.php');
        }
    }

    public function goHome()
    {
        header('location: /');
        exit;
    }
}
