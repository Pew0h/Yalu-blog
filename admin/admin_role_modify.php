<?php
    require_once('../includes/layouts/header_admin.php');

    if (isset($_GET['id']))
    {
        if(Role::isRoleIdExist($_GET['id']))
        {
            if (isset($_POST['button_modify']))
            {
                if (isset($_POST['nom']) && !empty($_POST['nom']))
                {
                    if (Role::isInformationExistAdmin($_POST['nom'], $_GET['id']))
                    {
                        $_SESSION['alert'] = Main::alert('danger', 'Nom du rôle déjà utilisé');
                    }
                    else
                    {
                        Role::updateRole($_POST['nom'], $_GET['id']);
                        header('location: admin_roles.php');
                    }
                }
            }
        }
        else
        {
            header('Location: admin_roles.php');
            exit;
        }

    } else{
        header('Location: index.php');
        exit;
    }

?>
<!-- Page Content -->
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h2><i class="fas fa-user-tag"></i> Modification d'un rôle</h2>
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
                            <div class="input-group mb-3 w-50">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon3">Nom </span>
                                </div>
                                <input type="text" class="form-control w-50" id="nom" name="nom" value="<?= utf8_encode(Role::getRoleName($_GET['id']))?>">
                            </div>
                            <button type="submit" name="button_modify" class="btn btn-primary">Modifer le rôle</button>
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
