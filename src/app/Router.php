<?php

namespace App;

class Router
{

    public function __construct(protected Request $request)
    {
    }
    protected array $routes = [];
    public function get(string $path, callable|string|array $callback): static
    {
        $this->routes['get'][$path] = $callback;

        return $this;
    }

    public function post(string $path, callable|string|array $callback): static
    {
        $this->routes['post'][$path] = $callback;
        return $this;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;


        if (!$callback) {
            return  'Route Not Found';
        }
        if (is_string($callback)) {
            return $this->resolveView($callback);
        }

        if (is_array($callback)) {
            Application::$app->controller = $callback[0] = new $callback[0];
        }

        return call_user_func($callback, $this->request);
    }

    public function resolveView($view, array $params = [])
    {

        $layoutContents = $this->getLayoutContents();
        $viewContents = $this->getViewContents($view, $params);
        return str_replace('{{content}}', $viewContents, $layoutContents);
    }

    private function getLayoutContents()
    {
        $layout = Application::$app->controller->layout;
        ob_start();
        include Application::$ROOT_PATH . "/app/Views/layouts/{$layout}.php";
        return ob_get_clean();
    }

    private function getViewContents($view, array $params = [])
    {

        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include Application::$ROOT_PATH . "/app/Views/{$view}.php";
        return ob_get_clean();
    }
}
