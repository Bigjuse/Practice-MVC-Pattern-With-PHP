<?php

namespace App;

class Database
{
    public \PDO $pdo;

    public function __construct(array $config)
    {
        $db_driver = $config['db_driver'];
        $dsn = $config['dsn'];
        $db_name = $config['db_name'];
        $user = $config['db_user'];
        $password = $config['db_password'];


        $this->pdo = new \PDO($db_driver . ':host=' . $dsn . ';dbname=' . $db_name, $user, $password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function applyMigration()
    {

        $this->createMigrationTable();
        $apliedMigrations = $this->getAppliedMigrations();



        $files = scandir(Application::$ROOT_PATH . '/app/Migrations');

        $forApplyMigration = array_diff($files, $apliedMigrations);


        $newMigrations = [];

        foreach ($forApplyMigration as $migration) {
            if ($migration === '.' || $migration === '..') {
                continue;
            }
            $path = Application::$ROOT_PATH . '/app/Migrations/' . $migration;
            require $path;
            $class_name = pathinfo($migration, PATHINFO_FILENAME);

            $this->log("$migration migrating.....");
            $instance = new $class_name();
            $instance->up();
            $this->log("$migration successfully migrated.....");
            $newMigrations[] = $migration;
        }


        if (empty($newMigrations)) {
            $this->log("Nothing to migrate");
        } else {
            $this->saveMigration($newMigrations);
        }
    }
    public function createMigrationTable()
    {
        $this->pdo->exec("
        CREATE TABLE IF NOT EXISTS migrations(
          id INT AUTO_INCREMENT PRIMARY KEY,
          migration VARCHAR(255),
          created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP  
        )");
    }

    public function getAppliedMigrations()
    {
        $stmt = $this->pdo->prepare('SELECT migration FROM migrations');
        $stmt->execute();
        return  $stmt->fetchAll(\PDO::FETCH_COLUMN);
    }

    protected function saveMigration(array $migrations)
    {
        $str = implode(",", array_map(fn ($m) => "('$m')", $migrations));


        $sql = 'INSERT INTO migrations (migration) VALUES ' . $str . ';';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }

    private function log($message)
    {
        echo  "[ " . \Date('d-m-Y H:i a') . '] - ' . $message . PHP_EOL;
    }
}
