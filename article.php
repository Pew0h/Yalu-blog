<?php
require_once ('./includes/layouts/header.php');
if ($_GET['id'])
{
    $id = $_GET['id'];
    if (!Article::getArticleById($id)){ // Si l'article n'existe pas
        header('Location: index.php');
        exit;
    }
}
else{
    header('Location: index.php');
    exit;
}
$numberCom = Commentaire::getNumberCommentairesArticle($id);
$article = Article::getArticleById($id);
?>
    <section class="body container">
        <section class="header">
            <h1><?= $article['titre']?></h1>
            <div class="link">
                <h4><?= $article['categorie_nom']?> -</h4>
                <h4><?= $numberCom, " " ?> Commentaires</h4>
                <h4>- <?= $article['date_creation']?></h4>
            </div>
            <?php
            if (!empty($article['image']))
                echo '<img src="includes/images/article/'.$article['image'].'" alt="">';
            ?>
        </section>

        <section class="content">
            <div class="article-content">
                <?= $article['contenu']?>
            </div>
        </section>

        <section class="voir-plus">
            <?php
            if (isset($_SESSION['user_id']))
            {
                if (Role::getUserRole($_SESSION['user_id']) == 'Administrateur' || Article::getArticleInformation($id, 'id_utilisateur') == $_SESSION['user_id'])
                {
                    echo '<div class="col-12 mb-3 text-center">
                                <a href="edit_article.php?id='.$id.'" class="btn btn-warning">Modifier l\'article</a>
                              </div>';
                }
            }
            ?>
            <h4>Vous aimeriez surement aussi : </h4>
            <div class="article-container">
                <?php
                $tabArticles = [];
                $numberArticle = Article::getNumberArticlesWithCategory($article['id_categorie']);

                if ($numberArticle < 4)
                {
                    $articles = Article::getArticleByCategorie($id, $article['id_categorie']);
                }
                else
                {
                    while (count($tabArticles) < 4)
                    {
                        $randomId = Article::getRandomId($id, $article['id_categorie']);
                        if ($randomId == $id)
                        {
                            return;
                        }
                        if (!isset($tabArticles[$randomId]))
                        {
                            $tabArticles[$randomId] = Article::getArticleById($randomId);
                        }
                    }
                    $articles = $tabArticles;
                }

                foreach ($articles as $key => $article)
                {
                    echo '<div class="randomArticle">';
                    if (!empty($article['image']))
                    {
                        echo '<img src="includes/images/article/' . $article['image'] . ' " alt="">
                          <a href="article.php?id=' . $article['id_article'] . '"> ' . $article['titre'] . '</a>';
                    }
                    else
                    {
                        echo '<img src="https://www.fermeturegarage.com/template/img/no-image.png" alt="">
                          <a href="article.php?id=' . $article['id_article'] . '">' . $article['titre'] . '</a>';
                    }
                    echo '</div>';
                }?>
            </div>
        </section>
        <section class="commentaire-area">
            <h3><?= $numberCom ?> Commentaire : </h3>
            <?php foreach (Commentaire::getCommentairesArticle($id) as $commentaire){ ?>
                <div class="commentaire">
                    <div class="head-commentaire">
                        <h5> <?= $commentaire['prenom'], " ",  $commentaire['nom']?> </h5>
                        <p><?= " le ", $commentaire['date_creation']?></p>
                    </div>
                    <div class="content-commentaire">
                        <p><?= utf8_encode($commentaire['commentaire'])?></p>
                    </div>
                </div>
                <hr>
            <?php } ?>
            </form>
        </section>
    </section>
<?php
require_once ('./includes/layouts/footer.php');
?>