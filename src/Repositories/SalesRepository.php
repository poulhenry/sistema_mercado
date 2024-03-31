<?php

namespace App\Repositories;

use App\Config\Database;

class SalesRepository
{
    private string $table = 'public.sales';

    public function __construct(private Database $database)
    {
    }

    public function getAllSales(): array
    {
        $queryString = "SELECT
                            id,
                            created_at,
                            id_product,
                            quantity,
                            price_total
                        FROM {$this->table}";

        $result = [];

        try {
            $statement = $this->database->getConnection()->prepare($queryString);
            $statement->execute();
            $result = $statement->fetchAll();
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

        return $result;
    }

    public function getAllRecentSales(): array
    {
        $queryString = "SELECT 
                            A.id,
                            B.name,
                            C.name AS product_type,
                            A.quantity,
                            A.created_at,
                            A.price_total
                        FROM {$this->table} A
                        LEFT JOIN public.products B
                        ON A.id_product = B.id
                        LEFT JOIN public.product_type C
                        ON B.id_product_type = C.id
                        ORDER BY A.created_at DESC";

        $result = [];

        try {
            $statement = $this->database->getConnection()->prepare($queryString);
            $statement->execute();

            $result = $statement->fetchAll();
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

        return $result;
    }

    public function getTotalRevenue(): ?float
    {
        $queryString = "SELECT SUM(price_total) FROM {$this->table}";
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

    public function getTotalSales(): ?int
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

    public function getAverageTicket(): ?float
    {
        $queryString = "SELECT
                            ROUND(SUM(price_total) / COUNT(id), 2) AS average_ticket
                        FROM {$this->table}";
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

    public function getSalesVolumePerDay(): array
    {
        $queryString = "SELECT 
                            SUM(quantity) as quantity, 
                            TO_CHAR(created_at, 'YYYY-MM-DD') as date
                        FROM {$this->table}
                        GROUP BY to_char(created_at, 'YYYY-MM-DD')
                        order by date";

        $result = [];

        try {
            $statement = $this->database->getConnection()->prepare($queryString);
            $statement->execute();
            $result = $statement->fetchAll();
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

        return $result;
    }

    public function create(array $data): bool
    {
        $queryString = "INSERT INTO {$this->table} (
                            id_product,
                            quantity,
                            price_total
                        ) VALUES (
                            :id_product,
                            :quantity,
                            :price_total
                        )";

        $result = false;

        foreach ($data as $value) {
            try {
                $statement = $this->database->getConnection()->prepare($queryString);

                $statement->bindValue(':id_product', $value['productId'], \PDO::PARAM_INT);
                $statement->bindValue(':quantity', $value['quantity'], \PDO::PARAM_INT);
                $statement->bindValue(':price_total', $value['priceTotal'], \PDO::PARAM_INT);

                $result = $statement->execute();
            } catch (\PDOException $e) {
                echo $e->getMessage();
            }
        }

        return $result;
    }
}
