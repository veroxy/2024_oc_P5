<?php

/**
 * Classe qui gère les articles.
 */
class ArticleManager extends AbstractEntityManager
{
    /**
     * Récupère tous les articles par ordre décroissant d'ajout
     * @return array : un tableau d'objets Article.
     */
    public function getAllArticles(): array
    {
        $sql      = "SELECT * FROM article ORDER BY date_creation DESC";
        $result   = $this->db->query($sql);
        $articles = $this->getComments($result);
        return $articles;
    }

    /**
     * Récupère la relation One To Many Article -> Comments
     * @param PDOStatement $result
     * @return array
     */
    private function getComments(PDOStatement $result): array
    {
        $commentManager = new CommentManager();
        while ($article = $result->fetch()) {
            $comments = $commentManager->getAllCommentsByArticleId($article['id']);
            $post     = new Article($article);
            $post->setComments($comments);
            $articles[] = $post;
        }
        return $articles;
    }

    /**
     * Ajoute ou modifie un article.
     * On sait si l'article est un nouvel article car son id sera -1.
     * @param Article $article : l'article à ajouter ou modifier.
     * @return void
     */
    public function addOrUpdateArticle(Article $article): void
    {
        if ($article->getId() == -1) {
            $this->addArticle($article);
        } else {
            $this->updateArticle($article);
        }
    }

    /**
     * Ajoute un article.
     * @param Article $article : l'article à ajouter.
     * @return void
     */
    public function addArticle(Article $article): void
    {
        $sql = "INSERT INTO article (id_user, title, content, date_creation, date_update) VALUES (:id_user, :title, :content, NOW(), NOW())";
        $this->db->query($sql, [
            'id_user' => $article->getIdUser(),
            'title' => $article->getTitle(),
            'content' => $article->getContent()
        ]);
    }

    /**
     * Modifie un article.
     * @param Article $article : l'article à modifier.
     * @return void
     */
    public function updateArticle(Article $article): void
    {
        $sql = "UPDATE article SET title = :title, content = :content, date_update = NOW() WHERE id = :id";
        $this->db->query($sql, [
            'title' => $article->getTitle(),
            'content' => $article->getContent(),
            'id' => $article->getId()
        ]);
    }

    /**
     * Update nb views in bdd - every refresh page articleDetails
     * @param Article $article
     * @return Article
     */
    public function updateViewsArticle(Article $article): Article
    {
        $views = $article->getViews() + 1;
        $sql   = "UPDATE article SET views = :views WHERE id = :id";
        $this->db->query($sql, [
            'views' => $views,
            'id' => $article->getId()
        ]);
        $article = $this->getArticleById($article->getId());
        return $article;

    }

    /**
     * Récupère un article par son id.
     * @param int $id : l'id de l'article.
     * @return Article|null : un objet Article ou null si l'article n'existe pas.
     */
    public function getArticleById(int $id): ?Article
    {
        $sql     = "SELECT * FROM article WHERE id = :id";
        $result  = $this->db->query($sql, ['id' => $id]);
        $article = $result->fetch();

        if ($article) {
            return new Article($article);
        }

        return null;
    }

    /**
     * Supprime un article.
     * @param int $id : l'id de l'article à supprimer.
     * @return void
     */
    public function deleteArticle(int $id): void
    {
        $sql = "DELETE FROM article WHERE id = :id";
        $this->db->query($sql, ['id' => $id]);
    }

    /**
     *
     * Request Order By Asc/Desc selon la colonne à ordoner
     * @param string $order Asc/Desc
     * @param string $db_column views/title/date/comments
     * @return array
     */
    public function orderBy(string $db_column, string $order): ?array
    {
        try {
            if ($db_column != "comments") {
                $sql      = "SELECT * FROM article ORDER BY $db_column $order";
                $result   = $this->db->query($sql);
                $articles = $this->getComments($result);
            } else {
                // selectionner tous les articles pocédant 0/+ comments
                $sql      = "SELECT a.*, count(c.id_article) as comments
                            FROM article a
                            LEFT JOIN comment c 
                            ON a.id = c.id_article
                            GROUP BY a.id  
                            ORDER BY $db_column $order";
                $result   = $this->db->query($sql);
                $articles = $this->getArrayObjArticle($result);
            }
            return $articles;
        } catch (Exception $err) {
            $errorView = new View('Erreur');
            $errorView->render('errorPage', ['errorMessage' => $err->getMessage()]);
        }
        return null;
    }

    /**
     * Create an array object Aticle
     * @param PDOStatement $result
     * @return array
     */
    private function getArrayObjArticle(PDOStatement $result): array
    {
        $articles = [];
        while ($article = $result->fetch()) {
            $post = new Article($article);
            array_push($articles, $post);
        }
        return $articles;
    }
}
