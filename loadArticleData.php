<?php
    require_once('./includes/class/User.php');
    require_once('./includes/class/Article.php');
    require_once('./includes/class/Commentaire.php');
    //echo var_dump($_GET);
    $html = ""; // on instancie la sortie html
    $limit = 6; // on limite un affichage de 6 articles par 6 articles
    $i = 0;

    if (isset($_GET['page_no'])) { // Si ajax nous renvoi un nombre de page alors on instancie le nombre de page actuel
        $page = $_GET['page_no'];
    }else{
        $page = 0; // sinon on commence à la page 0
    }

    if (isset($_GET['id']) && !empty($_GET['id']))
    {
        $id = $_GET['id'];
        $page_max = Article::getNumberArticlesWithCategory($id); // connaitre le nombre de page maximum en comptant la catégorie
        $SQL = "SELECT *, categorie.nom as categorie_nom, DATE_FORMAT(article.date_creation, '%d/%m/%Y') as date_creation FROM article 
                                                       LEFT OUTER JOIN categorie ON article.id_categorie = categorie.id_categorie
                                                       LEFT OUTER JOIN utilisateur ON article.id_utilisateur = utilisateur.id_utilisateur
                                                       WHERE categorie.id_categorie = '$id' ORDER BY date_creation LIMIT $page, $limit";
    }
    else
    {
        $page_max = Article::getNumberArticles(); // connaitre le nombre de page maximum
        $id = null;
        $SQL = "SELECT *, categorie.nom as categorie_nom, DATE_FORMAT(article.date_creation, '%d/%m/%Y') as date_creation FROM article 
                                                       LEFT OUTER JOIN categorie ON article.id_categorie = categorie.id_categorie
                                                       LEFT OUTER JOIN utilisateur ON article.id_utilisateur = utilisateur.id_utilisateur ORDER BY date_creation LIMIT $page, $limit";
    }
    $request = Database::getInstance()->query($SQL);
    $data = $request->fetchAll();


    foreach ($data as $article) {
            $i++; // on compte le nombre d'article pour chaque itération
            $last_page = $page + $i; //pour connaitre le nombre du dernier élèment

        $img = $article['image'];
        if (!empty($img)) {
            $contenu_trunc = Article::truncate($article['contenu'], 75, '...', true);
            $html .=
            '<div class="col-lg-4 col-md-6">
                <div class="card h-100">
                    <div class="single-post post-style-1">
                        <div class="blog-image"><a href="article.php?id='.$article['id_article'].'"><img src="includes/images/article/'.$img.'" alt="Blog Image"></div></a>
                        <div class="blog-info">
                            <h6><a href="article.php?id='.$article['id_article'].'"><b>'.$article['categorie_nom'].'</b></a></h6>
                            <hr>
                            <h4 class="title"><a href="article.php?id='.$article['id_article'].'"><b>'.$article['titre'].'</b></a></h4>
                            <a href="article.php?id='.$article['id_article'].'" class="button" ><i class="ion-pricetag"></i>  Voir l\'article </a>
                            <ul class="post-footer">
                                <li><i class="ion-calendar"></i>'.$article['date_creation'].'</li>
                                <li><i class="ion-chatbubble"></i>'.Commentaire::getNumberCommentairesArticle($article['id_article']).'</li>
                                </ul>
                        </div>
                    </div>
                </div>
            </div>';
        }else {
            $contenu_trunc = Article::truncate($article['contenu'], 220, '...', true);
            $html .=
                '
                <div class="col-lg-4 col-md-6">
                <div class="card h-100">
                    <div class="single-post">
                        <div class="blog-info">
                            <h6><a href="index.php?id='.$article['id_categorie'].'"><b>'.$article['categorie_nom'].'</b></a></h6>
                            <hr>
                            <h4 class="title"><a href="#"><b>'.$article['titre'].'</b></a></h4>
                            <p class="blog-contenu">'.$contenu_trunc.'</p>
                            <a href="article.php?id='.$article['id_article'].'" class="button"><i class="ion-pricetag"></i>  Voir l\'article </a>
                            <ul class="post-footer">
                                <li><i class="ion-calendar"></i>'.$article['date_creation'].'</li>
                                <li><i class="ion-chatbubble"></i>'.Commentaire::getNumberCommentairesArticle($article['id_article']).'</li>
                            </ul>
                        </div><!-- blog-right -->
                    </div><!-- single-post extra-blog -->
                </div><!-- card -->
            </div><!-- col-lg-4 col-md-6  sans photo-->
                ';
        }
    }
if (isset($last_page))
    $html.= "<div class='col-12' id='show-more-div'><input id='page' name='page' type='hidden' value='{$last_page}'><input id='page-max' name='page-max' type='hidden' value='{$page_max}'><button style='width: 250px' type='button' id='show-more' class='btn btn-light form-inline'>Voir plus</button></div>";
echo $html;

?>