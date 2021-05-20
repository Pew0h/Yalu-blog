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
        if(User::isUserIdExit($_GET['id']))
        {
            if (isset($_POST['button_modify']))
            {
                if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['pseudo']) && isset($_POST['email']) && isset($_POST['role']) &&
                    !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email']) && !empty($_POST['pseudo']) && !empty($_POST['role']))
                {
                    if (User::isInformationExistAdmin($_POST['pseudo'], $_POST['email'], $_GET['id']))
                    {
                        $_SESSION['alert'] = Main::alert('danger', 'Pseudo ou email déjà utilisé');
                    }
                    else
                    {
                        User::updateUser($_POST['prenom'], $_POST['nom'], $_POST['pseudo'], $_POST['email'], $_POST['role'], $_GET['id']);
                        $_SESSION['alert'] = Main::alert('success', 'Modification de l\'utilisateur avec succès');
                    }

                }
                else{
                    $_SESSION['alert'] = Main::alert('danger', 'Vous devez remplir tous les champs !');
                }
            }
        }
        else
        {
            header('Location: admin_users.php');
            exit;
        }
    }
    else{
        header('Location: index.php');
        exit;
    }

?>
<!-- Page Content -->
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h2><i class="fas fa-users"></i> Modification d'un utilisateur</h2>
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
                                    <span class="input-group-text" id="basic-addon3">Prénom </span>
                                </div>
                                <input type="text" class="form-control w-50" id="prenom" name="prenom" value="<?= User::getUserInformation($_GET['id'], 'prenom')?>">
                            </div>
                            <div class="input-group mb-3 w-50">
                                <div class="input-group-prepend">
                                    <span style="width: 100px" class="input-group-text" id="basic-addon3">Nom </span>
                                </div>
                                <input type="text" class="form-control w-50" id="nom" name="nom" value="<?= User::getUserInformation($_GET['id'], 'nom')?>">
                            </div>
                            <div class="input-group mb-3 w-50">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon3">Pseudo </span>
                                </div>
                                <input type="text" class="form-control w-50" id="pseudo" name="pseudo" value="<?= User::getUserInformation($_GET['id'], 'pseudo')?>">
                            </div>
                            <div class="input-group mb-3 w-50">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon3">Email </span>
                                </div>
                                <input type="email" class="form-control w-50" id="email" name="email" value="<?= User::getUserInformation($_GET['id'], 'email')?>">
                            </div>
                            <div class="form-group">
                                <label>Type de compte :</label>
                                <select name="role" id="role">
                                    <?php
                                    foreach(Role::selectUserRole(User::getUserInformation($_GET['id'], 'id_role')) as $role)
                                    {
                                        echo '<option value="'.$role['id_role'].'">'.utf8_encode($role['nom']).'</option>';
                                    }
                                    foreach(Role::selectOtherRoles(User::getUserInformation($_GET['id'], 'id_role')) as $role)
                                    {
                                        echo '<option value="'.$role['id_role'].'">'.utf8_encode($role['nom']).'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <button type="submit" name="button_modify" class="btn btn-primary">Modifer l'utilisateur</button>
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
