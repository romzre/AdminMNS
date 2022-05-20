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
}