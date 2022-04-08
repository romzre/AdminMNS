<?php 
require_once 'PdoManager.php';
require '../app/Entity/User.php';

class UserManager {

    use PdoManager; 
    
    /**
     * getAll
     *
     * @return void
     */
    public function getAllUsers()
    {
        $pdo=PdoManager::getPdo();
        
        $sql= 'SELECT * FROM users';
        $req = $pdo->prepare($sql);
        $req->execute();
        
        $users = $req->fetchAll(PDO::FETCH_ASSOC);
        
        return $users;
    }
    
    /**
     * get
     *
     * @param  mixed $email
     * @return void
     */
    public function getUserByEmail(string $email)
    {
        $pdo=PdoManager::getPdo();
        $sql= 'SELECT * FROM users WHERE email_user=:email_user';

        $req = $pdo->prepare($sql);
        $req->execute([
            'email_user'=>$email
        ]);
        
        $user = $req->fetch(PDO::FETCH_ASSOC);
        
        return $user;
    }

    public function getUserById(string $id_user)
    {
        $pdo=PdoManager::getPdo();
        $sql= 'SELECT * FROM users WHERE id_user=:id_user';

        $req = $pdo->prepare($sql);
        $req->execute([
            'id_user'=>$id_user
        ]);
        
        $user = $req->fetch(PDO::FETCH_ASSOC);
        $obj = new User($user);
        return $obj;
    }


}