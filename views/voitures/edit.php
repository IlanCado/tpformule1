<?php include 'views/partials/header.php'; ?>
<?php
// views/voitures/edit.php

// Assurez-vous que les données de la voiture sont chargées avant d'afficher le formulaire.
if (!isset($voiture)) {
    echo "Données de la voiture non disponibles.";
    exit;
}
?>

<h2>Modifier la voiture</h2>

<form action="index.php?controller=voiture&action=edit&id=<?= htmlspecialchars($voiture->getIdVoiture()) ?>" method="POST">
    <label for="poids">Poids</label>
    <input type="text" name="poids" id="poids" value="<?= htmlspecialchars($voiture->getPoids()) ?>" required><br>

    <label for="puissance">Puissance</label>
    <input type="text" name="puissance" id="puissance" value="<?= htmlspecialchars($voiture->getPuissance()) ?>" required><br>

    <label for="moteur">Moteur</label>
    <input type="text" name="moteur" id="moteur" value="<?= htmlspecialchars($voiture->getMoteur()) ?>" required><br>
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
    <!-- Bouton pour soumettre les modifications -->
    <input type="submit" value="Mettre à jour">
</form>
