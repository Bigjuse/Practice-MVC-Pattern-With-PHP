<?php

use App\Application;

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


$app->db->applyMigration();
