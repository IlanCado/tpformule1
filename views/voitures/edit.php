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

    <input type="submit" value="Mettre à jour">
</form>
