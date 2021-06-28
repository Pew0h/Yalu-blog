<?php
    require_once('../includes/layouts/header_admin.php');
    if (isset($_GET['id_menu']) && isset($_GET['id_item']))
    {
        $id_menu = $_GET['id_menu'];
        $id_item = $_GET['id_item'];

        if(Menu::isItemIdExist($id_item))
        {
            if (isset($_POST['button_modify']))
            {
                if (isset($_POST['nom']) && !empty($_POST['nom']))
                {
                    // Initialisation de la variable Item
                    if ($_POST['type_item'] == 'sous_item')
                        $item = $_POST['select_parent'];
                    else
                        $item = NULL;

                    // Initialisation de la variable Lien
                    if ($_POST['type_lien'] == 'lien_personalise')
                    {
                        if (isset($_POST['lien_perso']) && !empty($_POST['lien_perso']))
                        {
                            $lien = $_POST['lien_perso'];
                        }

                    }
                    elseif ($_POST['type_lien'] == 'lien_categorie')
                    {
                        $lien = $_POST['select_categorie'];
                    }

                    // Vérification avant l'ajout de l'item
                    if(isset($lien) && !empty($lien))
                    {
                        Menu::updateItem($id_item, $_POST['nom'], $lien, $item);
                        $_SESSION['alert'] = Main::alert('success', 'Item modifié avec succès');
                    }
                    else
                    {
                        $_SESSION['alert'] = Main::alert('danger', 'Veuillez remplir le lien');
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

<script>
    $(document).ready(function() {
        $("#div_select_categorie").hide();

        if($('input[type=radio][name=type_item][value=item_simple]').is(':checked'))
        {
            $("#div_select_item_parent").hide();
        }

        $('input[type=radio][name=type_item]').change(function() {
            if (this.value == 'item_simple') {
                $("#div_select_item_parent").hide();
            }
            else if (this.value == 'sous_item') {
                $("#div_select_item_parent").show();
            }
        });

        $('input[type=radio][name=type_lien]').change(function() {
            if (this.value == 'lien_personalise') {
                $("#div_select_categorie").hide();
                $("#div_input_lien_perso").show();
            }
            else if (this.value == 'lien_categorie') {
                $("#div_select_categorie").show();
                $("#div_input_lien_perso").hide();
            }
        });
    })
</script>

<!-- Page Content -->
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h2><i class="fas fa-clipboard-list"></i> Modification d'un item</h2>
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
                                <input type="text" class="form-control w-25" id="nom" name="nom" placeholder="Nom de l'item" value="<?= Menu::getItemInformation($id_item, 'nom')?>">
                            </div>

                            <div class="form-group">
                                <label style="font-weight: bold"> Choix du type de l'item : </label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="type_item" id="type_item" value="item_simple" <?php if(Menu::getItemInformation($id_item, 'parent_id') == null) echo 'checked';?> >
                                    <label class="form-check-label" for="item_simple">Item simple</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="type_item" id="type_item" value="sous_item" <?php if(Menu::getItemInformation($id_item, 'parent_id')!= null) echo 'checked';?> >
                                    <label class="form-check-label" for="item_simple">Sous-item</label>
                                </div>
                            </div>

                            <div id="div_select_item_parent">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1"  style="font-weight: bold">Selectionner l'item parent</label>
                                    <select class="form-control w-25" id="select_parent" name="select_parent">
                                        <?php
                                        foreach (Menu::getMenuItemsAll($id_menu) as $item)
                                        {
                                            if (Menu::IsParent($id_item))
                                            {
                                                if (Menu::getItemInformation($id_item, 'parent_id') == $item['id'])
                                                    echo '<option selected="selected" value="'.$item['id'].'">'.$item['nom'].'</option>';
                                            }
                                            else
                                                echo '<option value="'.$item['id'].'">'.$item['nom'].'</option>';
                                        }

                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label style="font-weight: bold"> Choix du type de lien : </label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="type_lien" id="type_lien" value="lien_personalise" checked>
                                    <label class="form-check-label" for="type_lien">Lien personalisé</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="type_lien" id="type_lien" value="lien_categorie">
                                    <label class="form-check-label" for="type_lien">Lien catégorie</label>
                                </div>
                            </div>

                            <div id="div_input_lien_perso">
                                <div class="form-group">
                                    <input type="text" class="form-control w-25" id="lien_perso" name="lien_perso" placeholder="Lien exemple : login.php" value="<?= Menu::getItemInformation($id_item, 'lien')?>">
                                </div>
                            </div>

                            <div id="div_select_categorie">
                                <div class="form-group">
                                    <label style="font-weight: bold">Selectionner la catégorie</label>
                                    <select class="form-control w-25" id="select_categorie" name="select_categorie">
                                        <?php
                                        foreach (Categorie::getCategories() as $item)
                                        {
                                            echo '<option value="index.php?id='.$item['id_categorie'].'">'.$item['nom'].'</option>';
                                        }

                                        ?>
                                    </select>
                                </div>
                            </div>

                            <button type="submit" name="button_modify" class="btn btn-primary">Modifier l'item</button>
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