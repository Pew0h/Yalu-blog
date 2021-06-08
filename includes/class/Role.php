<?php
class Role
{
    public static function selectUserRole(string $userRole): array
    {
        $request = Database::getInstance()->query("SELECT * FROM role WHERE id_role = $userRole");
        return $request->fetchAll();
    }
    public static function selectOtherRoles(int $userRole): array
    {
        $request = Database::getInstance()->query("SELECT * FROM role WHERE id_role != $userRole");
        return $request->fetchAll();
    }
    public static function selectAllRoles(): array
    {
        $request = Database::getInstance()->query("SELECT * FROM role");
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

    public static function updateRole(string $nom, int $id)
    {
        $database = Database::getInstance();
        $request = $database->prepare('UPDATE role SET nom = :role_nom WHERE id_role = :role_id');
        $request->execute(array(
            'role_nom' => utf8_decode(ucwords($nom)),
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
    public static function getRoles($recherche = '')
    {
        if (isset($_POST['recherche'])) $recherche = $_POST['recherche'];
        $request = Database::getInstance()->query("SELECT * FROM role WHERE nom LIKE '%$recherche%'");
        $data = $request->fetchAll();
        if($data == false) $_SESSION['alert'] = Main::alert('danger', 'Aucun rôle trouvé');
        else $_SESSION['alert'] = '';
        return $data;
    }

    public static function isRoleIdExist($id)
    {
        $request = Database::getInstance()->prepare('SELECT id_role FROM role WHERE id_role = :id');
        $request->execute(array(
            'id' => $id
        ));
        return $request->rowCount() >= 1;
    }

    public static function isInformationExistAdmin(string $nom, int $id): bool
    {
        $request = Database::getInstance()->prepare('SELECT nom FROM role WHERE nom = :nom AND id_role != :id');
        $request->execute(array(
            'nom' => utf8_decode($nom),
            'id' => $id
        ));

        return $request->rowCount() >= 1;
    }
    public static function isInformationExist(string $nom): bool
    {
        $database = Database::getInstance();
        $request = $database->prepare('SELECT nom FROM role WHERE nom = :role_nom');
        $request->execute(array(
            'role_nom' => $nom,
        ));

        return $request->rowCount() >= 1;
    }


    public static function getRoleName(int $id)
    {
        $database = Database::getInstance();
        $request = $database->prepare('SELECT nom FROM role WHERE id_role = :id');
        $request->execute(array(
            'id' => $id,
        ));

        while($data = $request->fetch()){
            return $data['nom'];
        }
    }
}

?>