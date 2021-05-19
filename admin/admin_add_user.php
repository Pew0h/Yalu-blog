<?php
require_once('../includes/layouts/header_admin.php');

if(isset($_SESSION['user_id'])) // Si appuie du bouton
{
    if (Role::getUserRole($_SESSION['user_id']) != 'Administrateur'){
        header('Location: index.php');
        exit;
    }
}

if (isset($_POST['button_register']))
{
    if (isset($_POST['pseudo']) && isset($_POST['password']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email'])
    && !empty($_POST['pseudo']) && !empty($_POST['password']) && !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email'])) {
        if (!User::isInformationExist($_POST['pseudo'], $_POST['password']))
        {
            User::insertUser($_POST['prenom'], $_POST['nom'], $_POST['pseudo'], $_POST['email'], $_POST['password'], $_POST['role']);
            $_SESSION['alert'] = Main::alert('success', 'Utilisateur ajouté avec succès');
        }
        else
        {
            $_SESSION['alert'] = Main::alert('danger', 'Le pseudo ou le mail est déjà utilisé');
        }
    }
    else{
        $_SESSION['alert'] = Main::alert('danger', 'Veuillez remplir tous les champs');
    }
}


?>
<!-- Page Content -->
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h2><i class="fas fa-users"></i> Ajout d'un utilisateur</h2>
                <hr>
            </div>
            <div class="col-lg-12">
                <div style="text-align: center;">
                    <?php
                    if(isset($_SESSION['alert'])) {
                        echo $_SESSION['alert'];
                    }
                    ?>
                    <div class="shadow p-3 mb-5 bg-white rounded">
                        <form method="POST">
                            <div class="form-group">
                                <input type="text" class="form-control w-50" id="prenom" name="prenom" placeholder="Prénom">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control w-50" id="nom" name="nom" placeholder="Nom">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control w-50" id="pseudo" name="pseudo" placeholder="Pseudo">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control w-50" id="email" name="email" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control w-50" id="password" name="password" placeholder="Mot de passe">
                            </div>
                            <div class="form-group">
                                <label>Type de compte :</label>
                                <select name="role" id="role">
                                    <?php
                                    foreach(Role::selectRoles() as $role)
                                    {
                                        echo '<option value="'.$role['id_role'].'">'.utf8_encode($role['nom']).'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <button type="submit" name="button_register" class="btn btn-primary">Ajouter l'utilisateur</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
</body>
</html>
