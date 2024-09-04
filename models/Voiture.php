<?php

require_once 'config/Database.php';

class Voiture {
    private $conn;
    private $table_name = "voitures";

    private $id_voiture;
    private $poids;
    private $puissance;
    private $moteur;
    private $photo;  // Ajouter le champ pour la photo

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Getters
    public function getIdVoiture() {
        return $this->id_voiture;
    }

    public function getPoids() {
        return $this->poids;
    }

    public function getPuissance() {
        return $this->puissance;
    }

    public function getMoteur() {
        return $this->moteur;
    }

    public function getPhoto() {  // Getter pour la photo
        return $this->photo;
    }

    // Setters
    public function setIdVoiture($id_voiture) {
        $this->id_voiture = $id_voiture;
    }

    public function setPoids($poids) {
        $this->poids = $poids;
    }

    public function setPuissance($puissance) {
        $this->puissance = $puissance;
    }

    public function setMoteur($moteur) {
        $this->moteur = $moteur;
    }

    public function setPhoto($photo) {  // Setter pour la photo
        $this->photo = $photo;
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
            $this->photo = $row['photo'];  // Ajout de la photo
            return $row;
        }

        return false;
    }

    // Créer une nouvelle voiture
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET poids=:poids, puissance=:puissance, moteur=:moteur, photo=:photo";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":poids", $this->poids);
        $stmt->bindParam(":puissance", $this->puissance);
        $stmt->bindParam(":moteur", $this->moteur);
        $stmt->bindParam(":photo", $this->photo);  // Lier la photo

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Mettre à jour une voiture existante
    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET poids = :poids, puissance = :puissance, moteur = :moteur, photo = :photo
                  WHERE id_voiture = :id_voiture";
    
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(':poids', $this->poids);
        $stmt->bindParam(':puissance', $this->puissance);
        $stmt->bindParam(':moteur', $this->moteur);
        $stmt->bindParam(':photo', $this->photo);  // Mise à jour de la photo
        $stmt->bindParam(':id_voiture', $this->id_voiture);
    
        if ($stmt->execute()) {
            return true;
        } else {
            var_dump($stmt->errorInfo());  // Debug : Affiche les erreurs SQL
            return false;
        }
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
