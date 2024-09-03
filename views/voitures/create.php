<?php include 'views/partials/header.php'; ?>

<h2>Ajouter une nouvelle voiture</h2>

<form action="index.php?controller=voiture&action=create" method="POST">
    <label for="poids">Poids (en kg)</label>
    <input type="number" name="poids" id="poids" required><br>

    <label for="puissance">Puissance (en ch)</label>
    <input type="number" name="puissance" id="puissance" required><br>

    <label for="moteur">Moteur</label>
    <input type="text" name="moteur" id="moteur" required><br>

    <input type="submit" value="Ajouter">
</form>
