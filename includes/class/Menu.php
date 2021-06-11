<?php


class Menu
{
    public static function getMenus($recherche = '')
    {
        if (isset($_POST['recherche'])) $recherche = $_POST['recherche'];
        $request = Database::getInstance()->query("SELECT * FROM menu WHERE nom LIKE '%$recherche%'");
        $data = $request->fetchAll();
        if($data == false) $_SESSION['alert'] = Main::alert('danger', 'Aucun menu trouvé');
        else $_SESSION['alert'] = '';
        return $data;
    }

    public static function isInformationExist(string $nom)
    {
        $database = Database::getInstance();
        $request = $database->prepare('SELECT nom FROM menu WHERE nom = :menu_nom');
        $request->execute(array(
            'menu_nom' => $nom,
        ));
        return $request->rowCount() >= 1;
    }

    public static function insertMenu(string $nom){
        $database = Database::getInstance();
        $request = $database->prepare('INSERT INTO menu(nom) VALUE (:menu_nom)');
        $request->execute(array(
            'menu_nom' => $nom
        ));
    }

    public static function deleteMenu(int $id)
    {
        $requestMenu = Database::getInstance()->prepare('DELETE FROM menu WHERE id_menu = :id');
        $requestMenu->execute(array(
            'id' => $id,
        ));
        $requestItems = Database::getInstance()->prepare('DELETE FROM menu_items WHERE id_menu = :id');
        $requestItems->execute(array(
            'id' => $id,
        ));
    }

    public static function isMenuIdExist($id)
    {
        $request = Database::getInstance()->prepare('SELECT id_menu FROM menu WHERE id_menu = :id');
        $request->execute(array(
            'id' => $id
        ));
        return $request->rowCount() >= 1;
    }

    public static function isInformationExistAdmin(string $nom, int $id)
    {
        $request = Database::getInstance()->prepare('SELECT nom FROM menu WHERE nom = :menu_nom AND id_menu != :id');
        $request->execute(array(
            'menu_nom' => $nom,
            'id' => $id
        ));
        return $request->rowCount() >= 1;
    }

    public static function updateMenu(string $nom, int $id)
    {
        $request = Database::getInstance()->prepare('UPDATE menu SET nom = :menu_nom WHERE id_menu = :id');
        $request->execute(array(
            'menu_nom' => $nom,
            'id' => $id
        ));
    }

    public static function getMenuName(int $id)
    {
        $database = Database::getInstance();
        $request = $database->prepare('SELECT nom FROM menu WHERE id_menu = :id');
        $request->execute(array(
            'id' => $id,
        ));

        while($data = $request->fetch()){
            return $data['nom'];
        }
    }

    public static function getMenuItems(int $id)
    {
        $request = Database::getInstance()->query("SELECT id_menu_items AS 'id', menu_items.nom, parent_id, lien, 
                                                   CASE WHEN( SELECT COUNT(*) FROM menu_items WHERE parent_id = id) > 0 
                                                   THEN TRUE ELSE FALSE END AS 'parent' FROM menu_items
                                                   LEFT OUTER JOIN menu ON menu.id_menu = menu_items.id_menu
                                                   WHERE menu.id_menu = $id ORDER BY ordre");
        return $request->fetchAll();
    }


    public static function getMenuItemsAll(int $id, $recherche = '')
    {
        if (isset($_POST['recherche'])) $recherche = $_POST['recherche'];
        $request = Database::getInstance()->query("SELECT id_menu_items AS 'id', menu_items.nom, parent_id, lien, 
                                                   CASE WHEN( SELECT COUNT(*) FROM menu_items WHERE parent_id = id) > 0 
                                                   THEN TRUE ELSE FALSE END AS 'parent' FROM menu_items
                                                   LEFT OUTER JOIN menu ON menu.id_menu = menu_items.id_menu
                                                   WHERE menu.id_menu = '$id' ORDER BY ordre, parent_id");
        $data = $request->fetchAll();
        if($data == false) $_SESSION['alert'] = Main::alert('danger', 'Aucun item trouvé');
        else $_SESSION['alert'] = '';
        return $data;
    }

    public static function getMenuSubItems(int $parent_id)
    {
        $request = Database::getInstance()->query("SELECT * FROM menu_items 
                                                   WHERE parent_id = $parent_id ORDER BY ordre");
        return $request->fetchAll();
    }

}