<?php
require_once('../includes/layouts/header_admin.php');

if(isset($_SESSION['user_id'])) // Si appuie du bouton
{
    if (Role::getUserRole($_SESSION['user_id']) != 'Administrateur'){
        header('Location: index.php');
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
                        echo '<tr>';
                        echo '<th scope="row">'.$categorie['id_categorie'].'</th>';
                        echo '<td>'.$categorie['nom'].'</td>';
                        echo '<td width="250px"><a style="margin-right: 10px" type="button" class="btn btn-warning">Modifier</a> 
                                    <a type="button" class="btn btn-danger">Supprimer</a></td>';
                    }
                    ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

</div>
</body>
</html>