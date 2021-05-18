<?php
require('Database.php');
class User
{
    public static function insertUser(string $prenom, string $nom, string $pseudo, string $email, string $password, int $role)
    {
        $database = Database::getInstance();
        $request = $database->prepare('INSERT INTO utilisateur(prenom, nom, `pseudo`, `mot_de_passe`, email, id_role, date_inscription) VALUES (:user_prenom, :user_nom, :user_pseudo, :user_password, :user_email, :user_role, :user_inscription)');
        $hashPassword = hash('sha512', $password);
        //echo $hashPassword;
        $request->execute(array(
            'user_prenom' => $prenom,
            'user_nom' => $nom,
            'user_pseudo' => $pseudo,
            'user_password' => $hashPassword,
            'user_email' => $email,
            'user_inscription' => date('Y-m-d'),
            'user_role' => $role
        ));
    }
    
    public static function isUserExist(string $pseudo, string $password) : bool
    {
        $database = Database::getInstance();
        $hashPassword = hash('sha512', $password);
        $request = $database->prepare('SELECT `pseudo`, `mot_de_passe` FROM utilisateur WHERE `pseudo`= :user_pseudo AND `mot_de_passe` = :user_password');
        $request->execute(array(
            'user_pseudo' => $pseudo,
            'user_password' => $hashPassword
        ));

        return $request->rowCount() >= 1;
    }

    public static function getUserId(string $pseudo, string $password) : int
    {
        $database = Database::getInstance();
        $hashPassword = hash('sha512', $password);
        $request = $database->prepare('SELECT id_utilisateur FROM utilisateur WHERE `pseudo`= :user_pseudo AND `mot_de_passe` = :user_password');
        $request->execute(array(
            'user_pseudo' => $pseudo,
            'user_password' => $hashPassword
        ));
        while($data = $request->fetch()){
            return $data['id_utilisateur'];
        }
    }

    public static function getUserInformation(int $id, string $colonne) : string
    {
        $database = Database::getInstance();
        $request = $database->prepare('SELECT '.$colonne.' FROM utilisateur WHERE id_utilisateur = :id');
        $request->execute(array(
            'id' => $id
        ));
        while($data = $request->fetch()){
            return $data[$colonne];
        }
    }

    public static function isInformationExist(string $pseudo, string $email) : bool
    {
        $database = Database::getInstance();
        $request = $database->prepare('SELECT `pseudo`, email FROM utilisateur WHERE `pseudo`= :user_pseudo OR email = :user_email');
        $request->execute(array(
            'user_pseudo' => $pseudo,
            'user_email' => $email
        ));

        return $request->rowCount() >= 1;
    }

    public static function updateUser(string $nom, string $prenom, int $id)
    {
        $request = Database::getInstance()->prepare('UPDATE utilisateur SET nom = :user_nom, prenom = :user_prenom WHERE id_utilisateur = :user_id');
        $request->execute(array(
            'user_nom' => $nom,
            'user_prenom' => $prenom,
            'user_id' => $id
        ));
    }

    public static function updateUserPassword(string $password, int $id)
    {
        $request = Database::getInstance()->prepare('UPDATE utilisateur SET mot_de_passe = :user_password WHERE id_utilisateur = :user_id');
        $request->execute(array(
            'user_password' => hash('sha512',$password),
            'user_id' => $id
        ));
    }

    public static function getNumberUsers()
    {
        $request = Database::getInstance()->query('SELECT count(*) FROM utilisateur');
        return $request->fetch()[0];
    }

    public static function getUsers($recherche = '')
    {
        if (isset($_POST['recherche'])) $recherche = $_POST['recherche'];
        $request = Database::getInstance()->query("SELECT * FROM utilisateur WHERE prenom LIKE '%$recherche%' OR nom LIKE '%$recherche%'");
        $data = $request->fetchAll();
        if($data == false) $_SESSION['alert'] = Main::alert('danger', 'Aucun utilisateur trouvé');
        else $_SESSION['alert'] = '';
        return $data;
    }

    public static function deleteUser($id_utilisateur)
    {
        $request = Database::getInstance()->prepare('DELETE FROM utilisateur WHERE id_utilisateur = :id');
        $request->execute(array(
            'id' => $id_utilisateur,
        ));
    }
}

?>