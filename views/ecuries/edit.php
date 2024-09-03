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

<form action="index.php?controller=ecurie&action=edit&id=<?= htmlspecialchars($ecurie['id_ecurie']) ?>" method="POST">
    <label for="nom">Nom</label>
    <input type="text" name="nom" id="nom" value="<?= htmlspecialchars($ecurie['nom']) ?>" required><br>

    <label for="pays">Pays</label>
    <input type="text" name="pays" id="pays" value="<?= htmlspecialchars($ecurie['pays']) ?>" required><br>

    <label for="sponsor">Sponsor</label>
    <input type="text" name="sponsor" id="sponsor" value="<?= htmlspecialchars($ecurie['sponsor']) ?>"><br>

    

    <!-- Bouton pour soumettre les modifications -->
    <input type="submit" value="Mettre à jour">
</form>
