<?php

namespace App\Manager;

use PDO;
use PDOException;

trait PdoManager
{
    protected static $pdo;


    /**
     * get database connexion 
     *
     * @return PDO
     */
    public static function getPdo(): PDO
    {

        // On instance la méthode seulement si pdo n'est pas encore initialisé. C'est ce qu'on appelle un "Singleton"

        if (self::$pdo == null) {
            try {

                self::$pdo = new PDO('mysql:host=51.77.211.62:3306;dbname=adminMns2', 'kyoko9273', 'Spedum1463!');
            } catch (PDOException $e) {
                echo 'Error : ' . $e->getMessage();
                die;
            }
        }
        return self::$pdo;
    }
}
