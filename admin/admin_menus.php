<?php
require_once('../includes/layouts/header_admin.php');

if(isset($_SESSION['user_id'])) // Si appuie du bouton
{
    if (Role::getUserRole($_SESSION['user_id']) != 'Administrateur'){
        header('Location: index.php');
        exit;
    }

    if (isset($_POST['id_menu']))
    {
        if (isset($_POST['button_delete_menu']))
        {

        }
        if (isset($_POST['button_modify_menu']))
        {

        }
    }
}
?>

<!-- Page Content -->
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h2><i class="fas fa-ellipsis-h"></i> Gestion des menus</h2>
                <hr>
            </div>

            <div class="col-lg-5">
                <form method="Post" action="">
                    <div class="input-group">
                        <input type="text" class="form-control" id="recherche" name="recherche" placeholder="Rechercher un menu">
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
                        <a class="button" href="admin_add_menu.php">Ajouter un menu</a>
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
                    foreach (Menu::getMenus() as $menu) {
                        echo '<form method="POST"><tr>';
                        echo '<input type="hidden" name="id_menu" id="id_menu" value="' .$menu['id_menu'].'">';
                        echo '<th scope="row">'.$menu['id_menu'].'</th>';
                        echo '<td>'.$menu['nom'].'</td>';
                        echo '<td width="400px">
                                <button type="submit" class="btn btn-outline-primary" name="button_add_menu_items">Ajouter des items</button>
                                <button type="submit" name="button_modify_menu" class="btn btn-outline-warning">Modifier</button> 
                                <button type="submit" class="btn btn-outline-danger" name="button_delete_menu">Supprimer</button>
                              </td>';
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