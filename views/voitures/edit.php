<?php include 'views/partials/header.php'; ?>

<h2>Modifier la voiture</h2>

<?php
if (!isset($voiture)) {
    echo "Données de la voiture non disponibles.";
    exit;
}
?>

<form action="index.php?controller=voiture&action=edit&id=<?= htmlspecialchars($voiture['id_voiture']) ?>" method="POST">
    <label for="poids">Poids (en kg)</label>
    <input type="number" name="poids" id="poids" value="<?= htmlspecialchars($voiture['poids']) ?>" required><br>

    <label for="puissance">Puissance (en ch)</label>
    <input type="number" name="puissance" id="puissance" value="<?= htmlspecialchars($voiture['puissance']) ?>" required><br>

    <label for="moteur">Moteur</label>
    <input type="text" name="moteur" id="moteur" value="<?= htmlspecialchars($voiture['moteur']) ?>" required><br>

    <input type="submit" value="Mettre à jour">
</form>
