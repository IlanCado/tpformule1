<?php

// Déterminer quel contrôleur et quelle action doivent être appelés
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'home'; // 'home' par défaut pour afficher l'accueil
$action = isset($_GET['action']) ? $_GET['action'] : 'index'; // Action 'index' par défaut

if ($controller === 'home') {
    // Si le contrôleur est 'home', charger directement la vue de la page d'accueil
    require 'views/home.php';
} else {
    // Vérifier si le contrôleur existe avant de tenter de le charger
    $controllerFile = 'controllers/' . ucfirst($controller) . 'Controller.php';
    
    if (file_exists($controllerFile)) {
        // Charger le fichier du contrôleur approprié
        require_once $controllerFile;

        // Construire le nom de la classe du contrôleur et créer une instance
        $controllerClassName = ucfirst($controller) . 'Controller';
        if (class_exists($controllerClassName)) {
            $controllerObject = new $controllerClassName();

            // Appeler la méthode d'action sur le contrôleur
            if (method_exists($controllerObject, $action)) {
                $controllerObject->$action();
            } else {
                echo "L'action '$action' n'existe pas dans le contrôleur '$controllerClassName'.";
            }
        } else {
            echo "Le contrôleur '$controllerClassName' n'existe pas.";
        }
    } else {
        echo "Le fichier du contrôleur '$controllerFile' est introuvable.";
    }
}
