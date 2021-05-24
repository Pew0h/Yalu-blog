<?php
require_once('../includes/layouts/header_admin.php');

if(isset($_SESSION['user_id'])) // Si appuie du bouton
{
    if (Role::getUserRole($_SESSION['user_id']) != 'Administrateur'){
        header('Location: index.php');
        exit;
    }
    if (isset($_POST['id_role']))
    {
        if (isset($_POST['button_delete_role']))
        {
            Role::deleteRole($_POST['id_role']);
        }
        if (isset($_POST['button_modify_role']))
        {
            header('Location: admin_role_modify.php?id='.$_POST['id_role']);
            exit;
        }
    }

}
?>

<!-- Page Content -->
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h2><i class="fas fa-user-tag"></i> Gestion des rôles</h2>
                <hr>
            </div>

            <div class="col-lg-5">
                <form method="Post" action="">
                    <div class="input-group">
                        <input type="text" class="form-control" id="recherche" name="recherche" placeholder="Rechercher un rôle">
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
                        <a class="button" href="admin_add_role.php">Ajouter un rôle</a>
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
                    foreach (Role::getRoles() as $role) {
                        echo '<form method="POST"><tr>';
                        echo '<input type="hidden" name="id_role" id="id_role" value="'.$role['id_role'].'">';
                        echo '<th scope="row">'.$role['id_role'].'</th>';
                        echo '<td>'.utf8_encode($role['nom']).'</td>';
                        echo '<td width="250px"><button style="margin-right: 10px" type="submit" name="button_modify_role" class="btn btn-outline-warning">Modifier</button> 
                                                <button type="submit" class="btn btn-outline-danger" name="button_delete_role">Supprimer</button></td>';
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