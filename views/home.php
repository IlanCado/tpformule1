<?php include 'views/partials/header.php'; ?>
<?php

// Charger les modèles
require_once 'models/Ecurie.php';
require_once 'models/Pilote.php';
require_once 'models/Voiture.php';

// Charger les données
$ecurieModel = new Ecurie();
$ecuries = $ecurieModel->read()->fetchAll(PDO::FETCH_ASSOC);

$piloteModel = new Pilote();
$pilotes = $piloteModel->read()->fetchAll(PDO::FETCH_ASSOC);

$voitureModel = new Voiture();
$voitures = $voitureModel->read()->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Gestion Formule 1</title>
</head>
<body>

    

    <section id="ecuries">
        <h2>Les Écuries</h2>
        <ul>
            <?php if (!empty($ecuries)): ?>
                <?php foreach ($ecuries as $ecurie): ?>
                    <li><?= htmlspecialchars($ecurie['nom']) ?> - <?= htmlspecialchars($ecurie['pays']) ?> - <?= htmlspecialchars($ecurie['sponsor']) ?></li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>Aucune écurie trouvée.</li>
            <?php endif; ?>
        </ul>
    </section>

    <section id="pilotes">
        <h2>Les Pilotes</h2>
        <ul>
            <?php foreach ($pilotes as $pilote): ?>
                <li><?= htmlspecialchars($pilote['numero']) ?> - <?= htmlspecialchars($pilote['nom']) ?> - <?= htmlspecialchars($pilote['nationalite']) ?> - <?= htmlspecialchars($pilote['age']) ?></li>
            <?php endforeach; ?>
        </ul>
    </section>

    <section id="voitures">
        <h2>Les Voitures</h2>
        <ul>
            <?php if (!empty($voitures)): ?>
                <?php foreach ($voitures as $voiture): ?>
                    <li>Poids: <?= htmlspecialchars($voiture['poids']) ?> kg - Puissance: <?= htmlspecialchars($voiture['puissance']) ?> chevaux - Moteur: <?= htmlspecialchars($voiture['moteur']) ?></li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>Aucune voiture trouvée.</li>
            <?php endif; ?>
        </ul>
    </section>

</body>
</html>
