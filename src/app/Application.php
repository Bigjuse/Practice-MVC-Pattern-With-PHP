<?php

namespace App;

class Application
{
    public Router $router;
    public Request $request;

    public static Application $app;
    public Database $db;
    public static string $ROOT_PATH;
    public Controller $controller;
    public function __construct(string $root_path, array $config)
    {
        self::$app = $this;
        $this->request = new Request();
        $this->router = new Router($this->request);
        self::$ROOT_PATH = $root_path;
        $this->db = new Database($config['db']);
    }

    public function run()
    {
        echo $this->router->resolve();
    }
}
