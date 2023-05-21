<?php

use App\Application;
use App\Controllers\AuthController;
use App\Controllers\ContactController;
use App\Controllers\HomeController;

require_once dirname(__DIR__) . '/vendor/autoload.php';


$app = new Application(dirname(__DIR__));

$app->router

    ->get('/login', [AuthController::class, 'login'])
    ->post('/login', [AuthController::class, 'login'])
    ->get('/register', [AuthController::class, 'register'])
    ->post('/register', [AuthController::class, 'register'])
    ->get('/', [HomeController::class, 'index'])
    ->get('/contact', [ContactController::class, 'index'])
    ->post('/contact', [ContactController::class, 'store']);


$app->run();
