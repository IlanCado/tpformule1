<?php include 'views/partials/header.php'; ?>
<?php
// views/pilotes/edit.php

// Assurez-vous que les données du pilote sont chargées avant d'afficher le formulaire.
if (!isset($pilote)) {
    echo "Données du pilote non disponibles.";
    exit;
}
?>

<h2>Modifier le pilote</h2>

<form action="index.php?controller=pilote&action=edit&id=<?= htmlspecialchars($pilote->getIdPilote()) ?>" method="POST">
    <label for="numero">Numéro</label>
    <input type="text" name="numero" id="numero" value="<?= htmlspecialchars($pilote->getNumero()) ?>" required><br>

    <label for="nom">Nom</label>
    <input type="text" name="nom" id="nom" value="<?= htmlspecialchars($pilote->getNom()) ?>" required><br>

    <label for="id_ecurie">Écurie</label>
    <select name="id_ecurie" id="id_ecurie" required>
        <option value="">Sélectionnez une écurie</option>
        <?php
        // Charger les écuries disponibles depuis la base de données
        $database = new Database();
        $conn = $database->getConnection();
        $query = "SELECT id_ecurie, nom FROM ecuries";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $ecuries = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($ecuries as $ecurie) {
            echo '<option value="' . htmlspecialchars($ecurie['id_ecurie']) . '">' . htmlspecialchars($ecurie['nom']) . '</option>';
        }
        ?>
    </select><br>
    <label for="nationalite">Nationalité</label>
    <input type="text" name="nationalite" id="nationalite" value="<?= htmlspecialchars($pilote->getNationalite()) ?>" required><br>

    <label for="age">Âge</label>
    <input type="number" name="age" id="age" value="<?= htmlspecialchars($pilote->getAge()) ?>" required><br>

    <!-- Bouton pour soumettre les modifications -->
    <input type="submit" value="Mettre à jour">
</form>
