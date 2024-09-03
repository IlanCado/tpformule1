<?php

require_once 'models/Voiture.php';

class VoitureController {

    public function index() {
        $voiture = new Voiture();
        $result = $voiture->read();
        $voitures = $result->fetchAll(PDO::FETCH_ASSOC);
        require 'views/voitures/index.php';
    }

    public function create() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $voiture = new Voiture();
            $voiture->poids = $_POST['poids'];
            $voiture->puissance = $_POST['puissance'];
            $voiture->moteur = $_POST['moteur'];

            if ($voiture->create()) {
                header("Location: index.php?controller=voiture&action=index");
            }
        }

        require 'views/voitures/create.php';
    }

    public function edit() {
        $voiture = new Voiture();

        if (isset($_GET['id'])) {
            $voiture->id_voiture = $_GET['id'];

            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $data = $voiture->readSingle();
                if ($data) {
                    $voiture = $data;
                    require 'views/voitures/edit.php';
                } else {
                    echo "Voiture non trouvée";
                }
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $voiture->poids = $_POST['poids'];
                $voiture->puissance = $_POST['puissance'];
                $voiture->moteur = $_POST['moteur'];

                if ($voiture->update()) {
                    header("Location: index.php?controller=voiture&action=index");
                } else {
                    echo "Erreur lors de la mise à jour de la voiture";
                }
            }
        }
    }

    public function delete() {
        $voiture = new Voiture();
        if (isset($_GET['id'])) {
            $voiture->id_voiture = $_GET['id'];
            if ($voiture->delete()) {
                header("Location: index.php?controller=voiture&action=index");
            } else {
                echo "Erreur lors de la suppression de la voiture";
            }
        }
    }
}
