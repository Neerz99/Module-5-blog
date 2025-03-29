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

    <?php foreach ($articles as $article) { ?>
        <div class="articleInfo">
            <div class="titre"><?= $article->getTitle() ?></div>
            <div class="vues"><?= $article->getVues() ?> vues</div>
            <div class="commentaires"><?= htmlspecialchars($article->commentCount) ?> commentaires</div>
            <div class="date">Date de publication : <?= Utils::convertDateToFrenchFormat($article->getDateCreation()) ?></div>
        </div>
    <?php } ?>
</div>
