<?php

namespace App\Core;

class Database
{
    private $connection;

    public function __construct()
    {
        // Récupération des infos de connexion dans la BDD.
        include __DIR__.'/../../data.php';

        // Connexion à la base de données.
        try {
            $pdo = new \PDO("mysql:host=".$dbServer."; dbname=" . $dbBase, $dbUser, $dbPassword);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->connection = $pdo;
        } catch (\PDOException $e) {
            throw new \Exception("Erreur de connexion : " . $e->getMessage());
        }
    }

    // Lancement de la connexion.
    public function getConnection()
    {
        return $this->connection;
    }
}
