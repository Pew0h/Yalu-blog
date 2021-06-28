<?php
require_once('../includes/layouts/header_admin.php');


if (isset($_POST['id_categorie']))
{
    if (isset($_POST['button_delete_categorie']))
    {
        Categorie::deleteCategorie($_POST['id_categorie']);
    }
    if (isset($_POST['button_modify_categorie']))
    {
        header('Location: admin_categorie_modify.php?id='.$_POST['id_categorie']);
        exit;
    }
}
?>

<!-- Page Content -->
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h2><i class="fas fa-book-open"></i> Gestion des Catégories</h2>
                <hr>
            </div>

            <div class="col-lg-5">
                <form method="Post" action="">
                    <div class="input-group">
                        <input type="text" class="form-control" id="recherche" name="recherche" placeholder="Rechercher une catégorie">
                        <div class="input-group-append">
                            <button class="btn btn-secondary" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-lg-5">
                <div class="input-group">
                    <div class="input-group-append">
                        <a class="button" href="admin_add_categorie.php">Ajouter une catégorie</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <table class="table table-hover ">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach (Categorie::getCategories() as $categorie) {
                        echo '<form method="POST"><tr>';
                        echo '<input type="hidden" name="id_categorie" id="id_categorie" value="' .$categorie['id_categorie'].'">';
                        echo '<th scope="row">'.$categorie['id_categorie'].'</th>';
                        echo '<td>'.$categorie['nom'].'</td>';
                        echo '<td width="250px"><button style="margin-right: 10px" type="submit" name="button_modify_categorie" class="btn btn-outline-warning">Modifier</button> 
                                                <button type="submit" class="btn btn-outline-danger" name="button_delete_categorie">Supprimer</button></td>';
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