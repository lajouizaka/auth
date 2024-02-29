<?php

namespace Core\database;

use Core\Support\Singleton;

class DB
{
    use Singleton;
    protected $conn = null;

    protected function __construct()
    {
        $this->conn = new \PDO("mysql:hostname=".DB_HOST.";dbname=".DB_NAME.";", DB_USER, DB_PASSWORD);
        $this->conn->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
    }

    public static function lastID(): int
    {
        return self::instance()->conn->lastInsertId();
    }

    public static function query(string $query): \PDOStatement
    {
        $conn = self::instance()->conn;
        return $conn->prepare($query);
    }

    public static function rawQuery(string $query): \PDOStatement
    {
        $conn = self::instance()->conn;
        return $conn->query($query);
    }
}
