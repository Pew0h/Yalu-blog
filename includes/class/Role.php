<?php
class Role
{
    public static function selectRoles()
    {
        $database = Database::getInstance();
        $request = $database->query("SELECT * FROM role WHERE nom != 'Administrateur'");
        return $request->fetchAll();
    }
}

?>