<?php include 'views/partials/header.php'; ?>

<h2>Liste des Pilotes et leurs Voitures</h2>

<table border="1">
    <thead>
        <tr>
            <th>Pilote</th>
            <th>Voiture</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($result as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['pilote_nom']) ?></td>
                <td><?= htmlspecialchars($row['voiture_moteur'] ?? 'Pas de voiture') ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
