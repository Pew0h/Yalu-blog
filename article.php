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

    if (isset($_POST['commentaire']) && !empty($_POST['commentaire'])){
        Commentaire::InsertCommentaire(utf8_decode($_POST['commentaire']), $_POST['id_article'], $_POST['id_utilisateur']);
        header('location: article.php?id='.$id.'');
        exit;
    }

    if (isset($_POST['button_delete_commentaire'])) {
        Commentaire::deleteCommentaire($_POST['id_commentaire']);
        header('location: article.php?id='.$id.'');
        exit;
    }

if (isset($_POST['button_update_commentaire'])) {
    header('location: edit_commentaire.php?id='.$_POST['id_commentaire'].'');

}



    $numberCom = Commentaire::getNumberCommentairesArticle($id);
    $article = Article::getArticleById($id);
?>
    <section class="body container">
        <section class="header">
            <h1><?= utf8_encode($article['titre'])?></h1>
            <div class="link">
                <h4><?= $article['categorie_nom']?> - <?= $numberCom, " " ?>Commentaires - <?= $article['date_creation']?></h4>
            </div>
            <?php
                if (!empty($article['image']))
                    echo '<img src="includes/images/article/'.utf8_encode($article['image']).'" alt="">';
            ?>
        </section>

        <section class="content">
            <div class="article-content">
                <?= utf8_encode($article['contenu'])?>
            </div>
        </section>

        <section class="voir-plus">
            <?php
                if (isset($_SESSION['user_id']))
                {
                    if (Role::getUserRole($_SESSION['user_id']) == 'Administrateur' || Article::getArticleInformation($id, 'id_utilisateur') == $_SESSION['user_id'])
                    {
                        echo '<div class="col-12 mb-3 text-center modif-article">
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

            if ($numberArticle < 4 ){
                $articles = Article::getArticleByCategorie($id, $article['id_categorie']);

                }else{
                   while (count($tabArticles) <4 ) {
                       $randomId = Article::getRandomId($id, $article['id_categorie']);
                        if ($randomId == $id){
                            return;
                        }
                        if (!isset($tabArticles[$randomId])) {
                            $tabArticles[$randomId] = Article::getArticleById($randomId);
                        }
                    }
                    $articles = $tabArticles;
                }

            foreach ($articles as $key => $articleRandom) {
                echo '<div class="randomArticle">';
                if (!empty($articleRandom['image'])) {
                    echo '<a href="article.php?id=' . $articleRandom['id_article'] . '">
                            <img src="includes/images/article/' . utf8_encode($articleRandom['image']) . ' " alt="">
                           ' . utf8_encode($articleRandom['titre']) . '</a>';
                } else {
                        $contenu_trunc = Article::truncate($articleRandom['contenu'], 200, '...', true);
                    echo '<a href="article.php?id=' . $articleRandom['id_article'] . '">' . $articleRandom['titre'] . $contenu_trunc .'</a>';

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
                        <div class="headCommentaire">
                            <h5> <?= $commentaire['prenom'], " ",  $commentaire['nom']?> </h5>
                            <p><?= " le ", $commentaire['date_creation']?></p>
                        </div>

                            <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $commentaire['id_utilisateur']){
                                echo '<form method="POST">
                                    <div class="buttonCommentaire">
                                        <input type="hidden" name="id_commentaire" value='.$commentaire['id_commentaire'].'>
                                        <input type="hidden" name="id_article" value='.$id.'>
                                        <button type="submit" class="btn btn-outline-danger" name="button_delete_commentaire">Supprimer</button>
                                        <button type="submit" class="btn btn-outline-warning" name="button_update_commentaire">Modifier</button>
                                    </div>
                                       </form>';
                            }

                            ?>

                    </div>
                    <div class="content-commentaire">
                        <p><?= utf8_encode($commentaire['commentaire']);?></p>
                    </div>
                </div>
                <hr>
            <?php }

            if (isset($_SESSION['user_id']))
            { ?>

            <h4>Ajouter un commentaire</h4>
            <form id="AddCommentaire" method="POST">
                <div class="addCommentaire">
                    <textarea type="" id="commentaire" name="commentaire" rows="2" cols="70" maxlength="100"></textarea>
                    <input type="hidden" id="id_article" name="id_article" value="<?= $article['id_article']?>">
                    <input type="hidden" id="id_utilisateur" name="id_utilisateur" value="<?= $_SESSION['user_id']?>">
                    <button type="submit" class="btn btn-outline-dark">Poster</button>
                </div>
            </form>

                <?php }?>

        </section>
    </section>
<?php
require_once ('./includes/layouts/footer.php');
?>