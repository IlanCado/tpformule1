<?php

// Déterminer quel contrôleur et quelle action doivent être appelés
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'home'; // 'home' par défaut pour afficher l'accueil
$action = isset($_GET['action']) ? $_GET['action'] : 'index'; // Action 'index' par défaut

if ($controller === 'home') {
    // Si le contrôleur est 'home', charger directement la vue de la page d'accueil
    require 'views/home.php';
} else {
    // Charger le fichier du contrôleur approprié
    require_once 'controllers/' . ucfirst($controller) . 'Controller.php';

    // Construire le nom de la classe du contrôleur et créer une instance
    $controllerClassName = ucfirst($controller) . 'Controller';
    $controllerObject = new $controllerClassName();

    // Appeler la méthode d'action sur le contrôleur
    $controllerObject->$action();
}
