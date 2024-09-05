Gestion Formule 1
Ce projet est une application web simple qui permet de gérer les écuries, les pilotes, et les voitures d'une compétition de Formule 1. Il est développé en PHP avec une base de données MySQL, et inclut les fonctionnalités suivantes :

Création, modification, et suppression des écuries, pilotes, et voitures.
Association des pilotes avec des voitures et des écuries.
Téléchargement et affichage des photos pour les pilotes et les voitures, ainsi que des blasons pour les écuries.
Affichage des informations sous forme de tableaux interactifs sur la page d'accueil.
Prérequis
Avant de commencer, assurez-vous d'avoir les éléments suivants installés :

PHP (version 7.4 ou supérieure)
Serveur web (Apache, Nginx, etc.)
MySQL ou MariaDB
Composer (optionnel si vous utilisez des packages supplémentaires)
Installation
1. Cloner le projet
Clonez ce dépôt dans votre serveur local (ou hôte distant) :

bash
Copier le code
git clone https://github.com/ton-utilisateur/gestion-formule1.git
2. Configurer la base de données
Créer la base de données MySQL
Accédez à votre serveur MySQL et créez la base de données tpformule1 :

sql
Copier le code
CREATE DATABASE tpformule1;
Exécuter le script SQL
Vous pouvez ensuite exécuter le script SQL pour créer les tables nécessaires, ou exécuter le fichier create_database.php :

bash
Copier le code
php create_database.php
Cela va créer les tables ecuries, pilotes, voitures ainsi que leurs relations et ajouter quelques données initiales.

3. Configurer les informations de connexion à la base de données
Dans le fichier config/Database.php, configurez vos informations de connexion MySQL :

php
Copier le code
class Database {
    private $host = "localhost";
    private $db_name = "tpformule1";
    private $username = "root"; // Votre nom d'utilisateur MySQL
    private $password = ""; // Votre mot de passe MySQL
    public $conn;

    // Obtenir la connexion à la base de données
    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Erreur de connexion à la base de données : " . $exception->getMessage();
        }
        return $this->conn;
    }
}
4. Configuration du serveur local
Placez le projet dans le répertoire accessible par votre serveur web (par exemple, htdocs pour XAMPP ou WAMP).
Lancer le serveur avec php -S localhost:8000 si vous utilisez un serveur PHP intégré.
Si vous utilisez XAMPP ou WAMP, accédez à l'URL suivante dans votre navigateur :

arduino
Copier le code
http://localhost/tpformule1/
Fonctionnalités
Gestion des Écuries
Ajout, modification et suppression des écuries.
Téléchargement de blasons pour chaque écurie.
Gestion des Pilotes
Ajout, modification et suppression des pilotes.
Association des pilotes avec une écurie et une voiture.
Téléchargement de photos pour chaque pilote.
Gestion des Voitures
Ajout, modification et suppression des voitures.
Téléchargement de photos pour chaque voiture.
Vue Pilote et Voiture
Affichage des pilotes avec leur voiture associée dans une vue dédiée.
Structure du Projet
bash
Copier le code
├── config/
│   └── Database.php    # Connexion à la base de données
├── controllers/
│   ├── EcurieController.php
│   ├── PiloteController.php
│   └── VoitureController.php
├── models/
│   ├── Ecurie.php      # Modèle pour les écuries
│   ├── Pilote.php      # Modèle pour les pilotes
│   └── Voiture.php     # Modèle pour les voitures
├── uploads/            # Dossier où les photos et blasons sont stockés
├── views/
│   ├── ecuries/
│   ├── pilotes/
│   ├── voitures/
│   └── partials/
├── index.php           # Point d'entrée de l'application
└── create_database.php # Script pour créer la base de données et insérer des données initiales
Ajout de Photos et Blasons
Les images peuvent être ajoutées pour les écuries (blasons), les pilotes et les voitures. Les fichiers images doivent être téléchargés dans le répertoire /uploads.

Format des images
Les images doivent être au format .jpg, .jpeg, .png.
La taille maximale des fichiers peut être définie dans le fichier PHP php.ini avec upload_max_filesize et post_max_size.
Fonctionnalités futures
Ajout de validations supplémentaires lors de l'upload d'images (taille, format, etc.).
Gestion des utilisateurs avec authentification pour gérer les écuries, pilotes et voitures.
Contribuer
Les contributions sont les bienvenues ! N'hésitez pas à soumettre des pull requests ou à signaler des problèmes via la page Issues.

Licence
Ce projet est sous licence MIT. Voir le fichier LICENSE pour plus de détails.
