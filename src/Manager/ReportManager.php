<?php 

require_once 'PdoManager.php';

class ReportManager {

    use PdoManager;

   

    public static function getPdo()
    {

        // On instance la méthode seulement si pdo n'est pas encore initialisé. C'est ce qu'on appelle un "Singleton"

        if(self::$pdo == null)
        {
            try{

                self::$pdo = new PDO('mysql:host=88.166.155.219:3306;dbname=adminMns','kyoko9273','Spedum1463!');

            }
            catch (PDOException $e)
            {
                echo 'Error : ' . $e->getMessage();
                die;
            }
        }
        return self::$pdo;
    }
}