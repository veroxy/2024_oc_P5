<?php

class ArticleController
{
    /**
     * Affiche la page d'accueil.
     * @return void
     */
    public function showHome(): void
    {
        $articleManager = new ArticleManager();
        $articles       = $articleManager->getAllArticles();

        $view = new View("Accueil");
        $view->render("home", ['articles' => $articles]);
    }

    /**
     * Affiche le détail d'un article.
     * TODO infos / vues à l'affichage ++
     * @return void
     */
    public function showArticle(): void
    {
        // Récupération de l'id de l'article demandé.
        $id             = Utils::request("id", -1);
        $articleManager = new ArticleManager();
        $article        = $articleManager->getArticleById($id);

        if (!$article) {
            throw new Exception("L'article demandé n'existe pas.");
        }

        if ($article->getViews() >= 1 && isset($_SESSION['page_views_' . $article->getSlug()])) {
            // Increment the page view counter from slug no ID to not easily retrieve data
            $_SESSION['page_views_' . $article->getSlug()]++;
        } else {
            // Set the initial page view counter to 1
            $_SESSION['page_views_' . $article->getSlug()] = 1;
            // increase article.viaws in db +1 just for the firstime
            // call updateViewsArticle()
            $articleManager->updateViewsArticle($article);
            var_dump("<h3> SESSION N'EXIST PAS views: " . $article->getViews() . "</h3> ");

            var_dump("viewson db", $article->getViews());

        }
        $commentManager = new CommentManager();
        $comments       = $commentManager->getAllCommentsByArticleId($id);
        $view           = new View($article->getTitle());
        $view->render("detailArticle", ['article' => $article, 'comments' => $comments]);
    }

    /**
     * Affiche le formulaire d'ajout d'un article.
     * @return void
     */
    public function addArticle(): void
    {
        $view = new View("Ajouter un article");
        $view->render("addArticle");
    }

    /**
     * Affiche la page "à propos".
     * @return void
     */
    public function showApropos()
    {
        $view = new View("A propos");
        $view->render("apropos");
    }
}