<?php 
require_once(__DIR__ . '/../../data.php' );

try
{
    $mysqlClient = new PDO('mysql:host=' . $dbServer . ';dbname=' . $dbBase . ';charset=utf8', $dbUser, $dbPassword);
    var_dump($mysqlClient);
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}