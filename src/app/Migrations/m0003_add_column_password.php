<?php

use App\Application;

class m0003_add_column_password
{

    public function up()
    {
        $db = Application::$app->db->pdo;
        $sql = 'ALTER TABLE users ADD COLUMN password VARCHAR(255) NOT NULL';
        $stmt = $db->prepare($sql);
        $stmt->execute();
    }

    public function down()
    {
    }
}
