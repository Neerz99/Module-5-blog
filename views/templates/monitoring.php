<?php
/**
 * @var Article[] $articles
 **/
?>

<h2>Monitoring des articles</h2>

<div class="adminMonitoring">
    <form method="GET" action="index.php">
        <!-- Ajout de action caché car action ne peut contenir qu'une seule valeur -->
        <input type="hidden" name="action" value="monitoring">
        <label for="tri">Tri :</label>
        <select name="sortBy" id="tri">
            <option value="title">Trier par titre</option>
            <option value="vues">Trier par nombre de vues</option>
            <option value="commentaires">Trier par nombre de commentaires</option>
            <option value="date">Trier par date de publication</option>
        </select>

        <label for="ordre">Ordre: </label>
        <select name="order" id="ordre">
            <option value="asc">Ordre croissant</option>
            <option value="desc">Ordre décroissant</option>
        </select>

        <button class="triBtn" type="submit">Trier</button>
    </form>

    <div class="labels">
        <div class="titre"><strong>Titre</strong></div>
        <div class="vues"><strong>Vues</strong></div>
        <div class="commentaires"><strong>Commentaires</strong></div>
        <div class="date"><strong>Date de publication</strong></div>
    </div>

    <?php foreach ($articles as $index => $article) {
        $bgColor = $index % 2 === 0 ? 'var(--commentPaleColor)' : 'var(--headerColor)';
        ?>
        <div class="articleInfo" style="background-color: <?= $bgColor ?>;">
            <div class="titre"><?= htmlspecialchars($article->getTitle()) ?></div>
            <div class="vues"><?= htmlspecialchars($article->getVues()) ?></div>
            <div class="commentaires"><?= htmlspecialchars($article->commentCount) ?></div>
            <div class="date"><?= htmlspecialchars(Utils::convertDateToFrenchFormat($article->getDateCreation())) ?></div>
        </div>
    <?php } ?>
</div>
