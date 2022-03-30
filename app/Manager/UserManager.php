<?php 
require 'PdoManager.php';
class UserManager {

    use PdoManager; 

    public function getAll()
    {
        $sql= 'SELECT * FROM users';
    }

    public function get(string $email)
    {
        $pdo=PdoManager::getPdo();
        $sql= 'SELECT * FROM users WHERE email_user=:email_user';

        $req = $pdo->prepare($sql);
        $req->execute([
            'email_user'=>$email
        ]);
        
        $user = $req->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($req);exit;
        var_dump($user,$email);exit;
        
        return $user;
    }
}