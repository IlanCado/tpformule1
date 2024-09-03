<?php

require_once 'config/Database.php';

class Ecurie {
    private $conn;
    private $table_name = "ecuries";

    public $id_ecurie;
    public $nom;
    public $pays;
    public $sponsor;
    public $id_voiture;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Lire toutes les écuries
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Lire une seule écurie par ID
    public function readSingle() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_ecurie = :id_ecurie LIMIT 0,1";
        $stmt = $this->conn->prepare($query);  // Correction ici, ajout de $this->conn
        $stmt->bindParam(':id_ecurie', $this->id_ecurie);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->nom = $row['nom'];
            $this->pays = $row['pays'];
            $this->sponsor = $row['sponsor'];
            $this->id_voiture = $row['id_voiture'];
            return $row;
        }

        return false;
    }

    // Créer une nouvelle écurie
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET nom=:nom, pays=:pays, sponsor=:sponsor, id_voiture=:id_voiture";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nom", $this->nom);
        $stmt->bindParam(":pays", $this->pays);
        $stmt->bindParam(":sponsor", $this->sponsor);
        $stmt->bindParam(":id_voiture", $this->id_voiture);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Mettre à jour une écurie existante
    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET nom = :nom, pays = :pays, sponsor = :sponsor, id_voiture = :id_voiture
                  WHERE id_ecurie = :id_ecurie";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nom', $this->nom);
        $stmt->bindParam(':pays', $this->pays);
        $stmt->bindParam(':sponsor', $this->sponsor);
        $stmt->bindParam(':id_voiture', $this->id_voiture);
        $stmt->bindParam(':id_ecurie', $this->id_ecurie);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Supprimer une écurie
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_ecurie = :id_ecurie";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_ecurie', $this->id_ecurie);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
