<?php
class Commentaire
{
    public static function getNumberCommentaires()
    {
        $request = Database::getInstance()->query('SELECT count(*) FROM commentaire');
        return $request->fetch()[0];
    }
}

?>