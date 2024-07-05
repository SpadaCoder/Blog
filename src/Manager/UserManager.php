<?php

namespace App\Manager;

use App\Entity\User;
use App\Core\Database;

class UserManager
{

    private $database; // La connexion à la base de données.


    /**
     * Constructeur de la classe UserManager.
     * Initialise la connexion à la base de données.
     */
    public function __construct()
    {
        $this->database = new Database;

    }


    /**
     * Crée un nouvel utilisateur dans la base de données.
     *
     * @param array $userData Les données de l'utilisateur à insérer.
     *                       Doit contenir 'first_name', 'last_name', 'email', 'password'.
     * @return void
     */
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


    /**
     * Vérifie si un utilisateur avec l'email et le mot de passe donnés existe et est valide.
     *
     * @param string $email L'email de l'utilisateur à vérifier.
     * @param string $password Le mot de passe de l'utilisateur à vérifier.
     * @return mixed Retourne les informations de l'utilisateur s'il est valide, sinon false.
     */
    public function isValidUser(string $email, string $password): mixed
    {
        // Requête pour récupérer l'utilisateur en fonction de l'e-mail
        $sql = "SELECT * FROM user WHERE email = :email";
        $stmt = $this->database->getConnection()->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        // Vérifier si le mot de passe fourni correspond au mot de passe stocké
        if (
            $user !== false &&
            password_verify($password, $user['password'])
        ) {
            return $user;
        }

        return false;
    }


    /**
     * Récupère les adresses email des administrateurs.
     *
     * @return array Un tableau contenant les adresses email des administrateurs.
     */
    public function getAdminEmails()
    {
        $sql = "SELECT email FROM user WHERE role = 'admin'";
        $stmt = $this->database->getConnection()->prepare($sql);
        $stmt->execute();
        $adminEmails = $stmt->fetchAll(\PDO::FETCH_COLUMN);
        return $adminEmails;
    }

    public function getUserById(int $id)
    {
        $sql = "SELECT * FROM user WHERE id = " . $id;
        $stmt = $this->database->getConnection()->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();
        foreach ($data as $datum) {
            $user = new User();
            $user->setId($datum['id']);
            $user->setFirstName($datum['first_name']);
            $user->setLastName($datum['last_name']);
            $user->setEmail($datum['email']);
            return $user;
        }
        return null;

    }

}
