<?php

require_once 'models/Ecurie.php';

class EcurieController {

    // Méthode pour afficher la liste des écuries
    public function index() {
        $ecurie = new Ecurie();
        $result = $ecurie->read();  
        $ecuries = $result->fetchAll(PDO::FETCH_ASSOC);
        require 'views/ecuries/index.php';
    }

    // Méthode pour créer une nouvelle écurie
    public function create() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $ecurie = new Ecurie();
            $ecurie->setNom($_POST['nom']);
            $ecurie->setPays($_POST['pays']);
            $ecurie->setSponsor($_POST['sponsor']);
            $ecurie->setIdVoiture($_POST['id_voiture']);

            // Gestion de l'upload du blason
            if (isset($_FILES['blason']) && $_FILES['blason']['error'] == 0) {
                $filename = basename($_FILES['blason']['name']);
                $filepath = 'uploads/' . $filename;
                move_uploaded_file($_FILES['blason']['tmp_name'], $filepath);
                $ecurie->setBlason($filename);
            }

            if ($ecurie->create()) {
                header("Location: index.php?controller=ecurie&action=index");
            }
        }

        require 'views/ecuries/create.php';
    }

    // Méthode pour éditer une écurie existante
    public function edit() {
        $ecurie = new Ecurie();

        if (isset($_GET['id'])) {
            $ecurie->setIdEcurie($_GET['id']);

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $ecurie->setNom($_POST['nom']);
                $ecurie->setPays($_POST['pays']);
                $ecurie->setSponsor($_POST['sponsor']);
                $ecurie->setIdVoiture($_POST['id_voiture']);

                // Gestion de l'upload du blason
                if (isset($_FILES['blason']) && $_FILES['blason']['error'] == 0) {
                    $filename = basename($_FILES['blason']['name']);
                    $filepath = 'uploads/' . $filename;
                    move_uploaded_file($_FILES['blason']['tmp_name'], $filepath);
                    $ecurie->setBlason($filename);
                }

                if ($ecurie->update()) {
                    header("Location: index.php?controller=ecurie&action=index");
                } else {
                    echo "Erreur lors de la mise à jour de l'écurie";
                }
            } else {
                $data = $ecurie->readSingle();
                if ($data) {
                    require 'views/ecuries/edit.php';
                } else {
                    echo "Écurie non trouvée";
                }
            }
        }
    }

    // Méthode pour supprimer une écurie
    public function delete() {
        $ecurie = new Ecurie();
        if (isset($_GET['id'])) {
            $ecurie->setIdEcurie($_GET['id']);
            if ($ecurie->delete()) {
                header("Location: index.php?controller=ecurie&action=index");
            } else {
                echo "Erreur lors de la suppression de l'écurie";
            }
        }
    }
}
