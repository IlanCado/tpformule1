<?php

require_once 'config/Database.php';

class Pilote {
    private $conn;
    private $table_name = "pilotes";

    private $id_pilote;
    private $numero;
    private $nom;
    private $id_ecurie;
    private $nationalite;
    private $age;
    private $id_voiture;
    private $photo;  // Ajouter le champ pour la photo

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Getters
    public function getIdPilote() {
        return $this->id_pilote;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getIdEcurie() {
        return $this->id_ecurie;
    }

    public function getNationalite() {
        return $this->nationalite;
    }

    public function getAge() {
        return $this->age;
    }

    public function getIdVoiture() {
        return $this->id_voiture;
    }

    public function getPhoto() {  // Getter pour la photo
        return $this->photo;
    }

    // Setters
    public function setIdPilote($id_pilote) {
        $this->id_pilote = $id_pilote;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setIdEcurie($id_ecurie) {
        $this->id_ecurie = $id_ecurie;
    }

    public function setNationalite($nationalite) {
        $this->nationalite = $nationalite;
    }

    public function setAge($age) {
        $this->age = $age;
    }

    public function setIdVoiture($id_voiture) {
        $this->id_voiture = $id_voiture;
    }

    public function setPhoto($photo) {  // Setter pour la photo
        $this->photo = $photo;
    }

    // Lire tous les pilotes
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Lire un seul pilote par ID
    public function readSingle() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_pilote = :id_pilote LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_pilote', $this->id_pilote);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->numero = $row['numero'];
            $this->nom = $row['nom'];
            $this->id_ecurie = $row['id_ecurie'];
            $this->nationalite = $row['nationalite'];
            $this->age = $row['age'];
            $this->id_voiture = $row['id_voiture'];  // Ajout de l'id_voiture
            $this->photo = $row['photo'];  // Ajout de la photo
            return $row;
        }

        return false;
    }

    // Créer un nouveau pilote
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET numero=:numero, nom=:nom, id_ecurie=:id_ecurie, nationalite=:nationalite, age=:age, id_voiture=:id_voiture, photo=:photo";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":numero", $this->numero);
        $stmt->bindParam(":nom", $this->nom);
        $stmt->bindParam(":id_ecurie", $this->id_ecurie);
        $stmt->bindParam(":nationalite", $this->nationalite);
        $stmt->bindParam(":age", $this->age);
        $stmt->bindParam(":id_voiture", $this->id_voiture);  // Ajout de l'id_voiture
        $stmt->bindParam(":photo", $this->photo);  // Lier la photo

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Mettre à jour un pilote existant
    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET numero = :numero, nom = :nom, id_ecurie = :id_ecurie, nationalite = :nationalite, age = :age, id_voiture = :id_voiture, photo = :photo
                  WHERE id_pilote = :id_pilote";
    
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(':numero', $this->numero);
        $stmt->bindParam(':nom', $this->nom);
        $stmt->bindParam(':id_ecurie', $this->id_ecurie);
        $stmt->bindParam(':nationalite', $this->nationalite);
        $stmt->bindParam(':age', $this->age);
        $stmt->bindParam(':id_voiture', $this->id_voiture);  // Ajout de l'id_voiture
        $stmt->bindParam(':photo', $this->photo);  // Mise à jour de la photo
        $stmt->bindParam(':id_pilote', $this->id_pilote);
    
        if ($stmt->execute()) {
            return true;
        } else {
            var_dump($stmt->errorInfo());  // Debug : Affiche les erreurs SQL
            return false;
        }
    }

    // Supprimer un pilote
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_pilote = :id_pilote";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_pilote', $this->id_pilote);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
