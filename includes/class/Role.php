<?php
class Role
{
    public static function selectRoles(): array
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
            'role_nom' => ucwords($nom)
        ));
    }

    public static function updateRole(int $id, string $nom)
    {
        $database = Database::getInstance();
        $request = $database->prepare('UPDATE role SET nom = :role_nom WHERE id_role = :role_id');
        $request->execute(array(
            'role_nom' => ucwords($nom),
            'role_id' => $id
        ));
    }

    public static function deleteRole(int $id)
    {
        $database = Database::getInstance();
        $request = $database->prepare('DELETE FROM role WHERE id_role = :role_id');
        $request->execute(array(
            'role_id' => $id
        ));
    }

    public static function isRoleExist(int $nom): bool
    {
        $database = Database::getInstance();
        $request = $database->prepare('SELECT nom FROM role WHERE nom = :role_nom');
        $request->execute(array(
            'role_nom' => ucwords($nom)
        ));
        return $request->rowCount() >= 1;
    }

    public static function getUserRole(int $id): string
    {
        $database = Database::getInstance();
        $request = $database->prepare('SELECT role.nom FROM role LEFT OUTER JOIN utilisateur on utilisateur.id_role = role.id_role WHERE utilisateur.id_utilisateur = :user_id');
        $request->execute(array(
            'user_id' => $id
        ));
        while($data = $request->fetch()){
            return $data['nom'];
        }
    }


}

?>