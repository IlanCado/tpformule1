<?php

require_once 'models/Voiture.php';

class VoitureController {

    // Méthode pour afficher la liste des voitures
    public function index() {
        $voiture = new Voiture();
        $result = $voiture->read();  // Appel de la méthode read() du modèle Voiture
        $voitures = $result->fetchAll(PDO::FETCH_ASSOC);
        require 'views/voitures/index.php';  // Charge la vue pour afficher les voitures
    }

    // Méthode pour créer une nouvelle voiture
    public function create() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $voiture = new Voiture();
            $voiture->setPoids($_POST['poids']);  // Utilisation du setter
            $voiture->setPuissance($_POST['puissance']);  // Utilisation du setter
            $voiture->setMoteur($_POST['moteur']);  // Utilisation du setter

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
            $voiture->setIdVoiture($_GET['id']);  // Utilisation du setter
    
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Mise à jour des données de la voiture
                $voiture->setPoids($_POST['poids']);
                $voiture->setPuissance($_POST['puissance']);
                $voiture->setMoteur($_POST['moteur']);
    
                if ($voiture->update()) {
                    header("Location: index.php?controller=voiture&action=index");
                    exit();  // Assurez-vous que l'exécution s'arrête après la redirection
                } else {
                    echo "Erreur lors de la mise à jour de la voiture.";
                }
            } else {
                // Affichage des données actuelles de la voiture dans le formulaire
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
    

    // Méthode pour supprimer une voiture (ajoutez-la si nécessaire)
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
