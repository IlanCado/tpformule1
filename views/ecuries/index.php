<?php include 'views/partials/header.php'; ?>

<h2>Liste des écuries</h2>

<a href="index.php?controller=ecurie&action=create" class="button-add">Ajouter une écurie</a>

<ul>
    <?php foreach ($ecuries as $ecurie): ?>
        <li>
            <?= htmlspecialchars($ecurie['nom']) ?> - <?= htmlspecialchars($ecurie['pays']) ?> - <?= htmlspecialchars($ecurie['sponsor']) ?> 
            <a href="index.php?controller=ecurie&action=edit&id=<?= $ecurie['id_ecurie'] ?>">Modifier</a>
            <a href="index.php?controller=ecurie&action=delete&id=<?= $ecurie['id_ecurie'] ?>">Supprimer</a>

            <!-- Affichage du blason de l'écurie -->
            <?php if (!empty($ecurie['blason'])): ?>
                <br><img src="uploads/<?= htmlspecialchars($ecurie['blason']) ?>" alt="Blason de <?= htmlspecialchars($ecurie['nom']) ?>" style="width: 100px;">
            <?php else: ?>
                <br>Pas de blason
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
</ul>
