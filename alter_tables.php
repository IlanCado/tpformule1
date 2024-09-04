<?php

// Informations de connexion
$host = 'localhost';
$username = 'root';
$password = '';

// Créer une connexion PDO
try {
    $conn = new PDO("mysql:host=$host", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Sélectionner la base de données
    $conn->exec("USE tpformule1");

    // Alter table 'voitures' pour ajouter la colonne 'photo'
    $sql = "ALTER TABLE voitures ADD photo VARCHAR(255)";
    $conn->exec($sql);
    echo "Colonne 'photo' ajoutée à la table 'voitures'.<br>";

    // Alter table 'ecuries' pour ajouter la colonne 'blason'
    $sql = "ALTER TABLE ecuries ADD blason VARCHAR(255)";
    $conn->exec($sql);
    echo "Colonne 'blason' ajoutée à la table 'ecuries'.<br>";

    // Alter table 'pilotes' pour ajouter la colonne 'photo'
    $sql = "ALTER TABLE pilotes ADD photo VARCHAR(255)";
    $conn->exec($sql);
    echo "Colonne 'photo' ajoutée à la table 'pilotes'.<br>";

} catch(PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

// Fermer la connexion
$conn = null;
?>
