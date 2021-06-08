<?php
    require_once('../includes/layouts/header_admin.php');

    if(isset($_SESSION['user_id'])) // Si appuie du bouton
    {
        if (Role::getUserRole($_SESSION['user_id']) != 'Administrateur'){
            header('Location: index.php');
            exit;
        }
    }

    if (isset($_GET['id']))
    {
        if(Menu::isMenuIdExist($_GET['id']))
        {
            if (isset($_POST['button_modify']))
            {
                if (isset($_POST['nom']) && !empty($_POST['nom']))
                {
                    if (Menu::isInformationExistAdmin($_POST['nom'], $_GET['id']))
                    {
                        $_SESSION['alert'] = Main::alert('danger', 'Nom du menu déjà utilisée');
                    }
                    else
                    {
                        Menu::updateMenu($_POST['nom'], $_GET['id']);
                        $_SESSION['alert'] = Main::alert('success', 'Modification du menu avec succès');
                    }
                }
            }
        }
        else
        {
            header('Location: admin_menus.php');
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
                <h2><i class="fas fa-users"></i> Modification d'un menu</h2>
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
                                <input type="text" class="form-control w-50" id="nom" name="nom" value="<?= Menu::getMenuName($_GET['id']) ?>">
                            </div>
                            <button type="submit" name="button_modify" class="btn btn-primary">Modifer le menu</button>
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
