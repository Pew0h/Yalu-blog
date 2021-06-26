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
                <?php for ($i = 0; $i < 4; $i++) { ?>
                    <?php $randomId = Article::getRandomId();
                    $randomArticle = Article::getArticleById($randomId['id_article']); ?>
                    <div class="randomArticle">
                        <?php if (!empty($randomArticle['image'])){ ?>
                            <img src="includes/images/article/<?= $randomArticle['image'] ?>" alt="">
                            <a href="#"><?= $randomArticle['titre']?></a>
                        <?php }else{ ?>
                            <img src="https://www.fermeturegarage.com/template/img/no-image.png" alt="">
                            <a href="#"><?= $randomArticle['titre'] ?></a>
                        <?php } ?>
                    </div>
                <?php } ?>
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
        </section>
    </section>
<?php
require_once ('./includes/layouts/footer.php');
?>