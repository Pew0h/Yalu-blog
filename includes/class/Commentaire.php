<?php
class Commentaire
{


    public static function InsertCommentaire(string $commentaire, string $id_article, string $id_utilisateur ){

        $database = Database::getInstance();
        $request = $database->prepare('INSERT INTO commentaire(commentaire, id_article, id_utilisateur, date_creation) VALUES (:commentaire, :id_article, :id_utilisateur, :date_creation)');
        $request->execute(array(
            'commentaire' => $commentaire,
            'id_article' => $id_article,
            'id_utilisateur' => $id_utilisateur,
            'date_creation' => date('Y-m-d')
        ));

    }

    public static function updateCommentaire(string $commentaire, int $id){

        $request = Database::getInstance()->prepare('UPDATE commentaire SET commentaire = :commentaire WHERE id_commentaire = :id');
        $request->execute(array(
            'commentaire' => $commentaire,
            'id' => $id
        ));
    }

    public static function isCommentaireIdExist($id)
    {
        $request = Database::getInstance()->prepare('SELECT id_commentaire FROM commentaire WHERE id_commentaire = :id');
        $request->execute(array(
            'id' => $id
        ));

        return $request->rowCount() >= 1;
    }

    public static function getNumberCommentaires()
    {
        $request = Database::getInstance()->query('SELECT count(*) FROM commentaire');
        return $request->fetch()[0];
    }
    public static function getNumberCommentairesArticle($id_article)
    {
        $request = Database::getInstance()->prepare('SELECT count(*) FROM commentaire WHERE id_article = :id');
        $request->execute(array(
            'id' => $id_article
        ));
        return $request->fetch()[0];
    }

    public static function getCommentairesArticle($id_article)
    {

        $request = Database::getInstance()->prepare("SELECT *, DATE_FORMAT(commentaire.date_creation, '%d/%m/%Y') as date_creation 
                                                     FROM commentaire 
                                                     LEFT OUTER JOIN utilisateur ON commentaire.id_utilisateur = utilisateur.id_utilisateur 
                                                     WHERE id_article = :id ");

        $request->execute(array(
            'id' => $id_article
        ));
        $data = $request->fetchAll();
        return $data;
    }

    public static function getCommentaires($recherche = '')
    {
        if (isset($_POST['recherche'])) $recherche = $_POST['recherche'];
        $request = Database::getInstance()->query("SELECT *, DATE_FORMAT(commentaire.date_creation, '%d/%m/%Y') as date_creation FROM commentaire 
                                                   LEFT OUTER JOIN utilisateur ON commentaire.id_utilisateur = utilisateur.id_utilisateur
                                                   LEFT OUTER JOIN article ON article.id_article = commentaire.id_article
                                                   WHERE commentaire.commentaire LIKE '%$recherche%' OR utilisateur.pseudo LIKE '%$recherche%'");
        $data = $request->fetchAll();
        if($data == false) $_SESSION['alert'] = Main::alert('danger', 'Aucun commentaire trouvé');
        else $_SESSION['alert'] = '';
        return $data;
    }

    public static function deleteCommentaire($id_commentaire)
    {
        $request = Database::getInstance()->prepare('DELETE FROM commentaire WHERE id_commentaire = :id');
        $request->execute(array(
            'id' => $id_commentaire,
        ));
    }

    public static function getCommentairesById($id)
    {
        $database = Database::getInstance();
        $request = $database->prepare('SELECT commentaire, id_article FROM commentaire WHERE id_commentaire = :id');
        $request->execute(array(
            'id' => $id,
        ));

        $data = $request->fetchAll();
        return $data;
    }
}

?>