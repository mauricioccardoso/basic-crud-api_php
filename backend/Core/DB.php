<?php

namespace App\Core;

use App\Core\Exceptions\NotFoundException;
use PDO;

class DB
{
    private static PDO $pdo;

    public function __construct(array $config = [])
    {
        $defaultConfig = [
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        try {
            self::$pdo = new PDO(
                $_ENV['DB_CONNECTION'] . ':host=' . $_ENV['DB_HOST']. ';dbname='.$_ENV['DB_DATABASE'],
                $_ENV['DB_USERNAME'],
                $_ENV['DB_PASSWORD'],
                $config ?? $defaultConfig
            );

            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            throw new $e;
        }

    }

    public function prepare($sql): \PDOStatement
    {
        return self::$pdo->prepare($sql);
    }

}