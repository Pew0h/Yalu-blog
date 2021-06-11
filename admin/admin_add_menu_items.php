<?php
require_once('../includes/layouts/header_admin.php');

if (isset($_POST['button_register']))
{
    if  (isset($_POST['nom'])  && !empty($_POST['nom']) ) {
        if (!Menu::isInformationExist($_POST['nom']))
        {
            Menu::insertMenu($_POST['nom']);
            $_SESSION['alert'] = Main::alert('success', 'Item ajouté avec succès');
        }
        else
        {
            $_SESSION['alert'] = Main::alert('danger', 'Le nom de l\'item est déjà utilisé');
        }
    }
    else{
        $_SESSION['alert'] = Main::alert('danger', 'Veuillez remplir le champ');
    }
}

if (isset($_GET['id']))
{
    $id_menu = $_GET['id'];
}


?>


<!-- Page Content -->
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h2><i class="fas fa-clipboard-list"></i> Ajout d'un item</h2>
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
                                <input type="text" class="form-control w-25" id="nom" name="nom" placeholder="Nom de l'item">
                            </div>

                            <div class="form-group">
                                <label style="font-weight: bold"> Choix du type de l'item : </label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="type_item" id="type_item" checked>
                                    <label class="form-check-label" for="item_simple">Item simple</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="type_item" id="type_item">
                                    <label class="form-check-label" for="item_simple">Sous-item</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlSelect1"  style="font-weight: bold">Selectionner l'item parent</label>
                                <select class="form-control w-25" id="exampleFormControlSelect1">
                                    <?php
                                    foreach (Menu::getMenuItemsAll($id_menu) as $item)
                                    {
                                        echo '<option value="'.$item['id'].'">'.$item['nom'].'</option>';
                                    }

                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label style="font-weight: bold"> Choix du type de lien : </label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="type_lien" id="type_lien" checked>
                                    <label class="form-check-label" for="type_lien">Lien personalisé</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="type_lien" id="type_lien">
                                    <label class="form-check-label" for="type_lien">Lien catégorie</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlSelect1"  style="font-weight: bold">Selectionner la catégorie</label>
                                <select class="form-control w-25" id="exampleFormControlSelect1">
                                    <?php
                                    foreach (Categorie::getCategories() as $item)
                                    {
                                        echo '<option value="index.php?id='.$item['id_categorie'].'">'.$item['nom'].'</option>';
                                    }

                                    ?>
                                </select>
                            </div>

                            <button type="submit" name="button_register" class="btn btn-primary">Ajouter l'item</button>
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