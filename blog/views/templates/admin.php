<?php
/**
 * Affichage de la partie admin : liste des articles avec un bouton "modifier" pour chacun.
 * Et un formulaire pour ajouter un article.
 */
?>

<!--<h2>Edition des articles</h2>-->
<h2>Admin Monitoring</h2>

<div class="adminArticle">
    <?php foreach ($articles as $article) { ?>
        <div class="articleLine">
            <div class="title"><?= $article->getTitle() ?></div>
            <div class="content"><?= $article->getContent(200) ?></div>
            <div class="content" id="<?= 'page_views_'.$article->getSlug() ?>">nb vues : <?= $article->getViews()  ?> |<?= $_SESSION['page_views_'.$article->getSlug()] ?></div>
            <div class="content">nb commentaires : <?= count($article->getComments()) ?></div>
            <div class="content">date pubblication : <?= ucfirst(Utils::convertDateToFrenchFormat($article->getDateCreation()))?></div>

            <div><a class="submit"
                    href="index.php?action=showArticle&id=<?= $article->getId() ?>">voir</a></div>
            <div><a class="submit"
                    href="index.php?action=showUpdateArticleForm&id=<?= $article->getId() ?>">Modifier</a></div>
            <div><a class="submit"
                    href="index.php?action=deleteArticle&id=<?= $article->getId() ?>" <?= Utils::askConfirmation("Êtes-vous sûr de vouloir supprimer cet article ?") ?> >Supprimer</a>
            </div>
        </div>
    <?php } ?>
</div>

<a class="submit" href="index.php?action=showUpdateArticleForm">Ajouter un article</a>