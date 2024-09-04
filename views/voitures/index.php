<?php include 'views/partials/header.php'; ?>

<h2>Liste des voitures</h2>

<a href="index.php?controller=voiture&action=create" class="button-add">Ajouter une voiture</a>

<ul>
    <?php if (!empty($voitures)): ?>
        <?php foreach ($voitures as $voiture): ?>
            <li>
                Voiture ID: <?= htmlspecialchars($voiture['id_voiture']) ?> - Poids: <?= htmlspecialchars($voiture['poids']) ?> kg - Puissance: <?= htmlspecialchars($voiture['puissance']) ?> ch - Moteur: <?= htmlspecialchars($voiture['moteur']) ?>
                <a href="index.php?controller=voiture&action=edit&id=<?= $voiture['id_voiture'] ?>">Modifier</a>
                <a href="index.php?controller=voiture&action=delete&id=<?= $voiture['id_voiture'] ?>">Supprimer</a>

                <!-- Affichage de la photo de la voiture -->
                <?php if (!empty($voiture['photo'])): ?>
                    <br><img src="uploads/<?= htmlspecialchars($voiture['photo']) ?>" alt="Photo de la voiture" style="width: 100px;">
                <?php else: ?>
                    <br>Pas de photo
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    <?php else: ?>
        <li>Aucune voiture trouvée.</li>
    <?php endif; ?>
</ul>
