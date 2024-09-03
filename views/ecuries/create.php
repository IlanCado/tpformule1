<?php include 'views/partials/header.php'; ?>
<?php
// views/ecuries/create.php
?>

<h2>Ajouter une nouvelle écurie</h2>

<form action="index.php?controller=ecurie&action=create" method="POST">
    <label for="nom">Nom</label>
    <input type="text" name="nom" id="nom" required><br>

    <label for="pays">Pays</label>
    <input type="text" name="pays" id="pays" required><br>

    <label for="sponsor">Sponsor</label>
    <input type="text" name="sponsor" id="sponsor"><br>

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
            echo '<option value="' . htmlspecialchars($voiture['id_voiture']) . '">' . htmlspecialchars($voiture['moteur']) . '</option>';
        }
        ?>
    </select><br>

    <input type="submit" value="Ajouter">
</form>
