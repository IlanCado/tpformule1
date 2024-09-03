<?php

require_once 'models/Ecurie.php';

class EcurieController {

    public function index() {
        $ecurie = new Ecurie();
        $result = $ecurie->read();
        $ecuries = $result->fetchAll(PDO::FETCH_ASSOC);
        require 'views/ecuries/index.php';
    }

    public function create() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $ecurie = new Ecurie();
            $ecurie->nom = $_POST['nom'];
            $ecurie->pays = $_POST['pays'];
            $ecurie->sponsor = $_POST['sponsor'];
            $ecurie->id_voiture = $_POST['id_voiture'];

            if ($ecurie->create()) {
                header("Location: index.php?controller=ecurie&action=index");
            }
        }

        require 'views/ecuries/create.php';
    }

    public function edit() {
        $ecurie = new Ecurie();

        if (isset($_GET['id'])) {
            $ecurie->id_ecurie = $_GET['id'];

            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $data = $ecurie->readSingle();
                if ($data) {
                    // Passer les données de l'écurie à la vue
                    $ecurie = $data;  // Affectez les données récupérées à la variable $ecurie
                    require 'views/ecuries/edit.php';
                } else {
                    echo "Écurie non trouvée";
                }
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $ecurie->nom = $_POST['nom'];
                $ecurie->pays = $_POST['pays'];
                $ecurie->sponsor = $_POST['sponsor'];
                $ecurie->id_voiture = $_POST['id_voiture'];

                if ($ecurie->update()) {
                    header("Location: index.php?controller=ecurie&action=index");
                } else {
                    echo "Erreur lors de la mise à jour de l'écurie";
                }
            }
        }
    }

    public function delete() {
        $ecurie = new Ecurie();
        if (isset($_GET['id'])) {
            $ecurie->id_ecurie = $_GET['id'];
            if ($ecurie->delete()) {
                header("Location: index.php?controller=ecurie&action=index");
            } else {
                echo "Erreur lors de la suppression de l'écurie";
            }
        }
    }
}
