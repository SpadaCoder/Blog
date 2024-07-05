<?php

namespace App\Entity;

class User
{

    private int $id; // L'identifiant de l'utilisateur.

    private string $firstName; // Le prénom de l'utilisateur.

    private string $lastName; // Le nom de famille de l'utilisateur.

    private string $email; // L'adresse email de l'utilisateur.

    private string $password; // Le mot de passe de l'utilisateur.


    /**
     * Obtient l'identifiant de l'utilisateur.
     *
     * @return int L'identifiant de l'utilisateur.
     */
    public function getId(): int
    {
        return $this->id;
    }


    /**
     * Définit l'identifiant de l'utilisateur.
     *
     * @param int $id L'identifiant de l'utilisateur.
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }


    /**
     * Obtient le prénom de l'utilisateur.
     *
     * @return string Le prénom de l'utilisateur.
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }


    /**
     * Définit le prénom de l'utilisateur.
     *
     * @param string $firstName Le prénom de l'utilisateur.
     * @return void
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    
    /**
     * Obtient le nom de famille de l'utilisateur.
     *
     * @return string Le nom de famille de l'utilisateur.
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }


    /**
     * Définit le nom de famille de l'utilisateur.
     *
     * @param string $lastName Le nom de famille de l'utilisateur.
     * @return void
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    
    /**
     * Obtient l'adresse email de l'utilisateur.
     *
     * @return string L'adresse email de l'utilisateur.
     */
    public function getEmail(): string
    {
        return $this->email;
    }


    /**
     * Définit l'adresse email de l'utilisateur.
     *
     * @param string $email L'adresse email de l'utilisateur.
     * @return void
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }


    /**
     * Obtient le mot de passe de l'utilisateur.
     *
     * @return string Le mot de passe de l'utilisateur.
     */
    public function getPassword(): string
    {
        return $this->password;
    }


    /**
     * Définit le mot de passe de l'utilisateur.
     *
     * @param string $password Le mot de passe de l'utilisateur.
     * @return void
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

}

