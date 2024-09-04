<?php include 'views/partials/header.php'; ?>
<?php
// views/ecuries/create.php
?>

<h2>Ajouter une nouvelle écurie</h2>

<form action="index.php?controller=ecurie&action=create" method="POST" enctype="multipart/form-data">
    <label for="nom">Nom</label>
    <input type="text" name="nom" id="nom" required><br>

    <label for="pays">Pays</label>
    <input type="text" name="pays" id="pays" required><br>

    <label for="sponsor">Sponsor</label>
    <input type="text" name="sponsor" id="sponsor"><br>

    <label for="photo">Blason</label>
    <input type="file" name="blason" id="blason"><br>

    <input type="submit" value="Ajouter">
</form>
