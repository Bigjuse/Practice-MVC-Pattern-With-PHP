<?php

namespace App;


class Controller
{
    public string $layout = 'layout';

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }
    public function render($view, array $params = [])
    {
        echo Application::$app->router->resolveView($view, $params);
    }
}
