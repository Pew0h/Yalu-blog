<?php
    require_once ('./includes/layouts/header.php');
    $id = $_GET['id'];
    $numberCom = Commentaire::getNumberCommentairesArticle($id);
    $article = Article::getArticleById($id);
?>
    <section class="body">
        <section class="header">
            <h1><?= $article['titre']?></h1>
            <div class="link">
                <h4><?= $article['categorie_nom']?> </h4>
                <h4><?= $numberCom, " " ?> Commentaires</h4>
                <h4><?= 'Le ', $article['date_creation']?></h4>
            </div>

            <?php
                if (!empty($article['image']))
                    echo '<img src="includes/images/'.$article['image'].'" alt="">';
                else
                    echo '<img src="https://www.fermeturegarage.com/template/img/no-image.png" alt="">';
            ?>

        </section>

        <section class="content">
            <h1><?= $article['titre']?></h1>
            <div class="article-content">
                <p>ceci est un test, il ne sagit pas d'un article mais d'un test d'article ceci est un test, il ne sagit pas d'un article mais d'un test d'article ceci est un test, il ne sagit pas d'un article mais d'un test d'article ceci est un test, il ne sagit pas d'un ceci est un test, il ne sagit pas d'un article mais d'un test d'article ceci est un test, il ne sagit pas d'un article mais d'un test d'article ceci est un test, il ne sagit pas d'un article mais d'un test d'article ceci est un test, il ne sagit pas d'un ceci est un test, il ne sagit pas d'un article mais d'un test d'article ceci est un test, il ne sagit pas d'un article mais d'un test d'article ceci est un test, il ne sagit pas d'un article mais d'un test d'article ceci est un test, il ne sagit pas d'un ceci est un test, il ne sagit pas d'un article mais d'un test d'article ceci est un test, il ne sagit pas d'un article mais d'un test d'article ceci est un test, il ne sagit pas d'un article mais d'un test d'article ceci est un test, il ne sagit pas d'un ceci est un test, il ne sagit pas d'un article mais d'un test d'article ceci est un test, il ne sagit pas d'un article mais d'un test d'article ceci est un test, il ne sagit pas d'un article mais d'un test d'article ceci est un test, il ne sagit pas d'un ceci est un test, il ne sagit pas d'un article mais d'un test d'article ceci est un test, il ne sagit pas d'un article mais d'un test d'article ceci est un test, il ne sagit pas d'un article mais d'un test d'article ceci est un test, il ne sagit pas d'un ceci est un test, il ne sagit pas d'un article mais d'un test d'article ceci est un test, il ne sagit pas d'un article mais d'un test d'article ceci est un test, il ne sagit pas d'un article mais d'un test d'article ceci est un test, il ne sagit pas d'un ceci est un test, il ne sagit pas d'un article mais d'un test d'article ceci est un test, il ne sagit pas d'un article mais d'un test d'article ceci est un test, il ne sagit pas d'un article mais d'un test d'article ceci est un test, il ne sagit pas d'un ceci est un test, il ne sagit pas d'un article mais d'un test d'article ceci est un test, il ne sagit pas d'un article mais d'un test d'article ceci est un test, il ne sagit pas d'un article mais d'un test d'article ceci est un test, il ne sagit pas d'un </p>
            </div>
        </section>

        <section class="voir-plus">
            <h4>Vous aimeriez surement aussi : </h4>
            <div class="article-container">
                <?php for ($i = 0; $i < 4; $i++) { ?>
                    <?php $randomId = Article::getRandomId();
                    $randomArticle = Article::getArticleById($randomId['id_article']); ?>
                    <div class="randomArticle">
                        <?php if (!empty($randomArticle['image'])){ ?>
                            <img src="includes/images/<?= $randomArticle['image'] ?>" alt="">
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
                        <p><?= $commentaire['commentaire']?></p>
                    </div>
                </div>
                <hr>
            <?php } ?>
        </section>
    </section>
<?php
require_once ('./includes/layouts/footer.php');
?>