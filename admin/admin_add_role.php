<?php
require_once('../includes/layouts/header_admin.php');

if (isset($_POST['button_register']))
{
    if  (isset($_POST['nom'])  && !empty($_POST['nom']) ) {
        if (!Role::isInformationExist($_POST['nom']))
        {
            Role::insertRole($_POST['nom']);
            header('location: admin_roles.php');
        }
        else
        {
            $_SESSION['alert'] = Main::alert('danger', 'Le nom du rôle est déjà utilisé');
        }
    }
    else{
        $_SESSION['alert'] = Main::alert('danger', 'Veuillez remplir le champ');
    }
}


?>


<!-- Page Content -->
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h2><i class="fas fa-user-tag"></i> Ajout d'un rôle</h2>
                <hr>
            </div>
            <div class="col-lg-12">
                <center>
                    <?php
                    if(isset($_SESSION['alert'])) {
                        echo $_SESSION['alert'];
                    }
                    ?>
                    <div class="shadow p-3 mb-5 bg-white rounded">
                        <form method="POST">

                            <div class="form-group">
                                <input type="text" class="form-control w-50" id="nom" name="nom" placeholder="Nom du rôle">
                            </div>

                            <button type="submit" name="button_register" class="btn btn-primary">Ajouter le rôle</button>
                        </form>
                    </div>
                </center>
            </div>
        </div>
    </div>
</div>

</div>
</body>
</html>