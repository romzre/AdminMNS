<?php 

namespace App\Manager;

use PDO;

class TraineeTrainingManager {

    public function getTrainingId(string $id_user)
    {
        $pdo=PdoManager::getPdo();

        $sql= "SELECT id_training FROM trainee_training WHERE id_user = :id_user";

        $req = $pdo->prepare($sql);
        $req->execute([
            'id_user' => $id_user
        ]);

        $id_training = $req->fetch(PDO::FETCH_ASSOC);

        return $id_training;
      
    }

    public function getAllTrainingByUser(string $id_user)
    {
        $pdo=PdoManager::getPdo();

        $sql= "SELECT * FROM `trainee` INNER JOIN trainee_training ON trainee.id_user = trainee_training.id_user INNER JOIN training ON trainee_training.id_training = training.id_training WHERE trainee.id_user = :id_user";

        $req = $pdo->prepare($sql);
        $stmt = $req->execute([
            'id_user' => $id_user
        ]);

        $user_training = $req->fetch(PDO::FETCH_ASSOC);

        return $user_training;
      
    }
}