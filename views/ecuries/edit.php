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

    <label for="id_voiture">Voiture</label>
    <select name="id_voiture" id="id_voiture" required>
        <option value="">Sélectionnez une voiture</option>
        <?php
        // Charger les voitures disponibles depuis la base de données
        $database = new Database();
        $conn = $database->getConnection();
        $query = "SELECT id_voiture, moteur FROM voitures";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $voitures = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($voitures as $voiture) {
            $selected = $voiture['id_voiture'] == $ecurie['id_voiture'] ? 'selected' : '';
            echo '<option value="' . htmlspecialchars($voiture['id_voiture']) . '" ' . $selected . '>' . htmlspecialchars($voiture['moteur']) . '</option>';
        }
        ?>
    </select><br>

    <!-- Bouton pour soumettre les modifications -->
    <input type="submit" value="Mettre à jour">
</form>
