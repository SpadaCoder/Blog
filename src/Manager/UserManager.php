<?php

namespace App\Manager;

use App\Entity\User;
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
        // Hacher le mot de passe
    $passwordHash = password_hash($userData['password'], PASSWORD_DEFAULT);
    $userData['password'] = $passwordHash;

        $sql = "
        INSERT INTO user (first_name, last_name, email, password, role,created) 
        VALUES (:first_name, :last_name, :email, :password, 'member', NOW())
        ";
        $stmt = $this->database->getConnection()->prepare($sql);
        $stmt->bindParam(':first_name', $userData['first_name']);
        $stmt->bindParam(':last_name', $userData['last_name']);
        $stmt->bindParam(':email', $userData['email']);
        $stmt->bindParam(':password', $userData['password']);
        $stmt->execute();
    }

    public function isValidUser(string $email, string $password): mixed
    {
        // Requête pour récupérer l'utilisateur en fonction de l'e-mail
        $sql = "SELECT * FROM user WHERE email = :email";
        $stmt = $this->database->getConnection()->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);
        
        // Vérifier si le mot de passe fourni correspond au mot de passe stocké
        if ($user !== false &&
            password_verify($password, $user['password'])) {
            return $user;
        } 
            
        return false;
    }

    public function getAdminEmails()
    {
        $sql = "SELECT email FROM user WHERE role = 'admin'";
        $stmt = $this->database->getConnection()->prepare($sql);
        $stmt->execute();
        $adminEmails = $stmt->fetchAll(\PDO::FETCH_COLUMN);
        return $adminEmails;
    }

}
