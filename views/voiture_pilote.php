<?php include 'views/partials/header.php'; ?>

<h2>Liste des Pilotes et leurs Voitures</h2>

<table border="1">
    <thead>
        <tr>
            <th>Pilote</th>
            <th>Voiture</th>
            <th>Écurie</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($result as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['pilote_nom']) ?></td>
                <td><?= htmlspecialchars($row['voiture_moteur']) ?></td>
                <td><?= htmlspecialchars($row['ecurie_nom']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
