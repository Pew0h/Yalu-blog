<?php
require_once ('./includes/layouts/header.php');

if(isset($_POST['confirm-info'])) // Si appuie du bouton
{
    if(isset($_POST['nom']) && isset($_POST['prenom']) && !empty($_POST['nom']) && !empty($_POST['prenom'])){
        User::updateUser($_POST['nom'], $_POST['prenom'], $_SESSION['user_id']);
        $_SESSION['alert'] = Main::alert('success', 'Changement des informations avec succès');
    }else
    {
        $_SESSION['alert'] = Main::alert('danger', 'Veuillez remplir tous les champs');
    }
}

if(isset($_POST['confirm-password'])) // Si appuie du bouton
{
    if(isset($_POST['mdp']) && isset($_POST['oldmdp']) && isset($_POST['confmdp']) && !empty($_POST['mdp']) && !empty($_POST['oldmdp']) && !empty($_POST['confmdp'])){
        if($_POST['mdp'] == $_POST['confmdp']){
            if(hash('sha512', $_POST['oldmdp']) == User::getUserInformation($_SESSION['user_id'], 'mot_de_passe')){
                User::updateUserPassword($_POST['mdp'], $_SESSION['user_id']);
                $_SESSION['alert'] = Main::alert('success', 'Changement du mot de passe avec succès');
            }
        }else{
            $_SESSION['alert'] = Main::alert('danger', 'Les mots de passe ne sont pas identiques');
        }
    }else
    {
        $_SESSION['alert'] = Main::alert('danger', 'Veuillez remplir tous les champs');
    }
}


?>

    <h2> Espace utilisateur </h2>
    <br>
    <center>
    <div class="shadow p-3 mb-5 bg-white rounded" style="width: 50%;">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-info" aria-selected="true">Informations</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-mdp" aria-selected="false">Mot de passe</a>
            </li>
        </ul>

        <!-- INFORMATIONS -->
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-info-tab">
                <form method="POST">
                    <?php
                    if(isset($_SESSION['alert'])) {
                        echo $_SESSION['alert'];
                    }
                    ?>
                    <!-- Nom -->
                    <div class="input-group mb-3 w-50">
                        <div class="input-group-prepend">
                            <span style="width: 80px;" class="input-group-text" id="basic-addon1">Nom</span>
                        </div>
                        <input style="width:20px" type="text" class="form-control" placeholder="nom" value="<?= User::getUserInformation($_SESSION['user_id'], 'nom'); ?>" id="nom" name="nom">
                    </div>

                    <!-- Prénom -->
                    <div class="input-group mb-3 w-50">
                        <div class="input-group-prepend">
                            <span style="width: 80px;" class="input-group-text" id="basic-addon1">Prénom</span>
                        </div>
                        <input style="width:20px" type="text" class="form-control" placeholder="Prénom" value="<?= User::getUserInformation($_SESSION['user_id'], 'prenom'); ?>"  id="prenom" name="prenom" aria-describedby="basic-addon1">
                    </div>
                    <input type="submit" class="button" name="confirm-info" value="Confirmer les changements">
                </form>
            </div>


            <!-- MOT DE PASSE -->
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-mdp-tab">
                <form method="POST">
                    <?php
                    if(isset($_SESSION['alert'])) {
                        echo $_SESSION['alert'];
                    }
                    ?>
                    <!-- Nom -->
                    <div class="input-group mb-3 w-75">
                        <div class="input-group-prepend">
                            <span style="width: 250px;" class="input-group-text" id="basic-addon1">Ancien mot de passe</span>
                        </div>
                        <input style="width:20px" type="password" class="form-control" placeholder="Ancien mot de passe" id="oldmdp" name="oldmdp" aria-describedby="basic-addon1">
                    </div>

                    <!-- Nom -->
                    <div class="input-group mb-3 w-75">
                        <div class="input-group-prepend">
                            <span style="width: 250px;" class="input-group-text" id="basic-addon1">Nouveau mot de passe</span>
                        </div>
                        <input style="width:20px" type="password" class="form-control" placeholder="Nouveau mot de passe"  id="mdp" name="mdp" aria-describedby="basic-addon1">
                    </div>

                    <!-- Nom -->
                    <div class="input-group mb-3 w-75">
                        <div class="input-group-prepend">
                            <span style="width: 250px;" class="input-group-text" id="basic-addon1">Confirmation mot de passe</span>
                        </div>
                        <input style="width:20px" type="password" class="form-control" placeholder="Confirmation mot de passe"  id="confmdp" name="confmdp" aria-describedby="basic-addon1">
                    </div>

                    <input type="submit" class="button" name="confirm-password" value="Changer de mot de passe">
                </form>
            </div>

        </div>
    </div>
    </center>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>