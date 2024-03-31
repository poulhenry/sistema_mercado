<?php

namespace App\Repositories;

use App\Config\Database;
use App\Entites\ProductTax;

class ProductTaxRepository
{
    private string $table = 'public.product_tax';

    public function __construct(private Database $database)
    {
    }

    public function findAll()
    {
        $queryString = "SELECT 
                            id, 
                            name, 
                            tax
                        FROM {$this->table}";

        $result = [];

        try {
            $stmt = $this->database
                ->getConnection()
                ->prepare($queryString);

            $stmt->execute();

            $result = $stmt->fetchAll();
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

        return $result;
    }

    public function create(array $data): bool
    {
        $queryString = "INSERT INTO {$this->table} (NAME, TAX) VALUES (:NAME, :TAX)";

        $result = false;

        try {
            $stmt = $this->database
                ->getConnection()
                ->prepare($queryString);

            $stmt->bindValue(':NAME', $data['name'], \PDO::PARAM_STR);
            $stmt->bindValue(':TAX', $data['tax'], \PDO::PARAM_INT);

            $result = $stmt->execute();
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

        return $result;
    }
}
