<?php

require_once 'models/Ecurie.php';

class EcurieController {

    // Méthode pour afficher la liste des écuries
    public function index() {
        $ecurie = new Ecurie();
        $result = $ecurie->read();  // Appel de la méthode read() du modèle Ecurie
        $ecuries = $result->fetchAll(PDO::FETCH_ASSOC);
        require 'views/ecuries/index.php';  // Charge la vue pour afficher les écuries
    }

    // Méthode pour créer une nouvelle écurie
    public function create() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $ecurie = new Ecurie();
            $ecurie->setNom($_POST['nom']);  // Utilisation du setter
            $ecurie->setPays($_POST['pays']);  // Utilisation du setter
            $ecurie->setSponsor($_POST['sponsor']);  // Utilisation du setter
            $ecurie->setIdVoiture($_POST['id_voiture']);  // Utilisation du setter

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
            $ecurie->setIdEcurie($_GET['id']);  // Utilisation du setter

            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $data = $ecurie->readSingle();
                if ($data) {
                    // Passer les données de l'écurie à la vue
                    require 'views/ecuries/edit.php';
                } else {
                    echo "Écurie non trouvée";
                }
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $ecurie->setNom($_POST['nom']);  // Utilisation du setter
                $ecurie->setPays($_POST['pays']);  // Utilisation du setter
                $ecurie->setSponsor($_POST['sponsor']);  // Utilisation du setter
                $ecurie->setIdVoiture($_POST['id_voiture']);  // Utilisation du setter

                if ($ecurie->update()) {
                    header("Location: index.php?controller=ecurie&action=index");
                } else {
                    echo "Erreur lors de la mise à jour de l'écurie";
                }
            }
        }
    }

    // Méthode pour supprimer une écurie (ajoutez-la si nécessaire)
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
