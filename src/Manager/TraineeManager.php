<?php 

require_once 'UserManager.php';
require '../src/Entity/Trainee.php';

class TraineeManager extends UserManager {


    public function getAllTrainees()
    {
        $pdo=PdoManager::getPdo();
        
        $sql= 'SELECT * FROM trainee';
        $req = $pdo->prepare($sql);
        $req->execute();
        
        $trainee = $req->fetchAll(PDO::FETCH_ASSOC);
        
        return $trainee;
    }

    
    /**
     * getAllTrainees permet de récupérer les Trainnees qui ne sont ni candidat et ni stagiaire.
     *
     * @return void
     */
    public function getAllRegistered()
    {
        $pdo=PdoManager::getPdo();
        
        $sql= "SELECT users.id_user ,  firstName , familyName , email , tel FROM trainee INNER JOIN users ON users.id_user = trainee.id_user  WHERE isRegistered = 0";
        $req = $pdo->prepare($sql);
        $req->execute();
        
        $registered = $req->fetchAll(PDO::FETCH_ASSOC);

        return $registered;
    }
    

    public function getAllCandidates()
    {
        $pdo=PdoManager::getPdo();
        $sql= 'SELECT * FROM trainee WHERE isRegistered = 0';

        $req = $pdo->prepare($sql);
        $req->execute();
        
        $candidates = $req->fetchAll(PDO::FETCH_ASSOC);
        
        return $candidates;
    }


    /**
     * get
     *
     * @param  mixed $email
     * @return void
     */
    public function getTraineeByEmail(string $email)
    {
        $pdo=PdoManager::getPdo();
        $sql= 'SELECT * FROM trainee INNER JOIN users ON users.id_user = trainee.id_user WHERE email_user=:email_user';

        $req = $pdo->prepare($sql);
        $req->execute([
            'email_user'=>$email
        ]);
        
        $user = $req->fetch(PDO::FETCH_ASSOC);
        
        return $user;
    }

    public function getTraineeById(string $id_user)
    {
        $pdo=PdoManager::getPdo();
        $sql= 'SELECT * FROM trainee INNER JOIN users ON users.id_user = trainee.id_user WHERE trainee.id_user=:id_user';

        $req = $pdo->prepare($sql);
        $req->execute([
            'id_user'=>intval($id_user)
        ]);

        $trainee = $req->fetch(PDO::FETCH_ASSOC);
        return $obj=(new Trainee())->hydrate($trainee);
    }

    public function getAllInfos(string $id_user)
    {

        $pdo=PdoManager::getPdo();


        $sql= 'SELECT * FROM trainee INNER JOIN users ON users.id_user = trainee.id_user AND trainee.id_user=:id_user';

        $req = $pdo->prepare($sql);
        $req->execute([
            'id_user'=>intval($id_user)
        ]);
        
        $traineeInfos = $req->fetch(PDO::FETCH_ASSOC);

        $obj=(new Trainee())->hydrate($traineeInfos);

        return $obj;

    }

    public function checkCompleteDossier(string $id_user)
    {
        $pdo=PdoManager::getPdo();
        $sql= 'SELECT completeDossier FROM trainee WHERE id_user=:id_user';

        $req = $pdo->prepare($sql);
        $req->execute([
            'id_user'=>intval($id_user)
        ]);
        
        $completeDossier = $req->fetch(PDO::FETCH_ASSOC);

        $statusDossier = $completeDossier['completeDossier'];

        //Si la requete renvoie 0, $statusDossier est false 
        $statusDossier == 0 ? $completeDossier=false : $completeDossier=true;

        return $completeDossier;

    }

    public function isRegistered(string $id_user)
    {
        $pdo=PdoManager::getPdo();
        $sql= 'SELECT isRegistered FROM trainee WHERE id_user=:id_user';

        $req = $pdo->prepare($sql);
        $req->execute([
            'id_user'=>intval($id_user)
        ]);
        
        $isRegistered = $req->fetch(PDO::FETCH_ASSOC);
        
        $registerStatus = $isRegistered['isRegistered'];

        //Si la requete renvoie 0, $isRegistered est false 
        $registerStatus == 0 ? $isRegistered=false : $isRegistered=true;
        return $isRegistered;
    }

}