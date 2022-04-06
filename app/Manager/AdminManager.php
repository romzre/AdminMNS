<?php

class AdminManager {

    
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
}