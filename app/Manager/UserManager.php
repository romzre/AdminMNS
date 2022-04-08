
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

    public function insertRegister(array $dataRegister)
    {

        // var_dump($dataRegister); exit;
        $pdo=PdoManager::getPdo();
        // $sql= "INSERT INTO `trainee`(`id_user`, `birthdate`,  `tel`, `laneType`, `street`, `addressComplement`, `postalCode`, `city`, `streetNumber`, `completeDossier`,`isRegister`) VALUES (:id_user,':birthdate',':tel',':laneType',':street',':addressComplement',':postalCode',':city',':streetNumber',:completeDossier,:isRegister)";
        $sql= "INSERT INTO `trainee`(`id_user`, `birthdate`,  `tel`, `laneType`, `street`, `addressComplement`, `postalCode`, `city`, `streetNumber`, `completeDossier`, isActive ,`isRegister`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
        
        $req = $pdo->prepare($sql);
        return $req->execute($dataRegister);

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