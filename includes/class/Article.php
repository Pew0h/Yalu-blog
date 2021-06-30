<?php
class Article
{
    public static function getNumberArticles()
    {
        $request = Database::getInstance()->query('SELECT count(*) FROM article');
        return $request->fetch()[0];
    }
    public static function getNumberArticlesWithCategory(int $id)
    {
        $request = Database::getInstance()->query("SELECT count(*) FROM article WHERE id_categorie = '$id'");
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

    public static function getArticlesIndex(?int $id)
    {
        if ($id)
            $SQL = "SELECT *, categorie.nom as categorie_nom, DATE_FORMAT(article.date_creation, '%d/%m/%Y') as date_creation FROM article 
                                                   LEFT OUTER JOIN categorie ON article.id_categorie = categorie.id_categorie
                                                   LEFT OUTER JOIN utilisateur ON article.id_utilisateur = utilisateur.id_utilisateur
                                                   WHERE categorie.id_categorie = '$id'";
        else
            $SQL = "SELECT *, categorie.nom as categorie_nom, DATE_FORMAT(article.date_creation, '%d/%m/%Y') as date_creation FROM article 
                                                   LEFT OUTER JOIN categorie ON article.id_categorie = categorie.id_categorie
                                                   LEFT OUTER JOIN utilisateur ON article.id_utilisateur = utilisateur.id_utilisateur";
        $request = Database::getInstance()->query($SQL);
        $data = $request->fetchAll();
        if($data == false) $_SESSION['alert'] = Main::alert('danger', 'Aucun article trouvé');
        else $_SESSION['alert'] = '';
        return $data;
    }

    public static function getArticlesList(?int $id)
    {
        if (isset($_POST['page']))
            $limit = $_POST['page'] + 2;
        else
            $limit = 2;
        if ($id)
            $SQL = "SELECT *, categorie.nom as categorie_nom, DATE_FORMAT(article.date_creation, '%d/%m/%Y') as date_creation FROM article 
                                                   LEFT OUTER JOIN categorie ON article.id_categorie = categorie.id_categorie
                                                   LEFT OUTER JOIN utilisateur ON article.id_utilisateur = utilisateur.id_utilisateur
                                                   WHERE categorie.id_categorie = '$id' LIMIT $limit";
        else
            $SQL = "SELECT *, categorie.nom as categorie_nom, DATE_FORMAT(article.date_creation, '%d/%m/%Y') as date_creation FROM article 
                                                   LEFT OUTER JOIN categorie ON article.id_categorie = categorie.id_categorie
                                                   LEFT OUTER JOIN utilisateur ON article.id_utilisateur = utilisateur.id_utilisateur LIMIT $limit";
        $request = Database::getInstance()->query($SQL);
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

    public static function getRandomId(int $id, int $id_cat)
    {
        $randomId = Database::getInstance()->prepare("SELECT id_article FROM article WHERE id_article != :id AND id_categorie = :id_cat ORDER BY RAND() LIMIT 1 ");
        $randomId->execute(array(
            'id' => $id,
            'id_cat' => $id_cat
        ));
        $data = $randomId->fetchAll();
        return $data[0]['id_article'];

    }

    public static function getArticleByCategorie(int $id, int $id_cat)
    {
        $randomId = Database::getInstance()->prepare("SELECT * FROM article WHERE id_article != :id AND id_categorie = :id_cat");
        $randomId->execute(array(
            'id' => $id,
            'id_cat' => $id_cat
        ));
        $data = $randomId->fetchAll();
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

    public static function insertArticle(string $titre, string $contenu, ?string $image, int $id_categorie, int $id_utilisateur)
    {
        $database = Database::getInstance();
        $request = $database->prepare('INSERT INTO article(titre, contenu, image, id_categorie, id_utilisateur) VALUES (:titre, :contenu, :image, :id_categorie, :id_utilisateur)');
        $request->execute(array(
            'titre' => $titre,
            'contenu' => $contenu,
            'image' => $image,
            'id_categorie' => $id_categorie,
            'id_utilisateur' => $id_utilisateur,
        ));
    }

    public static function updateArticle(int $id_article, string $titre, string $contenu, int $id_categorie)
    {
        $database = Database::getInstance();
        $request = $database->prepare('UPDATE article SET titre = :titre, contenu = :contenu, id_categorie = :id_categorie WHERE id_article = :id_article');
        $request->execute(array(
            'id_article' => $id_article,
            'titre' => $titre,
            'contenu' => $contenu,
            'id_categorie' => $id_categorie
        ));
    }

    public static function getArticleInformation(int $id, string $colonne) : string
    {
        $database = Database::getInstance();
        $request = $database->prepare('SELECT '.$colonne.' FROM article WHERE id_article = :id');
        $request->execute(array(
            'id' => $id
        ));
        while($data = $request->fetch()){
            return $data[$colonne];
        }
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