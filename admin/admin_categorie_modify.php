<?php
require_once('../includes/layouts/header_admin.php');

if (isset($_GET['id']))
{
    if(Categorie::isCategorieIdExist($_GET['id']))
    {
        if (isset($_POST['button_modify']))
        {
            if (isset($_POST['nom']) && !empty($_POST['nom']))
            {
                if (Categorie::isInformationExistAdmin($_POST['nom'], $_GET['id']))
                {
<<<<<<< HEAD
                    $_SESSION['alert'] = Main::alert('danger', 'Nom de catégorie déjà utilisée');
                }
                else
                {
                    Categorie::updateCategorie($_POST['nom'], $_GET['id']);
                    header('location: admin_categories.php');
=======
                    if (Categorie::isInformationExistAdmin($_POST['nom'], $_GET['id']))
                    {
                        $_SESSION['alert'] = Main::alert('danger', 'Nom de catégorie déjà utilisée');
                    }
                    else
                    {
                        Categorie::updateCategorie($_POST['nom'], $_GET['id']);
                        header('location: admin_categories.php');
                    }
>>>>>>> origin/Yann
                }
            }
        }
    }
    else
    {
        header('Location: admin_categories.php');
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
                <h2><i class="fas fa-book-open"></i> Modification d'une catégorie</h2>
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
                                <input type="text" class="form-control w-50" id="nom" name="nom" value="<?= Categorie::getCategorieName($_GET['id']) ?>">
                            </div>
                            <button type="submit" name="button_modify" class="btn btn-primary">Modifer la catégorie</button>
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