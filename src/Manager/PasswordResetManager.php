<?php 
namespace App\Manager;

use PDO;
// require_once 'PdoManager.php';
class PasswordResetManager {

    use PdoManager; 
    
    /**
     * getAll
     *
     * @return void
     */
    public function createPasswordResetTemp(string $email, string $key, string $expDate)
    {
        $pdo=PdoManager::getPdo();
        
        $sql= "INSERT INTO `password_reset_temp` (`email`, `key`, `expDate`)
        VALUES (:email, :key, :expDate)";
        $req = $pdo->prepare($sql);
        $req->execute([
            'email'=>$email,
            'key'=>$key,
            'expDate'=>$expDate
        ]);
        
    }
    
    public function keyCheck (string $email, string $key)
    {
        $pdo=PdoManager::getPdo();
        $sql= 'SELECT * FROM `password_reset_temp` WHERE `key`= :key and `email`= :email';

        $req = $pdo->prepare($sql);
        $req->execute([
            'email'=>$email,
            'key'=>$key,
        ]);
        
        $key= $req->fetch(PDO::FETCH_ASSOC);
        
        return $key;
    }

    public function deleteKey (string $email)
    {
        $pdo=PdoManager::getPdo();
        $sql= 'DELETE FROM `password_reset_temp` WHERE `email`= :email';

        $req = $pdo->prepare($sql);
        $req->execute([
            'email'=>$email,
        ]);
        
    }


}