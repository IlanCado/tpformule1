<?php

require_once 'config/Database.php';

class VoiturePiloteController {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function index() {
        $query = "
            SELECT p.nom AS pilote_nom, v.moteur AS voiture_moteur
            FROM pilotes p
            LEFT JOIN voitures v ON p.id_voiture = v.id_voiture
        ";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Charger la vue et passer les données
        require 'views/voiture_pilote.php';
    }
}
