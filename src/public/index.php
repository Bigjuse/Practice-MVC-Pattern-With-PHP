<?php

use App\Application;



require_once dirname(__DIR__) . '/vendor/autoload.php';


$app = new Application(dirname(__DIR__));

$app->router->get('/', 'home')
    ->get('/contact', 'contact');


$app->run();
