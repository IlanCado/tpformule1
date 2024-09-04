<?php

require_once 'models/Pilote.php';
require_once 'models/Voiture.php';

class PiloteController {

    // Méthode pour afficher la liste des pilotes
    public function index() {
        $pilote = new Pilote();
        $result = $pilote->read();  
        $pilotes = $result->fetchAll(PDO::FETCH_ASSOC);
        require 'views/pilotes/index.php';
    }

    // Méthode pour créer un nouveau pilote
    public function create() {
        $voiture = new Voiture();
        $voitures = $voiture->read()->fetchAll(PDO::FETCH_ASSOC);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $pilote = new Pilote();
            $pilote->setNumero($_POST['numero']);
            $pilote->setNom($_POST['nom']);
            $pilote->setIdEcurie($_POST['id_ecurie']);
            $pilote->setNationalite($_POST['nationalite']);
            $pilote->setAge($_POST['age']);
            $pilote->setIdVoiture($_POST['id_voiture']);  

            // Gestion de l'upload de la photo
            if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
                $filename = basename($_FILES['photo']['name']);
                $filepath = 'uploads/' . $filename;
                move_uploaded_file($_FILES['photo']['tmp_name'], $filepath);
                $pilote->setPhoto($filename);
            }

            if ($pilote->create()) {
                header("Location: index.php?controller=pilote&action=index");
            }
        }

        require 'views/pilotes/create.php';
    }

    // Méthode pour éditer un pilote existant
    public function edit() {
        $pilote = new Pilote();
        $voiture = new Voiture();
        $voitures = $voiture->read()->fetchAll(PDO::FETCH_ASSOC);

        if (isset($_GET['id'])) {
            $pilote->setIdPilote($_GET['id']);

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $pilote->setNumero($_POST['numero']);
                $pilote->setNom($_POST['nom']);
                $pilote->setIdEcurie($_POST['id_ecurie']);
                $pilote->setNationalite($_POST['nationalite']);
                $pilote->setAge($_POST['age']);
                $pilote->setIdVoiture($_POST['id_voiture']);

                // Gestion de l'upload de la photo
                if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
                    $filename = basename($_FILES['photo']['name']);
                    $filepath = 'uploads/' . $filename;
                    move_uploaded_file($_FILES['photo']['tmp_name'], $filepath);
                    $pilote->setPhoto($filename);
                }

                if ($pilote->update()) {
                    header("Location: index.php?controller=pilote&action=index");
                    exit();
                } else {
                    echo "Erreur lors de la mise à jour du pilote.";
                }
            } else {
                $data = $pilote->readSingle();
                if ($data) {
                    require 'views/pilotes/edit.php';
                } else {
                    echo "Pilote non trouvé.";
                }
            }
        }
    }

    // Méthode pour supprimer un pilote
    public function delete() {
        $pilote = new Pilote();
        if (isset($_GET['id'])) {
            $pilote->setIdPilote($_GET['id']);
            if ($pilote->delete()) {
                header("Location: index.php?controller=pilote&action=index");
            } else {
                echo "Erreur lors de la suppression du pilote";
            }
        }
    }
}
