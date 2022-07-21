<?php

namespace App\Manager;

use PDO;
use App\Entity\User;
use App\Manager\PdoManager;



class UserManager
{

    use PdoManager;

    /**
     * getAll
     *
     * @return void
     */
    public function getAllUsers()
    {
        $pdo = PdoManager::getPdo();

        $sql = 'SELECT * FROM users';
        $req = $pdo->prepare($sql);
        $req->execute();

        $users = $req->fetchAll(PDO::FETCH_ASSOC);

        foreach ($users as $user) {
            $obj[] = (new User($user))->hydrate($user);
        }
        return $obj;
    }

    /**
     * get
     *
     * @param  mixed $email
     * @return void
     */
    public function getUserByEmail(string $email)
    {
        $pdo = PdoManager::getPdo();
        $sql = 'SELECT * FROM users WHERE email=:email';

        $req = $pdo->prepare($sql);
        $req->execute([
            'email' => $email
        ]);

        $user = $req->fetch(PDO::FETCH_ASSOC);

        // $obj = (new User())->hydrate($user);
        // return $obj;
        return $user;
    }

    /**
     * checkEmailAddress
     *
     * check if an email address already exists in the DB
     * 
     * @param  string $email
     * @return object
     */
    public function checkEmailAddress($email)
    {


        $pdo = PdoManager::getPdo();

        $sql = "SELECT email from users where email=:email";

        $req = $pdo->prepare($sql);
        $req->execute([
            'email' => $email
        ]);

        $user = $req->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $res = ["isExistant" => true];
        } else {
            $res = ["isExistant" => false];
        }
        return $res;
    }

    public function insertRegister(array $dataRegister)
    {

        $pdo = PdoManager::getPdo();

        $sql = "INSERT INTO `trainee`(`id_user`, `birthdate`, `tel`, `laneType`, `street`, `addressComplement`, `postalCode`, `city`, `streetNumber` , `completeDossier` , `isActive`, `isRegistered`) VALUES (:id_user, :birthdate, :tel, :laneType, :street , :addressComplement , :postalCode , :city , :streetNumber , :completeDossier , :isActive , :isRegistered)";


        $req = $pdo->prepare($sql);
        $stmt = $req->execute($dataRegister);

        return $stmt;
    }

    public function insertTraineeTraining($id_user, $id_training)
    {

        $pdo = PdoManager::getPdo();

        $sql = "INSERT INTO `trainee_training`(`id_user`, `id_training`) VALUES (:id_user,:id_training)";

        $req = $pdo->prepare($sql);
        $stmt = $req->execute(
            [
                'id_user' => $id_user,
                'id_training' => $id_training
            ]
        );

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
        $pdo = PdoManager::getPdo();
        $sql = 'INSERT INTO `users`( `firstName`, `familyName`, `email`, `password`) VALUES (:firstName,:familyName,:email,:password)';

        $req = $pdo->prepare($sql);
        $req->execute($dataUser);

        $id = $pdo->lastInsertId();

        return $id;
    }

    public function getUserById(string $id_user)
    {
        $pdo = PdoManager::getPdo();
        $sql = 'SELECT * FROM users WHERE id_user=:id_user';

        $req = $pdo->prepare($sql);
        $req->execute([
            'id_user' => $id_user
        ]);

        $user = $req->fetch(PDO::FETCH_ASSOC);
        $obj = (new User())->hydrate($user);
        return $obj;
    }

    public function updatePassword(string $password, string $email)
    {
        $pdo = PdoManager::getPdo();
        $sql = 'UPDATE `users` SET `password`= :password WHERE email = :email';

        $req = $pdo->prepare($sql);
        $req->execute([
            'email' => $email,
            'password' => $password,
        ]);
    }

    public function updatePicture(string $profile_pic, string $id_user)
    {

        $pdo = PdoManager::getPdo();
        $sql = 'UPDATE `users` SET `profile_pic`= :profile_pic WHERE id_user = :id_user';

        $req = $pdo->prepare($sql);
        $stmt = $req->execute([
            'id_user' => $id_user,
            'profile_pic' => $profile_pic,
        ]);

        return $stmt;
    }

    public function deletePicture(string $id_user)

    {
        $pdo = PdoManager::getPdo();
        $sql = 'UPDATE `users` SET `profile_pic`= NULL WHERE id_user = :id_user';

        $req = $pdo->prepare($sql);
        $stmt = $req->execute([
            'id_user' => $id_user
        ]);

        return $stmt;
    }

    public function updateUserInfo(string $firstName, string $lastName, string $email, string $id_user)
    {

        $pdo = PdoManager::getPdo();
        $sql = 'UPDATE `users` SET `firstName`= :firstName, `familyName`= :familyName, `email`= :email WHERE id_user = :id_user';

        $req = $pdo->prepare($sql);
        $stmt = $req->execute([
            'id_user' => $id_user,
            'firstName' => $firstName,
            'familyName' => $lastName,
            'email' => $email,

        ]);

        return $stmt;
    }
}
