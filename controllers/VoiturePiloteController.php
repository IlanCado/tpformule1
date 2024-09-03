<?php

require_once 'config/Database.php';

class VoiturePiloteController {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function index() {
        // Requête SQL pour réaliser la jointure entre les tables Pilote, Ecurie et Voiture
        $query = "
            SELECT p.nom AS pilote_nom, v.moteur AS voiture_moteur, v.poids AS voiture_poids, v.puissance AS voiture_puissance
            FROM pilotes p
            INNER JOIN ecuries e ON p.id_ecurie = e.id_ecurie
            INNER JOIN voitures v ON e.id_voiture = v.id_voiture
        ";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Charger la vue et passer les données
        require 'views/voiture_pilote.php';
    }
}
