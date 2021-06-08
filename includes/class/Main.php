<?php


class Main
{
    public static function alert(string $type, string $message)
    {
        return '<p class="text-'.$type.'">'.$message.'</p>';
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