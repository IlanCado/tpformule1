<?php

require_once 'config/Database.php';

class Voiture {
    private $conn;
    private $table_name = "voitures";

    public $id_voiture;
    public $poids;
    public $puissance;
    public $moteur;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Lire toutes les voitures
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Lire une seule voiture par ID
    public function readSingle() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_voiture = :id_voiture LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_voiture', $this->id_voiture);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->poids = $row['poids'];
            $this->puissance = $row['puissance'];
            $this->moteur = $row['moteur'];
            return $row;
        }

        return false;
    }

    // Créer une nouvelle voiture
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET poids=:poids, puissance=:puissance, moteur=:moteur";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":poids", $this->poids);
        $stmt->bindParam(":puissance", $this->puissance);
        $stmt->bindParam(":moteur", $this->moteur);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Mettre à jour une voiture existante
    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET poids = :poids, puissance = :puissance, moteur = :moteur
                  WHERE id_voiture = :id_voiture";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':poids', $this->poids);
        $stmt->bindParam(':puissance', $this->puissance);
        $stmt->bindParam(':moteur', $this->moteur);
        $stmt->bindParam(':id_voiture', $this->id_voiture);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Supprimer une voiture
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_voiture = :id_voiture";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_voiture', $this->id_voiture);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
