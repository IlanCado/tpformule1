<?php

require_once 'models/Pilote.php';

class PiloteController {

    public function index() {
        $pilote = new Pilote();
        $result = $pilote->read();
        $pilotes = $result->fetchAll(PDO::FETCH_ASSOC);
        require 'views/pilotes/index.php';
    }

    public function create() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $pilote = new Pilote();
            $pilote->nom = $_POST['nom'];
            $pilote->numero = $_POST['numero'];
            $pilote->id_ecurie = $_POST['id_ecurie'];
            $pilote->nationalite = $_POST['nationalite'];
            $pilote->age = $_POST['age'];

            if ($pilote->create()) {
                header("Location: index.php?controller=pilote&action=index");
            }
        }

        require 'views/pilotes/create.php';
    }

    public function edit() {
        $pilote = new Pilote();

        if (isset($_GET['id'])) {
            $pilote->id_pilote = $_GET['id'];

            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $data = $pilote->readSingle();
                if ($data) {
                    // Rendre les données accessibles dans la vue
                    require 'views/pilotes/edit.php';
                } else {
                    echo "Pilote non trouvé";
                }
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $pilote->nom = $_POST['nom'];
                $pilote->numero = $_POST['numero'];
                $pilote->id_ecurie = $_POST['id_ecurie'];
                $pilote->nationalite = $_POST['nationalite'];
                $pilote->age = $_POST['age'];

                if ($pilote->update()) {
                    header("Location: index.php?controller=pilote&action=index");
                } else {
                    echo "Erreur lors de la mise à jour du pilote";
                }
            }
        }
    }

    public function delete() {
        $pilote = new Pilote();
        if (isset($_GET['id'])) {
            $pilote->id_pilote = $_GET['id'];
            if ($pilote->delete()) {
                header("Location: index.php?controller=pilote&action=index");
            } else {
                echo "Erreur lors de la suppression du pilote";
            }
        }
    }
}
