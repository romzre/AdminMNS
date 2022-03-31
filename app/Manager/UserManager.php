<?php 
require 'PdoManager.php';
class UserManager {

    use PdoManager; 
    
    /**
     * getAll
     *
     * @return void
     */
    public function getAll()
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
    public function get(string $email)
    {
        $pdo=PdoManager::getPdo();
        $sql= 'SELECT * FROM users WHERE email_user=:email_user';

        $req = $pdo->prepare($sql);
        $req->execute([
            'email_user'=>$email
        ]);
        
        $user = $req->fetch(PDO::FETCH_ASSOC);
        // var_dump($req);exit;
        // var_dump($user);exit;
        
        return $user;
    }
}