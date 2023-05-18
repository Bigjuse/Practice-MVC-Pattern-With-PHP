<?php

namespace App;

class Router
{

    public function __construct(protected Request $request)
    {
    }
    protected array $routes = [];
    public function get(string $path, callable|string $callback): static
    {
        $this->routes['get'][$path] = $callback;

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

        return call_user_func($callback);
    }

    private function resolveView($view)
    {
        $layoutContents = $this->getLayoutContents();
        $viewContents = $this->getViewContents($view);
        return str_replace('{{content}}', $viewContents, $layoutContents);
    }

    private function getLayoutContents()
    {
        ob_start();
        include Application::$ROOT_PATH . "/app/Views/layouts/layout.php";
        return ob_get_clean();
    }

    private function getViewContents($view)
    {
        ob_start();
        include Application::$ROOT_PATH . "/app/Views/{$view}.php";
        return ob_get_clean();
    }
}
