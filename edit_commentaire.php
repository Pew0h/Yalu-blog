<?php
require_once('includes/layouts/header.php');

if (isset($_GET['id']))
{

    if(Commentaire::isCommentaireIdExist($_GET['id']))
    {
        if (isset($_POST['button_modify']))
        {
            if (isset($_POST['commentaire']) && !empty($_POST['commentaire']))
            {
                Commentaire::updateCommentaire($_POST['commentaire'], $_GET['id']);
                 header('location: article.php?id='.Commentaire::getCommentairesById($_GET["id"])[0][1]);


            }
        }
    }
    else
    {
        header('Location: admin_commentaires.php');
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
                <h2><i class="fas fa-comments"></i> Modification d'un commentaire</h2>
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
                                    <span class="input-group-text" style="width: 120px" id="basic-addon3">Commentaire </span>
                                </div>
                                <textarea  type="text" class="form-control w-50" id="commentaire" name="commentaire" cols="60" rows="4"><?= Commentaire::getCommentairesById($_GET["id"])[0][0]?></textarea>
                            </div>
                            <button type="submit" name="button_modify" class="btn btn-primary">Modifer le commentaire</button>
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
