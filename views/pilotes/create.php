<?php include 'views/partials/header.php'; ?>
<?php
// views/pilotes/create.php
?>

<h2>Ajouter un nouveau pilote</h2>

<form action="index.php?controller=pilote&action=create" method="POST" enctype="multipart/form-data">
    <label for="numero">Numéro</label>
    <input type="text" name="numero" id="numero" required><br>

    <label for="nom">Nom</label>
    <input type="text" name="nom" id="nom" required><br>

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

    <label for="id_voiture">Voiture</label>
    <select name="id_voiture" id="id_voiture" required>
        <option value="">Sélectionnez une voiture</option>
        <?php
        // Charger les voitures disponibles depuis la base de données
        $query = "SELECT id_voiture, moteur FROM voitures";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $voitures = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($voitures as $voiture) {
            echo '<option value="' . htmlspecialchars($voiture['id_voiture']) . '">' . htmlspecialchars($voiture['moteur']) . '</option>';
        }
        ?>
    </select><br>

    <label for="nationalite">Nationalité</label>
    <input type="text" name="nationalite" id="nationalite" required><br>

    <label for="age">Âge</label>
    <input type="number" name="age" id="age" required><br>

    <label for="photo">Photo</label>
    <input type="file" name="photo" id="photo"><br>

    <input type="submit" value="Ajouter">
</form>
