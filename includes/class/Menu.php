<?php


class Menu
{
    public static function getMenus($recherche = '')
    {
        if (isset($_POST['recherche'])) $recherche = $_POST['recherche'];
        $request = Database::getInstance()->query("SELECT * FROM menu WHERE nom LIKE '%$recherche%'");
        $data = $request->fetchAll();
        if($data == false) $_SESSION['alert'] = Main::alert('danger', 'Aucune catégorie trouvée');
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

    public static function getMenuItems(int $id)
    {
        $request = Database::getInstance()->query("SELECT * FROM menu 
                                                   LEFT OUTER JOIN menu_items ON menu_items.id_menu = menu.id_menu
                                                   WHERE menu.id_menu = $id AND parent_id is NULL ORDER BY ordre");
        return $request->fetchAll();
    }

    public static function getMenuSubItems(int $parent_id)
    {
        $request = Database::getInstance()->query("SELECT * FROM menu_items 
                                                   WHERE parent_id = $parent_id ORDER BY ordre");
        return $request->fetchAll();
    }

}