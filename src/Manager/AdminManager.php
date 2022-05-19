<?php
namespace App\Manager;

use PDO;
use App\Manager\UserManager;
// require_once 'UserManager.php';

class AdminManager extends UserManager{

    
    /**
     * getAll
     *
     * @return void
     */
    public function getAll()
    {
        $pdo=PdoManager::getPdo();
        
        $sql= 'SELECT * FROM admin';
        $req = $pdo->prepare($sql);
        $req->execute();
        
        $admins = $req->fetchAll(PDO::FETCH_ASSOC);
        
        return $admins;
    }
    
    /**
     * get
     *
     * @param  mixed $email
     * @return void
     */
    public function get(string $id_user)
    {
        $pdo=PdoManager::getPdo();
        $sql= 'SELECT * FROM admin WHERE id_user=:id_user';

        $req = $pdo->prepare($sql);
        $req->execute([
            'id_user'=>$id_user
        ]);
        
        $admin = $req->fetch(PDO::FETCH_ASSOC);
        
        return $admin;
    }

    public function updateRegisteredToCandidate($id)
    {
        $pdo=PdoManager::getPdo();
        $sql= 'UPDATE trainee SET isRegistered = 1 WHERE id_user=:id_user';

        $req = $pdo->prepare($sql);
        $stmt = $req->execute([
            'id_user' => $id
        ]);

        return $stmt;
       
    }
}