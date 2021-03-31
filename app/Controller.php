<?php

abstract class Controller
{
    public function loadmodel($model)
    {
        require_once(ROOT . 'models/' . $model . '.php');
        $this->$model = new $model;
    }

    public function render($file, $data = [])
    {
        $controller = str_replace('Controller', '', get_class($this));

        extract($data);
        ob_start();
        require_once(ROOT . 'views/' . strtolower($controller) . '/' . $file . '.php');
        $content = ob_get_clean();
        require_once(ROOT . 'views/layout/default.php');
    }

    public function goHome()
    {
        header('location: /');
        exit;
    }
}
