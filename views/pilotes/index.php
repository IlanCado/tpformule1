<?php include 'views/partials/header.php'; ?>

<h2>Liste des pilotes</h2>

<a href="index.php?controller=pilote&action=create" class="button-add">Ajouter un pilote</a>

<ul>
    <?php foreach ($pilotes as $pilote): ?>
        <li>
            <?= htmlspecialchars($pilote['numero']) ?> - <?= htmlspecialchars($pilote['nom']) ?> - <?= htmlspecialchars($pilote['nationalite']) ?> - <?= htmlspecialchars($pilote['age']) ?>
            <a href="index.php?controller=pilote&action=edit&id=<?= $pilote['id_pilote'] ?>">Modifier</a>
            <a href="index.php?controller=pilote&action=delete&id=<?= $pilote['id_pilote'] ?>">Supprimer</a>
        </li>
    <?php endforeach; ?>
</ul>
