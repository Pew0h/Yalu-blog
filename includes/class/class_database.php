<?php

class Database
{
    private static $pdo = null;

    /**
     * Fonction qui retourne une instance de la base de donnée
     * @return PDO
     */
    public static function getInstance(): PDO
    {
        if (self::$pdo === null) {
            try {
                $config = parse_ini_file(__DIR__ . '../../config/database.ini');
                $dsn = 'mysql:dbname=' . $config['db_name'] . ';host=' . $config['db_host'];
                $user = $config['db_user'];
                $password = $config['db_password'];

                self::$pdo = new PDO($dsn, $user, $password);
                echo "Construction PDO";
            } catch (PDOException $e) {
                echo 'Connexion échouée : ' . $e->getMessage();
            }
        }

        return self::$pdo;
    }
}
