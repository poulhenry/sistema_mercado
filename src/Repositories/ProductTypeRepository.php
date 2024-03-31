<?php

namespace App\Repositories;

use App\Config\Database;

class ProductTypeRepository
{
    private string $table = 'public.product_type';

    public function __construct(private Database $database)
    {
    }

    public function findAll(): array
    {
        $queryString = "SELECT 
                            a.id,
                            a.name,
                            b.id AS tax_id,
                            b.name AS tax_name,
                            b.tax
                        FROM {$this->table} a
                        LEFT JOIN public.product_tax b
                        ON a.id_product_tax = b.id";

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
        $queryString = "INSERT INTO {$this->table} (
                            name, 
                            id_product_tax
                        ) VALUES (
                            :name, 
                            :id_product_tax
                        )";

        $result = false;

        try {
            $stmt = $this->database
                ->getConnection()
                ->prepare($queryString);

            $stmt->bindValue(':name', $data['name'], \PDO::PARAM_STR);
            $stmt->bindValue(':id_product_tax', $data['taxId'], \PDO::PARAM_INT);

            $result = $stmt->execute();
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

        return $result;
    }
}
