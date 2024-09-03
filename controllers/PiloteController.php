<?php

require_once 'models/Pilote.php';

class PiloteController {

    // Méthode pour afficher la liste des pilotes
    public function index() {
        $pilote = new Pilote();
        $result = $pilote->read();  // Appel de la méthode read() du modèle Pilote
        $pilotes = $result->fetchAll(PDO::FETCH_ASSOC);
        require 'views/pilotes/index.php';  // Charge la vue pour afficher les pilotes
    }

    // Méthode pour créer un nouveau pilote
    public function create() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $pilote = new Pilote();
            $pilote->setNumero($_POST['numero']);  // Utilisation du setter
            $pilote->setNom($_POST['nom']);  // Utilisation du setter
            $pilote->setIdEcurie($_POST['id_ecurie']);  // Utilisation du setter
            $pilote->setNationalite($_POST['nationalite']);  // Utilisation du setter
            $pilote->setAge($_POST['age']);  // Utilisation du setter

            if ($pilote->create()) {
                header("Location: index.php?controller=pilote&action=index");
            }
        }

        require 'views/pilotes/create.php';
    }

    // Méthode pour éditer un pilote existant
    public function edit() {
        $pilote = new Pilote();
    
        if (isset($_GET['id'])) {
            $pilote->setIdPilote($_GET['id']);  // Utilisation du setter
    
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Mise à jour du pilote
                $pilote->setNumero($_POST['numero']);
                $pilote->setNom($_POST['nom']);
                $pilote->setIdEcurie($_POST['id_ecurie']);
                $pilote->setNationalite($_POST['nationalite']);
                $pilote->setAge($_POST['age']);
    
                if ($pilote->update()) {
                    header("Location: index.php?controller=pilote&action=index");
                    exit();  // Assurez-vous que le script s'arrête ici après la redirection
                } else {
                    echo "Erreur lors de la mise à jour du pilote.";
                }
            } else {
                // Affichage du formulaire de modification
                $data = $pilote->readSingle();
                if ($data) {
                    require 'views/pilotes/edit.php';  // Charge la vue d'édition
                } else {
                    echo "Pilote non trouvé.";
                }
            }
        } else {
            echo "ID du pilote manquant.";
        }
    }
    
    // Méthode pour supprimer un pilote (ajoutez-la si nécessaire)
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
