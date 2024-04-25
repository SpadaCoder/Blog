<?php 

namespace App\Core;

class Database 
{
    private $connection;

    public function __construct()
    {
        include(__DIR__ . '/../../data.php' );

        try {
            $pdo = new \PDO("mysql:host=" . $dbServer . "; dbname=" . $dbBase, $dbUser, $dbPassword);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->connection = $pdo;
        } catch (\PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
            exit();
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }
}