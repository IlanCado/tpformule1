<?php include 'views/partials/header.php'; ?>

<h2>Ajouter une nouvelle voiture</h2>

<form action="index.php?controller=voiture&action=create" method="POST" enctype="multipart/form-data">
    <label for="poids">Poids (en kg)</label>
    <input type="number" name="poids" id="poids" required><br>

    <label for="puissance">Puissance (en ch)</label>
    <input type="number" name="puissance" id="puissance" required><br>

    <label for="moteur">Moteur</label>
    <input type="text" name="moteur" id="moteur" required><br>
    
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

<label for="photo">Photo</label>
<input type="file" name="photo" id="photo"><br>

    </select><br>

    <input type="submit" value="Ajouter">
</form>
