<?php

namespace App;

class Application
{
    public Router $router;
    public Request $request;
    public static string $ROOT_PATH;
    public function __construct(string $root_path)
    {
        $this->request = new Request();
        $this->router = new Router($this->request);
        self::$ROOT_PATH = $root_path;
    }

    public function run()
    {
        echo $this->router->resolve();
    }
}
