<?php
    trait PdoManager{
        protected static $pdo;
    
    
    public static function getPdo()
    {

        // On instance la méthode seulement si pdo n'est pas encore initialisé. C'est ce qu'on appelle un "Singleton"

        if(self::$pdo == null)
        {
            try{
                
<<<<<<< HEAD
                self::$pdo = new PDO('mysql:host=88.166.155.219:3306;dbname=adminMns','kyoko9273','Spedum1463!');
=======
                self::$pdo = new PDO('mysql:host=88.166.155.219:3306;dbname=adminMns','kyoko9273','Spedum1463!',);
                
>>>>>>> 583bd7346b3d72fb915e9b4d33174664658af3b4
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