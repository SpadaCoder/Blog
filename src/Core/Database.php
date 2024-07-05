<?php

namespace App\Core;

class Database
{
    
    private $connection; // Connexion à la base de données.


    /**
     * Constructeur de la classe Database.
     * Initialise la connexion à la base de données en utilisant les informations de connexion fournies.
     *
     * @throws \Exception En cas d'erreur lors de la connexion à la base de données.
     */
    public function __construct()
    {
        // Récupération des infos de connexion dans la BDD.
        include __DIR__.'/../../data.php';

        // Connexion à la base de données.
        try {
            $pdo = new \PDO("mysql:host=".$dbServer."; dbname=".$dbBase, $dbUser, $dbPassword);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->connection = $pdo;
        } catch (\PDOException $e) {
            throw new \Exception("Erreur de connexion : ".$e->getMessage());
        }
    }


    /**
     * Récupère l'objet PDO représentant la connexion à la base de données.
     *
     * @return \PDO|null Objet PDO représentant la connexion, ou null si la connexion n'est pas établie.
     */
    // Lancement de la connexion.
    public function getConnection()
    {
        return $this->connection;
    }
}
