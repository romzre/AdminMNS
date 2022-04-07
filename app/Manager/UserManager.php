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

        return $user;
    }

    public function insertRegister(array $dataRegister,array $dataUser)
    {
      
        $id  = self::insertUser($dataUser);
       $dataRegister ['id_user'] = $id;
       $dataRegister ['isRegister'] = '0';
       $test = [
           'id_user' => $id,
           'isRegister' => '0'
       ];
        // var_dump($dataRegister); exit;
        $pdo=PdoManager::getPdo();
        $sql= "INSERT INTO `trainee`(
            `id_user`,
            `birthdate`,
            )
            VALUES (
            :id_user,
            :birtdate,
            -- :tel,
            -- :laneType,
            -- :street,
            -- :addressComplement,
            -- :postalCode,
            -- :city,
            -- :streetNumber,
            -- :isRegister
            )";
        $req = $pdo->prepare($sql);
        $stmt = $req->execute($test);

        return $stmt;

    }


    /**
     * insertUser
     *
     * @param  mixed $dataUser
     * @return void
     */
    public static function insertUser(array $dataUser)
    {
        $pdo=PdoManager::getPdo();
        $sql= 'INSERT INTO `users`( `firstName_user`, `familyName_user`, `email_user`, `password_user`) VALUES (:firstName_user,:familyName_user,:email_user,:password_user)';

        $req = $pdo->prepare($sql);
        $req->execute($dataUser);

        $id = $pdo->lastInsertId();
        return $id;



    }

}