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

    <!-- Section pour les écuries -->
    <section id="ecuries">
        <h2>Les Écuries</h2>
        <ul>
            <?php if (!empty($ecuries)): ?>
                <?php foreach ($ecuries as $ecurie): ?>
                    <li>
                        <?= htmlspecialchars($ecurie['nom']) ?> - <?= htmlspecialchars($ecurie['pays']) ?> - <?= htmlspecialchars($ecurie['sponsor']) ?>
                        <!-- Vérifiez et affichez le blason si disponible -->
                        <?php if (!empty($ecurie['blason'])): ?>
                            <img src="uploads/<?= htmlspecialchars($ecurie['blason']) ?>" alt="Blason de <?= htmlspecialchars($ecurie['nom']) ?>" width="100">
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>Aucune écurie trouvée.</li>
            <?php endif; ?>
        </ul>
    </section>

    <!-- Section pour les pilotes -->
    <section id="pilotes">
        <h2>Les Pilotes</h2>
        <ul>
            <?php foreach ($pilotes as $pilote): ?>
                <li>
                    <?= htmlspecialchars($pilote['numero']) ?> - <?= htmlspecialchars($pilote['nom']) ?> - <?= htmlspecialchars($pilote['nationalite']) ?> - <?= htmlspecialchars($pilote['age']) ?>
                    <!-- Vérifiez et affichez la photo si disponible -->
                    <?php if (!empty($pilote['photo'])): ?>
                        <img src="uploads/<?= htmlspecialchars($pilote['photo']) ?>" alt="Photo de <?= htmlspecialchars($pilote['nom']) ?>" width="100">
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>

    <!-- Section pour les voitures -->
    <section id="voitures">
        <h2>Les Voitures</h2>
        <ul>
            <?php if (!empty($voitures)): ?>
                <?php foreach ($voitures as $voiture): ?>
                    <li>
                        Poids: <?= htmlspecialchars($voiture['poids']) ?> kg - Puissance: <?= htmlspecialchars($voiture['puissance']) ?> chevaux - Moteur: <?= htmlspecialchars($voiture['moteur']) ?>
                        <!-- Vérifiez et affichez la photo si disponible -->
                        <?php if (!empty($voiture['photo'])): ?>
                            <img src="uploads/<?= htmlspecialchars($voiture['photo']) ?>" alt="Photo de la voiture <?= htmlspecialchars($voiture['moteur']) ?>" width="100">
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>Aucune voiture trouvée.</li>
            <?php endif; ?>
        </ul>
    </section>

</body>
</html>
