<?php
require('Database.php');
class User
{
    public static function insertUser(string $prenom, string $nom, string $pseudo, string $email, string $password, int $role)
    {
        $database = Database::getInstance();
        $request = $database->prepare('INSERT INTO utilisateur(prenom, nom, `pseudo`, `mot_de_passe`, email, id_role, date_inscription) VALUES (:user_prenom, :user_nom, :user_pseudo, :user_password, :user_email, :user_role, :user_inscription)');
        $hashPassword = hash('sha512', $password);
        echo $hashPassword;
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
}

?>