<?php
class Article
{
    public static function getNumberArticles()
    {
        $request = Database::getInstance()->query('SELECT count(*) FROM article');
        return $request->fetch()[0];
    }

    public static function getArticles($recherche = '')
    {
        if (isset($_POST['recherche'])) $recherche = $_POST['recherche'];
        $request = Database::getInstance()->query("SELECT *, categorie.nom as categorie_nom, DATE_FORMAT(article.date_creation, '%d/%m/%Y') as date_creation FROM article 
                                                   LEFT OUTER JOIN categorie ON article.id_categorie = categorie.id_categorie
                                                   LEFT OUTER JOIN utilisateur ON article.id_utilisateur = utilisateur.id_utilisateur
                                                   WHERE article.titre LIKE '%$recherche%' OR categorie.nom LIKE '%$recherche%' 
                                                   OR utilisateur.pseudo LIKE '%$recherche%'");
        $data = $request->fetchAll();
        if($data == false) $_SESSION['alert'] = Main::alert('danger', 'Aucun article trouvé');
        else $_SESSION['alert'] = '';
        return $data;
    }

    public static function truncate($string, $max_length = 30, $replacement = '', $trunc_at_space = false)
    {
        $max_length -= strlen($replacement);
        $string_length = strlen($string);
        if($string_length <= $max_length)
            return $string;
        if( $trunc_at_space && ($space_position = strrpos($string, ' ', $max_length-$string_length)) )
            $max_length = $space_position;
        return substr_replace($string, $replacement, $max_length);
    }

    public static function getRandomId()
    {
        $randomId = Database::getInstance()->query("SELECT id_article FROM article ORDER BY RAND() LIMIT 1");

        $data = $randomId->fetch();
        return $data;

    }

    public static function getArticleById(int $id)
    {
        $request = Database::getInstance()->prepare("SELECT *, categorie.nom as categorie_nom, DATE_FORMAT(article.date_creation, '%d/%m/%Y') as date_creation  FROM article 
                                                                    LEFT OUTER JOIN categorie ON article.id_categorie = categorie.id_categorie
                                                                    LEFT OUTER JOIN utilisateur ON article.id_utilisateur = utilisateur.id_utilisateur 
                                                                    WHERE id_article = :id ");
        $request->execute(array(
            'id' => $id
        ));

        $data = $request->fetch();
        return $data;



    }

    public static function deleteArticle($id_article)
    {
        $request = Database::getInstance()->prepare('DELETE FROM article WHERE id_article = :id');
        $request->execute(array(
            'id' => $id_article,
        ));
    }

}

?>