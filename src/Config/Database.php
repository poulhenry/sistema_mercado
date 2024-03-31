<?php

namespace App\Config;

use PDO;

class Database
{
    protected PDO $conn;

    public function __construct(
        private string $host,
        private string $database,
        private string $user,
        private string $password
    ) {
    }

    public function getConnection(): PDO
    {
        try {
            $dsn = "pgsql:host={$this->host};port=5432;dbname={$this->database};";

            $this->conn = new PDO($dsn, $this->user, $this->password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);

            return $this->conn;
        } catch (\PDOException $e) {
            die('Connection failed: ' . $e->getMessage());
        }
    }
}
