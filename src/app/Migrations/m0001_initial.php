<?php

use App\Application;

class m0001_initial
{
    private $db;
    public function up()
    {
        $this->db = Application::$app->db;
        $sql = 'CREATE TABLE users(
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL UNIQUE,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );';
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->execute();
    }

    public function down()
    {
        $this->db = Application::$app->db;
        $sql = 'DROP TABLE users;';
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->execute();
    }
}
