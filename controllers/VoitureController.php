<?php

require_once 'models/Voiture.php';

class VoitureController {

    // Méthode pour afficher la liste des voitures
    public function index() {
        $voiture = new Voiture();
        $result = $voiture->read();  
        $voitures = $result->fetchAll(PDO::FETCH_ASSOC);
        require 'views/voitures/index.php';
    }

    // Méthode pour créer une nouvelle voiture
    public function create() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $voiture = new Voiture();
            $voiture->setPoids($_POST['poids']);  
            $voiture->setPuissance($_POST['puissance']);  
            $voiture->setMoteur($_POST['moteur']);  

            // Gestion de l'upload de la photo
            if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
                $filename = basename($_FILES['photo']['name']);
                $filepath = 'uploads/' . $filename;
                move_uploaded_file($_FILES['photo']['tmp_name'], $filepath);
                $voiture->setPhoto($filename);
            }

            if ($voiture->create()) {
                header("Location: index.php?controller=voiture&action=index");
            }
        }

        require 'views/voitures/create.php';
    }

    // Méthode pour éditer une voiture existante
    public function edit() {
        $voiture = new Voiture();
    
        if (isset($_GET['id'])) {
            $voiture->setIdVoiture($_GET['id']);

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $voiture->setPoids($_POST['poids']);
                $voiture->setPuissance($_POST['puissance']);
                $voiture->setMoteur($_POST['moteur']);

                // Gestion de l'upload de la photo
                if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
                    $filename = basename($_FILES['photo']['name']);
                    $filepath = 'uploads/' . $filename;
                    move_uploaded_file($_FILES['photo']['tmp_name'], $filepath);
                    $voiture->setPhoto($filename);
                }

                if ($voiture->update()) {
                    header("Location: index.php?controller=voiture&action=index");
                    exit();
                } else {
                    echo "Erreur lors de la mise à jour de la voiture.";
                }
            } else {
                $data = $voiture->readSingle();
                if ($data) {
                    require 'views/voitures/edit.php';
                } else {
                    echo "Voiture non trouvée.";
                }
            }
        } else {
            echo "ID de la voiture manquant.";
        }
    }

    // Méthode pour supprimer une voiture
    public function delete() {
        $voiture = new Voiture();
        if (isset($_GET['id'])) {
            $voiture->setIdVoiture($_GET['id']);
            if ($voiture->delete()) {
                header("Location: index.php?controller=voiture&action=index");
            } else {
                echo "Erreur lors de la suppression de la voiture";
            }
        }
    }
}
