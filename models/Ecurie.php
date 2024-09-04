<?php

require_once 'config/Database.php';

class Ecurie {
    private $conn;
    private $table_name = "ecuries";

    private $id_ecurie;
    private $nom;
    private $pays;
    private $sponsor;
    private $id_voiture;
    private $blason;  // Ajouter le champ pour le blason

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Getters
    public function getIdEcurie() {
        return $this->id_ecurie;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPays() {
        return $this->pays;
    }

    public function getSponsor() {
        return $this->sponsor;
    }

    public function getIdVoiture() {
        return $this->id_voiture;
    }

    public function getBlason() {  // Getter pour le blason
        return $this->blason;
    }

    // Setters
    public function setIdEcurie($id_ecurie) {
        $this->id_ecurie = $id_ecurie;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setPays($pays) {
        $this->pays = $pays;
    }

    public function setSponsor($sponsor) {
        $this->sponsor = $sponsor;
    }

    public function setIdVoiture($id_voiture) {
        $this->id_voiture = $id_voiture;
    }

    public function setBlason($blason) {  // Setter pour le blason
        $this->blason = $blason;
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
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_ecurie', $this->id_ecurie);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->nom = $row['nom'];
            $this->pays = $row['pays'];
            $this->sponsor = $row['sponsor'];
            $this->id_voiture = $row['id_voiture'];
            $this->blason = $row['blason'];  // Ajout du blason
            return $row;
        }

        return false;
    }

    // Créer une nouvelle écurie
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET nom=:nom, pays=:pays, sponsor=:sponsor, id_voiture=:id_voiture, blason=:blason";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nom", $this->nom);
        $stmt->bindParam(":pays", $this->pays);
        $stmt->bindParam(":sponsor", $this->sponsor);
        $stmt->bindParam(":id_voiture", $this->id_voiture);
        $stmt->bindParam(":blason", $this->blason);  // Lier le blason

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Mettre à jour une écurie existante
    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET nom = :nom, pays = :pays, sponsor = :sponsor, id_voiture = :id_voiture, blason = :blason
                  WHERE id_ecurie = :id_ecurie";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nom', $this->nom);
        $stmt->bindParam(':pays', $this->pays);
        $stmt->bindParam(':sponsor', $this->sponsor);
        $stmt->bindParam(':id_voiture', $this->id_voiture);
        $stmt->bindParam(':blason', $this->blason);  // Mise à jour du blason
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
