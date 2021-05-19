<?php
class Categorie
{
    public static function getNumberCategories()
    {
        $request = Database::getInstance()->query('SELECT count(*) FROM categorie');
        return $request->fetch()[0];
    }

    public static function getCategories()
    {
        $request = Database::getInstance()->query('SELECT * FROM categorie');
        return $request->fetchAll();
    }

    public static function dropCategorie($name)
    {
        $request = Database::getInstance()->query('DELETE FROM categorie WHERE ');
    }
}

?>