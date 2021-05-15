<?php
class Categorie
{
    public static function getNumberCategories()
    {
        $request = Database::getInstance()->query('SELECT count(*) FROM categorie');
        return $request->fetch()[0];
    }
}

?>