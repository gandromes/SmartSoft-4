<?php
namespace App\Models;

use PDO;
use PDOException;

class Model
{
    /**
     * @var PDO
     */
    protected $pdo;

    public function __construct()
    {
        $this->pdo = $this->getConnection();
    }

    protected function getConnection()
    {
        static $connection = null;

        if ($connection instanceof PDO) {
            return $connection;
        }

        $host     = '127.0.0.1';
        $dbname   = 'smartsoft_test';
        $username = 'root';
        $password = '!12A34bAb!';

        try {
            $connection = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password, [
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
            ]);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Ошибка подключения к БД: ' . $e->getMessage());
        }

        return $connection;
    }
}

?>


