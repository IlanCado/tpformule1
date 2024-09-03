<?php include 'views/partials/header.php'; ?>
<?php
// views/pilotes/edit.php
?>

<h2>Modifier le pilote</h2>

<form action="index.php?controller=pilote&action=edit&id=<?= htmlspecialchars($pilote->id_pilote) ?>" method="POST">
    <label for="numero">Numéro</label>
    <input type="text" name="numero" id="numero" value="<?= htmlspecialchars($pilote->numero) ?>" required><br>

    <label for="nom">Nom</label>
    <input type="text" name="nom" id="nom" value="<?= htmlspecialchars($pilote->nom) ?>" required><br>

    <label for="id_ecurie">Écurie</label>
    <input type="text" name="id_ecurie" id="id_ecurie" value="<?= htmlspecialchars($pilote->id_ecurie) ?>" required><br>

    <label for="nationalite">Nationalité</label>
    <input type="text" name="nationalite" id="nationalite" value="<?= htmlspecialchars($pilote->nationalite) ?>" required><br>

    <label for="age">Âge</label>
    <input type="number" name="age" id="age" value="<?= htmlspecialchars($pilote->age) ?>" required><br>

    <input type="submit" value="Mettre à jour">
</form>
