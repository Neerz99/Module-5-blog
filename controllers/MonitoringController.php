<?php

class MonitoringController
{
    private function checkIfUserIsConnected(): void
    {
        if (!isset($_SESSION['user'])) {
            Utils::redirect("connectionForm");
        }
    }

    public function showMonitoring(): void
    {
        // On vérifie que l'utilisateur est connecté
        $this->checkIfUserIsConnected();

        // On récupère les articles
        $articleManager = new ArticleManager();
        $articles = $articleManager->getAllArticles();

        // On récupère les commentaires
        $commentManager = new CommentManager();
        foreach ($articles as $article) {
            $articleId = $article->getId();
            $article->commentCount = $commentManager->countCommentsByArticle($articleId);
        }

        // Tri des articles selon les paramètres GET
        if (isset($_GET['sortBy']) && isset($_GET['order'])) {
            $sortBy = $_GET['sortBy'];  // Par exemple: 'title', 'vues'
            $order = $_GET['order'];    // Par exemple: 'asc' ou 'desc'

            usort($articles, function($a, $b) use ($sortBy, $order) {
                // Définir la clé de tri
                $valueA = '';
                $valueB = '';

                switch ($sortBy) {
                    case 'title':
                        $valueA = $a->getTitle();
                        $valueB = $b->getTitle();
                        break;
                    case 'vues':
                        $valueA = $a->getVues();
                        $valueB = $b->getVues();
                        break;
                    case 'commentaires':
                        $valueA = $a->commentCount;
                        $valueB = $b->commentCount;
                        break;
                    case 'date':
                        $valueA = $a->getDateCreation();
                        $valueB = $b->getDateCreation();
                        break;
                }

                /*
                 *  0 if $a == $b
                 *  -1 if $a < $b
                 *  1 if $a > $b                 *
                 */
                if ($order === 'asc') {
                    return $valueA <=> $valueB;  // Tri ascendant
                } else {
                    return $valueB <=> $valueA;  // Tri descendant
                }
            });
        }

        // On affiche la page de monitoring
        $view = new View("Monitoring");
        $view->render("monitoring", [
            'articles' => $articles
        ]);
    }
}

