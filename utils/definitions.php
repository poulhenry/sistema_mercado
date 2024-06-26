<?php

use App\Config\Database;

return [
    Database::class => function () {
        return new Database(
            host: $_ENV['DB_HOST'],
            database: $_ENV['DB_NAME'],
            user: $_ENV['DB_USER'],
            password: $_ENV['DB_PASS']
        );
    }
];
