<?php

// Informations de connexion
$host = 'localhost';
$username = 'root';
$password = '';

// Créer une connexion PDO
try {
    $conn = new PDO("mysql:host=$host", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Créer la base de données
    $sql = "CREATE DATABASE IF NOT EXISTS tpformule1";
    $conn->exec($sql);
    echo "Base de données 'tpformule1' créée avec succès.<br>";

    // Sélectionner la base de données
    $conn->exec("USE tpformule1");

    // Créer la table 'voitures'
    $sql = "CREATE TABLE IF NOT EXISTS voitures (
        id_voiture INT AUTO_INCREMENT PRIMARY KEY,
        poids INT NOT NULL,
        puissance INT NOT NULL,
        moteur VARCHAR(100) NOT NULL
    )";
    $conn->exec($sql);
    echo "Table 'voitures' créée avec succès.<br>";

    // Créer la table 'ecuries'
    $sql = "CREATE TABLE IF NOT EXISTS ecuries (
        id_ecurie INT AUTO_INCREMENT PRIMARY KEY,
        nom VARCHAR(100) NOT NULL,
        pays VARCHAR(100) NOT NULL,
        sponsor VARCHAR(100),
        id_voiture INT,
        FOREIGN KEY (id_voiture) REFERENCES voitures(id_voiture) ON DELETE SET NULL
    )";
    $conn->exec($sql);
    echo "Table 'ecuries' créée avec succès.<br>";

    // Créer la table 'pilotes'
    $sql = "CREATE TABLE IF NOT EXISTS pilotes (
        id_pilote INT AUTO_INCREMENT PRIMARY KEY,
        numero INT NOT NULL,
        nom VARCHAR(100) NOT NULL,
        id_ecurie INT,
        nationalite VARCHAR(100) NOT NULL,
        age INT NOT NULL,
        FOREIGN KEY (id_ecurie) REFERENCES ecuries(id_ecurie) ON DELETE SET NULL
    )";
    $conn->exec($sql);
    echo "Table 'pilotes' créée avec succès.<br>";

    // Insérer des données initiales dans la table 'voitures'
    $sql = "INSERT INTO voitures (poids, puissance, moteur) VALUES 
            (740, 1000, 'V6 Turbo Hybrid'),
            (728, 1050, 'V8 Turbo'),
            (750, 950, 'V6 Turbo')";
    $conn->exec($sql);
    echo "Données initiales insérées dans la table 'voitures'.<br>";

    // Insérer des données initiales dans la table 'ecuries'
    $sql = "INSERT INTO ecuries (nom, pays, sponsor, id_voiture) VALUES 
            ('Ferrari', 'Italie', 'Shell', 1), 
            ('Mercedes', 'Allemagne', 'Petronas', 2), 
            ('Red Bull', 'Autriche', 'Red Bull', 3)";
    $conn->exec($sql);
    echo "Données initiales insérées dans la table 'ecuries'.<br>";

    // Insérer des données initiales dans la table 'pilotes'
    $sql = "INSERT INTO pilotes (numero, nom, id_ecurie, nationalite, age) VALUES 
            (7, 'Schumacher', 1, 'Allemand', 32),
            (44, 'Hamilton', 2, 'Britannique', 36),
            (33, 'Verstappen', 3, 'Néerlandais', 24)";
    $conn->exec($sql);
    echo "Données initiales insérées dans la table 'pilotes'.<br>";

} catch(PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

// Fermer la connexion
$conn = null;
?>
