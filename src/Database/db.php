<?php 
require_once(__DIR__ . '/../../data.php' );

try {
    $pdo = new PDO("mysql:host=" . $dbServer . "; dbname=" . $dbBase, $dbUser, $dbPassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    exit();
}