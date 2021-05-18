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

    public static function dropCategorie(string $id)
    {
        $request = Database::getInstance()->prepare('DELETE FROM categorie WHERE id_categorie = :id');
        $request->execute(array(
            'id' => $id
        ));
    }
}

?>