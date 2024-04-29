<?php
/**
 * Affichage de la partie admin : liste des articles avec un bouton "modifier" pour chacun.
 * Et un formulaire pour ajouter un article.
 */
?>

<!--<h2>Edition des articles</h2>-->
<h2>Admin Monitoring</h2>

<table class="adminArticle">
    <tr class="articleHeaderLine">
        <th class="t-cell title">title
            <div class="tri">
                <a class='asc'
                   href='index.php?action=orderByTitleAsc'
                    <?= Utils::askConfirmation('Êtes-vous sûr de vouloir réordonner en ASC les titres ?.') ?>>
                    ASC
                </a>
                <a class='desc'
                   href='index.php?action=orderByTitleDesc'
                    <?= Utils::askConfirmation('Êtes-vous sûr de vouloir réordonner en DESC les titres ?.') ?>>
                    DESC
                </a>

<!--                <input hidden="hidden" name="orderByTitleDesc" class="desc">-->
            </div>
        </th>
        <th class="t-cell content">short desc
        </th>
        <th class="t-cell">nb views
            <div class="tri">
                <a class='asc'
                   href='index.php?action=orderByTitleAsc'
                    <?= Utils::askConfirmation('Êtes-vous sûr de vouloir réordonner en ASC les titres ?.') ?>>
                    ASC
                </a>
                <a class='desc'
                   href='index.php?action=orderByTitleDesc'
                    <?= Utils::askConfirmation('Êtes-vous sûr de vouloir réordonner en DESC les titres ?.') ?>>
                    DESC
                </a>

                <!--                <input hidden="hidden" name="orderByTitleDesc" class="desc">-->
            </div>
        </th>
        <th class="t-cell">nb commentaires
            <div class="tri">
                <a class='asc'
                   href='index.php?action=orderByTitleAsc'
                    <?= Utils::askConfirmation('Êtes-vous sûr de vouloir réordonner en ASC les titres ?.') ?>>
                    ASC
                </a>
                <a class='desc'
                   href='index.php?action=orderByTitleDesc'
                    <?= Utils::askConfirmation('Êtes-vous sûr de vouloir réordonner en DESC les titres ?.') ?>>
                    DESC
                </a>

                <!--                <input hidden="hidden" name="orderByTitleDesc" class="desc">-->
            </div>
        </th>
        <th class="t-cell">date pubblication
            <div class="tri">
                <a class='asc'
                   href='index.php?action=orderByTitleAsc'
                    <?= Utils::askConfirmation('Êtes-vous sûr de vouloir réordonner en ASC les titres ?.') ?>>
                    ASC
                </a>
                <a class='desc'
                   href='index.php?action=orderByTitleDesc'
                    <?= Utils::askConfirmation('Êtes-vous sûr de vouloir réordonner en DESC les titres ?.') ?>>
                    DESC
                </a>

                <!--                <input hidden="hidden" name="orderByTitleDesc" class="desc">-->
            </div>
        </th>
        <th class="t-cell" colspan="3">actions</th>
    </tr>
    <?php foreach ($articles as $article) { ?>
        <!--        <tr class="">-->
        <tr class="articleLine">
            <td class="title"><?= $article->getTitle() ?></td>
            <td class="content"><?= $article->getContent(200) ?></td>
            <td class="other"
                id="<?= 'page_views_' . $article->getSlug() ?>"><?= $article->getViews() >= 1 ? $article->getViews() : (isset($_SESSION['page_views_' . $article->getSlug()]) ? $_SESSION['page_views_' . $article->getSlug()] : 0); ?></td>
            <td class="other"><?= count($article->getComments()) ?></td>
            <td class="other"><?= ucfirst(Utils::convertDateToFrenchFormat($article->getDateCreation())) ?></td>
            <td class="action"><a class="submit"
                                  href="index.php?action=showArticle&id=<?= $article->getId() ?>">voir</a></td>
            <td class="action"><a class="submit"
                                  href="index.php?action=showUpdateArticleForm&id=<?= $article->getId() ?>">Modifier</a>
            </td>
            <td class="action"><a class="submit"
                                  href="index.php?action=deleteArticle&id=<?= $article->getId() ?>" <?= Utils::askConfirmation("Êtes-vous sûr de vouloir supprimer cet article ?") ?> >Supprimer</a>
            </td>
        </tr>
    <?php } ?>
</table>

<a class="submit" href="index.php?action=showUpdateArticleForm">Ajouter un article</a>