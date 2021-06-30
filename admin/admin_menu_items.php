<?php
require_once('../includes/layouts/header_admin.php');

    if ($_GET['id']){
        $id_menu = $_GET['id'];
    }
    else
    {
        header('Location: admin_menus.php');
        exit;
    }


    if (isset($_POST['id_menu_items']))
    {
        if (isset($_POST['button_delete_item']))
        {
            Menu::deleteItem($_POST['id_menu_items']);
        }
        if (isset($_POST['button_modify_item']))
        {
            header('Location: admin_menu_items_modify.php?id_item='.$_POST['id_menu_items'].'&id_menu='. $id_menu);
            exit;
        }
    }
?>

<!-- Page Content -->
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h2><i class="fas fa-clipboard-list"></i> Items du menu <?= Menu::GetMenuName($id_menu); ?></h2>
                <hr>
            </div>

            <div class="col-lg-5">
                <form method="Post" action="">
                    <div class="input-group">
                        <input type="text" class="form-control" id="recherche" name="recherche" placeholder="Rechercher d'un item">
                        <div class="input-group-append">
                            <button class="btn btn-secondary" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-lg-5">
                <div class="input-group">
                    <div class="input-group-append">
                        <?php echo '<a class="button" href="admin_add_menu_items.php?id='.$id_menu.'">Ajouter un item</a>';?>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <table class="table table-hover ">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Type de l'item</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach (Menu::getMenuItemsAll($id_menu) as $item) {
                        echo '<form method="POST"><tr>';
                        echo '<input type="hidden" name="id_menu_items" id="id_menu_items" value="' .$item['id'].'">';
                        echo '<td>'.$item['id'].'</td>';
                        echo '<td>'.utf8_encode($item['nom']).'</td>';
                        if($item['parent'] == 1)
                            echo '<td style="font-weight: bold">Item parent</td>';
                        elseif($item['parent_id'] != null)
                            echo '<td style="font-style: italic">Sous-item</td>';
                        else
                            echo '<td>Item simple</td>';
                        echo '<td width="250px">
                                <button type="submit" name="button_modify_item" class="btn btn-outline-warning">Modifier</button> 
                                <button type="submit" class="btn btn-outline-danger" name="button_delete_item">Supprimer</button>
                              </td>';
                        echo '</form> ';
                    }
                    ?>
                    </tbody>
                </table>
                <?php
                if (isset($_SESSION['alert'])) {
                    echo $_SESSION['alert'];
                }
                ?>
            </div>
        </div>
    </div>
</div>

</div>
</body>
</html>