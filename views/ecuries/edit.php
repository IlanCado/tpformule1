<?php include 'views/partials/header.php'; ?>
<?php
// views/ecuries/edit.php

// Assurez-vous que les données de l'écurie sont chargées avant d'afficher le formulaire.
if (!isset($ecurie)) {
    echo "Données de l'écurie non disponibles.";
    exit;
}
?>

<h2>Modifier l'écurie</h2>

<form action="index.php?controller=ecurie&action=edit&id=<?= htmlspecialchars($ecurie->getIdEcurie()) ?>" method="POST" enctype="multipart/form-data">
    <label for="nom">Nom</label>
    <input type="text" name="nom" id="nom" value="<?= htmlspecialchars($ecurie->getNom()) ?>" required><br>

    <label for="pays">Pays</label>
    <input type="text" name="pays" id="pays" value="<?= htmlspecialchars($ecurie->getPays()) ?>" required><br>

    <label for="sponsor">Sponsor</label>
    <input type="text" name="sponsor" id="sponsor" value="<?= htmlspecialchars($ecurie->getSponsor()) ?>"><br>

    <label for="photo">Blason</label>
    <input type="file" name="blason" id="blason"><br>

    <!-- Bouton pour soumettre les modifications -->
    <input type="submit" value="Mettre à jour">
</form>
