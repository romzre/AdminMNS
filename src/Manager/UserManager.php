<?php 

namespace App\Manager;

use PDO;
use App\Entity\User;
use App\Manager\PdoManager;

// require_once 'PdoManager.php';
// require_once '../src/Entity/User.php';


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
        $pdo=PdoManager::getPdo();
        $sql= 'SELECT * FROM users WHERE email=:email';

        $req = $pdo->prepare($sql);
        $req->execute([
            'email'=>$email
        ]);
        
        $user = $req->fetch(PDO::FETCH_ASSOC);

        // $obj = (new User())->hydrate($user);
        // return $obj;
        return $user;
    }

    public function insertRegister(array $dataRegister)
    {

        $pdo=PdoManager::getPdo();
        
        $sql= "INSERT INTO `trainee`(`id_user`, `birthdate`,  `tel`, `laneType`, `street`, `addressComplement`, `postalCode`, `city`, `streetNumber`, `completeDossier`, isActive ,`isRegistered`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
        
        $req = $pdo->prepare($sql);
        $stmt = $req->execute($dataRegister);
        
        return $stmt; 

    }

    public function insertTraineeTraining($id_user , $id_training)
    {

        $pdo=PdoManager::getPdo();
        
        $sql= "INSERT INTO `trainee_training`(`id_user`, `id_training`) VALUES (:id_user,:id_training)";
        
        $req = $pdo->prepare($sql);
        $stmt = $req->execute(
            [
                'id_user' => $id_user,
                'id_training' => $id_training
            ]
        );
        
        return $stmt ; 

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
        $sql= 'INSERT INTO `users`( `firstName`, `familyName`, `email`, `password`) VALUES (:firstName,:familyName,:email,:password)';

        $req = $pdo->prepare($sql);
        $req->execute($dataUser);

        $id = $pdo->lastInsertId();

        return $id;



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
        $obj = (new User())->hydrate($user);
        return $obj;
 
    }

    public function updatePassword (string $password, string $email)
    {
        $pdo=PdoManager::getPdo();
        $sql= 'UPDATE `users` SET `password`= :password WHERE email = :email';

        $req = $pdo->prepare($sql);
        $req->execute([
            'email'=>$email,
            'password'=>$password,
        ]);
    }


}