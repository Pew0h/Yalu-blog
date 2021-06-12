<?php
require_once('../includes/layouts/header_admin.php');

if (isset($_POST['id_commentaire']))
{
    if (isset($_POST['button_delete_article']))
    {
        Article::deleteArticle($_POST['id_commentaire']);
    }
    if (isset($_POST['button_modify_article']))
    {

    }
}
?>

<!-- Page Content -->
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h2><i class="far fa-newspaper"></i></i> Gestion des articles</h2>
                <hr>
            </div>

            <div class="col-lg-5">
                <form method="Post" action="">
                    <div class="input-group">
                        <input type="text" class="form-control" id="recherche" name="recherche" placeholder="Rechercher un article">
                        <div class="input-group-append">
                            <button class="btn btn-secondary" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-lg-12">
                <table class="table table-hover ">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Catégorie</th>
                        <th scope="col">Auteur</th>
                        <th scope="col">Date de publication</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach (Article::getArticles() as $article) {
                        echo '<form method="POST"><tr>';
                        echo '<input type="hidden" name="id_commentaire" id="id_commentaire" value="' .$article['id_article'].'">';
                        echo '<th scope="row">'.$article['id_article'].'</th>';
                        echo '<td>'.$article['titre'].'</td>';
                        echo '<td>'.$article['categorie_nom'].'</td>';
                        echo '<td>'.$article['pseudo'].'</td>';
                        echo '<td width="200px">'.$article['date_creation'].'</td>';;
                        echo '<td width="250px"><button style="margin-right: 10px" type="submit" name="button_modify_article" class="btn btn-outline-warning">Modifier</button> 
                                                <button type="submit" class="btn btn-outline-danger" name="button_delete_article">Supprimer</button></td>';
                        echo '</form> ';
                    }
                    ?>
                    </tbody>
                </table>
                <?php
                if (isset($_SESSION['alert'])) {
                    echo $_SESSION['alert'];
                }
                ?>
            </div>
        </div>
    </div>
</div>

</div>
</body>
</html>