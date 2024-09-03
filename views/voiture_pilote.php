<?php include 'views/partials/header.php'; ?>

<h2>Liste des Pilotes et leurs Voitures associées</h2>

<div class="table-container"> <!-- Ajout de la div table-container -->
    <table>
        <thead>
            <tr>
                <th>Pilote</th>
                <th>Moteur de la Voiture</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($result as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['pilote_nom']) ?></td>
                    <td><?= htmlspecialchars($row['voiture_moteur']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

