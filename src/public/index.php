<?php

use App\Application;
use App\Controllers\AuthController;
use App\Controllers\ContactController;
use App\Controllers\HomeController;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config = [
    'db' => [
        'db_driver' => $_ENV['DB_DRIVER'],
        'dsn' => $_ENV['DSN'],
        'db_name' => $_ENV['DB_NAME'],
        'db_user' => $_ENV['DB_USER'],
        'db_password' => $_ENV['DB_PASSWORD'],
    ]
];




$app = new Application(dirname(__DIR__), $config);

$app->router

    ->post('/login', [AuthController::class, 'login'])
    ->get('/login', [AuthController::class, 'login'])
    ->get('/register', [AuthController::class, 'register'])
    ->post('/register', [AuthController::class, 'register'])
    ->get('/', [HomeController::class, 'index'])
    ->get('/contact', [ContactController::class, 'index'])
    ->post('/contact', [ContactController::class, 'store']);


$app->run();
