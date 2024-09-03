
<?php

class Database {
    // Propriétés pour stocker les informations de connexion
    private $host = "localhost"; // Nom d'hôte pour la base de données
    private $db_name = "tpformule1"; // Nom de la base de données
    private $username = "root"; // Nom d'utilisateur pour la base de données
    private $password = ""; // Mot de passe pour la base de données
    public $conn; // Propriété pour stocker la connexion

    // Méthode pour obtenir une connexion à la base de données
    public function getConnection() {
        $this->conn = null;

        try {
            // Tentative de connexion à la base de données avec PDO
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8"); // Définir le jeu de caractères en UTF-8 pour éviter les problèmes d'encodage
        } catch(PDOException $exception) {
            // En cas d'erreur, afficher un message d'erreur
            echo "Connection error: " . $exception->getMessage();
        }

        // Retourne la connexion pour qu'elle puisse être utilisée par d'autres parties de l'application
        return $this->conn;
    }
}
