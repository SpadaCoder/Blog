<?php

namespace App\Manager;

use App\Core\Database;

class UserManager
{
    private $database;
    public function __construct()
    {
        $this->database = new Database;
    }
    public function createUser($userData)
    {
        $sql = "
        INSERT INTO user (first_name, last_name, email, password, role) 
        VALUES (:first_name, :last_name, :email, :password, 'member')
        ";
        $stmt = $this->database->getConnection()->prepare($sql);
        $stmt->bindParam(':first_name', $userData['first_name']);
        $stmt->bindParam(':last_name', $userData['last_name']);
        $stmt->bindParam(':email', $userData['email']);
        $stmt->bindParam(':password', $userData['password']);
        $stmt->execute();
    }
}