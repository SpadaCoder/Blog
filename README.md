# OpenClassrooms - Projet 5 - Créez votre premier blog en PHP

## Présentation
Voici le dépôt Git de SpadaCoder, mon portfolio de projets.  
Ce projet est le cinquième projet de la formation Développeur d'application - PHP/Symfony d'OpenClassrooms.  
Il s'agit de créer un blog en PHP, sans framework, en utilisant une base de données MySQL.  
Il est personnalisable, et il est possible de créer des articles, des commentaires, des utilisateurs, etc.

## Installation
Tout d'abord, vous devez cloner le dépôt GitHub sur votre machine locale.
Ouvrez votre terminal ou invite de commande et utilisez la commande git clone suivie de l'URL du dépôt GitHub :
```bash
git clone https://github.com/SpadaCoder/Blog
```

## Base de données
Par défaut, l'application utilise une base de données MySQL dénommée 'db', accessible à un utilisateur 'blog_w' dont le mot de passe est 'password'.
Vous devez créer un fichier dénommé data.php avec les information suivantes :
```bash
$dbServer = 'localhost';
$dbUser = 'blog_w';
$dbPassword = 'password';
$dbBase = 'mydb';
```

## Configuration
Une fois installé, vous pouvez accéder à l'application via votre navigateur web.
Vous pouvez vous connecter et accéder à l'administration avec les identifiants suivants :

```bash
E-mail :  admin@mail.com
Mot de passe : Admin2024+
```
