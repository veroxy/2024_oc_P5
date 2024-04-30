<?php

/**
 * Classe qui gère les articles.
 */
class ArticleManager extends AbstractEntityManager
{
    /**
     * Récupère tous les articles.
     * @return array : un tableau d'objets Article.
     */
    public function getAllArticles(): array
    {
        $sql      = "SELECT * FROM article";
        $result   = $this->db->query($sql);
        $articles = $this->getComments($result);
        return $articles;
    }

    private function getComments(PDOStatement $res): array
    {
        $commentManager = new CommentManager();
        while ($article = $res->fetch()) {
            $comments = $commentManager->getAllCommentsByArticleId($article['id']);
            $post     = new Article($article);
            $post->setComments($comments);
            $articles[] = $post;
        }
        return $articles;
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
     * @param Article $article
     * @return void
     */
    public function updateViewsArticle(Article $article): void
    {
        $sql = "UPDATE article SET views = :views + 1  WHERE id = :id";
        $this->db->query($sql, [
            'views' => $article->getViews(),
            'id' => $article->getId()
        ]);
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

/*    public function orderByTitleAsc(): array
    {
        $sql    = "SELECT * FROM article ORDER BY title ASC";
        $result = $this->db->query($sql);
        return $this->getComments($result);
    }*/

    public function orderByTitleDesc(): array
    {
        $sql    = "SELECT * FROM article ORDER BY title DESC ";
        $result = $this->db->query($sql);
        return $this->getComments($result);
    }

    public function orderBy(string $order, string $db_column): array
    {
        // soit case soit
        if ($db_column != "comments") {
            $sql      = "SELECT * FROM article ORDER BY $db_column $order";
            $result   = $this->db->query($sql);
            $articles = $this->getComments($result);
        } else {
            $sql      = "SELECT a.*, count(c.id_article) as comments
                    FROM article a
                        join
                         comment c
                    WHERE c.id_article=a.id
                    GROUP BY c.id_article   
                    ORDER BY $db_column $order";
            $result   = $this->db->query($sql);
            $articles = $this->getNbComments($result);
        }
        return $articles;
    }

    private function getNbComments(PDOStatement $res): array
    {
        while ($article = $res->fetch()) {

            $post       = new Article($article);
            $articles[] = $post;
        }
        return $articles;
    }

}