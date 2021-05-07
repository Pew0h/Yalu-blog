<?php
class Role
{
    public static function selectRoles()
    {
        $database = Database::getInstance();
        $request = $database->query("SELECT * FROM role WHERE nom != 'Administrateur'");
        return $request->fetchAll();
    }

    public static function insertRole(string $nom)
    {
        $database = Database::getInstance();
        $request = $database->prepare('INSERT INTO role(nom) VALUES (:role_nom)');
        $request->execute(array(
            'role_nom' => $nom
        ));
    }

    function updateRole(int $id, string $nom)
    {
        $database = Database::getInstance();
        $request = $database->prepare('UPDATE role SET nom = :role_nom WHERE id_role = :role_id');
        $request->execute(array(
            'role_nom' => $nom,
            'role_id' => $id
        ));
    }

    function deleteRole(int $id)
    {
        $database = Database::getInstance();
        $request = $database->prepare('DELETE FROM role WHERE id_role = :role_id');
        $request->execute(array(
            'role_id' => $id
        ));
    }

}

?>