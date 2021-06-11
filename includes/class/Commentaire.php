<?php
class Commentaire
{
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

        $request = Database::getInstance()->prepare("SELECT *, DATE_FORMAT(commentaire.date_creation, '%d/%m/%Y') as date_creation FROM commentaire LEFT OUTER JOIN utilisateur ON commentaire.id_utilisateur = utilisateur.id_utilisateur WHERE id_article = :id ");

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
                                                   WHERE commentaire.commentaire LIKE '%$recherche%' OR utilisateur.pseudo LIKE '%$recherche%'");
        $data = $request->fetchAll();
        if($data == false) $_SESSION['alert'] = Main::alert('danger', 'Aucun comementaire trouvé');
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
}

?>