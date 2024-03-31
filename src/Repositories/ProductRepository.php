<?php

namespace App\Repositories;

use App\Config\Database;
use App\Entites\Product;

class ProductRepository
{
    private string $table = "public.products";

    public function __construct(private Database $database)
    {
    }

    public function findByAll(): array
    {
        $queryString = "SELECT
                            p.id,
                            p.name,
                            p.description,
                            p.price,
                            p.created_at,

                            t.name as product_type_name,

                            tax.name as tax_name,
                            tax.tax
                        FROM {$this->table} p
                        LEFT JOIN public.product_type t
                        on p.id_product_type = t.id
                        LEFT JOIN public.product_tax tax
                        on p.id_product_tax = tax.id
                        ORDER BY p.id DESC";

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

    public function getTotalProducts(): ?int
    {
        $queryString = "SELECT COUNT(id) FROM {$this->table}";
        $result = null;

        try {
            $statement = $this->database->getConnection()->prepare($queryString);
            $statement->execute();
            $result = $statement->fetchColumn();
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

        return $result;
    }

    public function create(array $data): bool
    {
        $queryString = "INSERT INTO {$this->table} (
                                name, 
                                description,
                                price, 
                                id_product_type, 
                                id_product_tax
                            ) VALUES (
                                :name,
                                :description,
                                :price,
                                :id_product_type,
                                :id_product_tax
                            )";

        $result = false;

        try {
            $stmt = $this->database
                ->getConnection()
                ->prepare($queryString);

            $stmt->bindValue(':name', $data['name'], \PDO::PARAM_STR);
            $stmt->bindValue(':description', $data['description'], \PDO::PARAM_STR);
            $stmt->bindValue(':price', $data['price'], \PDO::PARAM_INT);
            $stmt->bindValue(':id_product_type', $data['typeId'], \PDO::PARAM_INT);
            $stmt->bindValue(':id_product_tax', $data['taxId'], \PDO::PARAM_INT);

            $result = $stmt->execute();
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

        return $result;
    }
}
