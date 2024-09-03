<?php

require_once 'config/Database.php';

class Pilote {
    private $conn;
    private $table_name = "pilotes";

    public $id_pilote;
    public $numero;
    public $nom;
    public $id_ecurie;
    public $nationalite;
    public $age;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

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
            return $row;
        }

        return false;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET numero=:numero, nom=:nom, id_ecurie=:id_ecurie, nationalite=:nationalite, age=:age";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":numero", $this->numero);
        $stmt->bindParam(":nom", $this->nom);
        $stmt->bindParam(":id_ecurie", $this->id_ecurie);
        $stmt->bindParam(":nationalite", $this->nationalite);
        $stmt->bindParam(":age", $this->age);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET numero = :numero, nom = :nom, id_ecurie = :id_ecurie, nationalite = :nationalite, age = :age
                  WHERE id_pilote = :id_pilote";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':numero', $this->numero);
        $stmt->bindParam(':nom', $this->nom);
        $stmt->bindParam(':id_ecurie', $this->id_ecurie);
        $stmt->bindParam(':nationalite', $this->nationalite);
        $stmt->bindParam(':age', $this->age);
        $stmt->bindParam(':id_pilote', $this->id_pilote);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

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
