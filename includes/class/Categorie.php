<?php
class Categorie
{
    public static function getNumberCategories()
    {
        $request = Database::getInstance()->query('SELECT count(*) FROM categorie');
        return $request->fetch()[0];
    }

    public static function insertCategorie(string $nom){
        $database = Database::getInstance();
        $request = $database->prepare('INSERT INTO categorie(nom) VALUE (:categorie_nom)');
        $request->execute(array(
            'categorie_nom' => $nom
        ));
    }

    public static function isInformationExist(string $nom) : bool
    {
        $database = Database::getInstance();
        $request = $database->prepare('SELECT nom FROM categorie WHERE nom = :categorie_nom');
        $request->execute(array(
            'categorie_nom' => $nom,
        ));

        return $request->rowCount() >= 1;
    }

    public static function getCategories()
    {
        $request = Database::getInstance()->query('SELECT * FROM categorie');
        return $request->fetchAll();
    }

    public static function deleteCategorie($id_categorie)
    {
        $request = Database::getInstance()->prepare('DELETE FROM categorie WHERE id_categorie = :id');
        $request->execute(array(
            'id' => $id_categorie,
        ));
    }
}

?>