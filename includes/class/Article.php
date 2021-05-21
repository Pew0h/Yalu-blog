<?php
class Article
{
    public static function getNumberArticles()
    {
        $request = Database::getInstance()->query('SELECT count(*) FROM article');
        return $request->fetch()[0];
    }

    public static function getArticles()
    {
        $request = Database::getInstance()->query('SELECT * FROM article LEFT OUTER JOIN categorie ON article.id_categorie = categorie.id_categorie');
        return $request->fetchAll();
    }

}

?>