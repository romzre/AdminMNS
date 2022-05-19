<?php 

namespace App\Manager;

use PDO;
use App\Entity\Training;
// require_once 'PdoManager.php';

// require '../src/Entity/Training.php';

class TrainingManager {

    use PdoManager;

    /**
     * getAll
     *
     * @return void
     */
    public function getAll()
    {
        $pdo=PdoManager::getPdo();

        $currentYear = date('Y');
        $sql= "SELECT * FROM `training` WHERE trainingYear = $currentYear";
        $req = $pdo->prepare($sql);
        $req->execute();

        $trainings = $req->fetchAll(PDO::FETCH_ASSOC);

        foreach ($trainings as $training) {
            $obj[] = (new Training())->hydrate($training);
        }
        return $obj;
    }


    public function updateTraining($data)
    {
        $pdo=PdoManager::getPdo();

        $sql= "UPDATE `training` SET `title_formation`= :title_formation,`capacity_training`= :capacity_training,`trainingYear`= :trainingYear WHERE id_training = :id";
        $req = $pdo->prepare($sql);
        $stmt = $req->execute($data);

        
        return $stmt;
    }


 
    
    /**
     * getTraining
     *
     * @param  mixed $id_user
     * @return void
     */
    public function getTraining($id_user)
    {
        $pdo=PdoManager::getPdo();

        $sql= 'SELECT * FROM training INNER JOIN trainee_training on training.id_training = trainee_training.id_training WHERE id_user=:id_user';
        $req = $pdo->prepare($sql);
        $req->execute([
            'id_user'=> $id_user,
        ]);

        $training = $req->fetch(PDO::FETCH_ASSOC);

        return $obj= (new Training())->hydrate($training);
    }
    
    /**
     * getDocumentsByTraining
     *
     * @param  mixed $id_training
     * @return void
     */
    public function getDocumentsByTraining(string $id_training)
    {
        $pdo=PdoManager::getPdo();

        $sql= 'SELECT typeOfDoc.id_typeOfDoc, typeOfDoc.wording_typeOfDoc FROM training INNER JOIN training_typeOfDoc on training.id_training = training_typeOfDoc.id_training INNER JOIN typeOfDoc on typeOfDoc.id_typeOfDoc = training_typeOfDoc.id_typeOfDoc WHERE training.id_training=:id_training';
        $req = $pdo->prepare($sql);
        $req->execute([
            'id_training'=> $id_training,
        ]);
        
        return $trainingDocs = $req->fetchAll(PDO::FETCH_ASSOC);

    }



}