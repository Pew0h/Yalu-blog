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

    public static function isInformationExist(string $nom)
    {
        $database = Database::getInstance();
        $request = $database->prepare('SELECT nom FROM categorie WHERE nom = :categorie_nom');
        $request->execute(array(
            'categorie_nom' => $nom,
        ));

        return $request->rowCount() >= 1;
    }

    public static function isInformationExistAdmin(string $nom, int $id)
    {
        $request = Database::getInstance()->prepare('SELECT nom FROM categorie WHERE nom = :categorie_nom AND id_categorie != :id');
        $request->execute(array(
            'categorie_nom' => $nom,
            'id' => $id
        ));

        return $request->rowCount() >= 1;
    }

    public static function getCategorieName(int $id)
    {
        $database = Database::getInstance();
        $request = $database->prepare('SELECT nom FROM categorie WHERE id_categorie = :id');
        $request->execute(array(
            'id' => $id,
        ));

        while($data = $request->fetch()){
            return $data['nom'];
        }
    }

    public static function getCategories($recherche = '')
    {
        if (isset($_POST['recherche'])) $recherche = $_POST['recherche'];
        $request = Database::getInstance()->query("SELECT * FROM categorie WHERE nom LIKE '%$recherche%'");
        $data = $request->fetchAll();
        if($data == false) $_SESSION['alert'] = Main::alert('danger', 'Aucune catégorie trouvée');
        else $_SESSION['alert'] = '';
        return $data;
    }

    public static function deleteCategorie($id_categorie)
    {
        $request = Database::getInstance()->prepare('DELETE FROM categorie WHERE id_categorie = :id');
        $request->execute(array(
            'id' => $id_categorie,
        ));
    }

    public static function isCategorieIdExist($id)
    {
        $request = Database::getInstance()->prepare('SELECT id_categorie FROM categorie WHERE id_categorie = :id');
        $request->execute(array(
            'id' => $id
        ));

        return $request->rowCount() >= 1;
    }

    public static function updateCategorie(string $nom, int $id)
    {
        $request = Database::getInstance()->prepare('UPDATE categorie SET nom = :categorie_nom WHERE id_categorie = :id');
        $request->execute(array(
            'categorie_nom' => $nom,
            'id' => $id
        ));
    }
}

?>