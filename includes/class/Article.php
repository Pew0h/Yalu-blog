<?php
class Article
{
    public static function getNumberArticles()
    {
        $request = Database::getInstance()->query('SELECT count(*) FROM article');
        return $request->fetch()[0];
    }
}

?>